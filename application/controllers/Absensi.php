<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public $tahunAktif ;
    public $pengguna ;

    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('User_model', 'um');
        $this->load->model('Absensi_model', 'am');
        $this->tahunAktif = $this->um->tahunAktif();


        $email = $this->session->userdata['email'];
        $hasil = $this->am->showRuleLevelByEmail($email);
        $this->pengguna = $hasil;
    }

    public function index()
    {
        $data['judul'] = 'Presensi';
        $data['jam'] = $this->waktuAbsen()['jam'].'.'.$this->waktuAbsen()['menit'];
        $data['tanggal'] = $this->waktuAbsen()['tanggal'];
        $hari = $this->waktuAbsen()['nama_hari'];
        $data['atribut'] = $this->waktuAbsen();

        $user = $this->um->dataAktif($this->session->userdata('email'));
        $id_asatid = $this->um->idAsatid($user['nohp'])['id_asatid'];

        $this->db->select('kategori');
        $kat = $this->db->get_where('m_asatid', ['id_asatid' => $id_asatid])->row_array();
        $data['kategori'] = $kat['kategori'];

        $data['level'] = $this->um->showRuleLevel($user['id_user']);
        $data ['semester_id'] = $this->tahunAktif['id_tahun'];

        $email = $this->session->userdata('email');
        $no_hp = $this->um->dataAktif($email)['nohp'];

        $data['id_pegawai'] = $this->um->idAsatid($no_hp)['id_asatid'];

        if ($hari == 'Jum\'at') {
            $data['jadwal'] = [];
        } else {
            $data['jadwal'] = $this->am->jadwalHariIni($hari, $id_asatid, $this->tahunAktif['id_tahun']);
        }

        $data['judul'] = 'Kehadiran asatid';
        $data['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

        $email = $this->session->userdata['email'];
        $hasil = $this->am->showRuleLevelByEmail($email);
        $data['list_guru'] = $hasil;
        $this->penggguna = $hasil;

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/home', $data);
        $this->load->view('templates/footer');
    }

    public function simpanPegawai()
    {
        $daput = $this->input->post(null, true);

        $this->db->where('id', $daput['id']);
        $ada = $this->db->get('t_jurnal_pegawai')->num_rows();

        if ($ada < 1) {
            $this->db->insert('t_jurnal_pegawai', $daput);
        } else {
            $object = [
                'pulang' => $daput['pulang'],
                'kegiatan' => $daput['kegiatan']
            ];
            $this->db->where('id', $daput['id']);
            $this->db->update('t_jurnal_pegawai', $object);
        }

        redirect('absensi', 'refresh');
    }


    public function waktuAbsen()
    {
        ini_set('date.timezone', 'Asia/Jakarta');

        $hari_id =[1=>'Senin','Selasa','Rabu', 'Kamis', 'Jum\'at','Sabtu', 'Ahad'];
        $bulan_id =[1=>'Januari','Februari','Maret', 'April', 'Mei','Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $waktu ['detik'] = date("s");
        $waktu ['menit'] = date("i");
        $waktu ['jam'] = date("G");
        $waktu ['hari'] = date("N");
        $waktu ['tgl'] = date("j");
        $waktu ['bulan'] = date("n");
        $waktu ['tahun'] = date("Y");
        $waktu ['nama_hari'] = $hari_id[date("N")];

        $waktu ['tanggal'] = $hari_id[date("N")].', '. date("j").' '.$bulan_id[date("n")].' '.date("Y");

        return $waktu;
    }

    public function cekwali()
    {
        $tahun_aktif = $this->tahunAktif['id_tahun'];
        $nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
        $id_asatid = $this->um->idAsatid($nohp)['id_asatid'];
        $data_wali = $this->um->adaIdWali($id_asatid);
        return $data_wali;
    }

    public function dhSantri()
    {
        $data['judul'] = 'Presensi - Jurnal';
        $data['jam'] = $this->waktuAbsen()['jam'].'.'.$this->waktuAbsen()['menit'];
        $data['tanggal'] = $this->waktuAbsen()['tanggal'];
        $data['kbm'] = $this->am->detailKbm($this->uri->segment(3));
        $data['santri'] = $this->um->santriKelas($data['kbm']['id_kelas'], $this->tahunAktif['id_tahun']);

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/dh_santri', $data);
        $this->load->view('templates/footer');
    }

    public function simpanDaftarHadir()
    {
        $daput = $this->input->post();

        $jurnal = [
            'kbm_id' => $daput['id_kbm'],
            'tgl' => $daput['tanggal'],
            'materi' => $daput['materi']
        ];

        $cek = $this->am->cekJurnal($daput['id_kbm'], $daput['tanggal']);

        if (!$cek) {
            $this->db->insert('t_jurnal', $jurnal);
        } else {
            $this->db->where('kbm_id', $daput['id_kbm']);
            $this->db->where('tgl', $daput['tanggal']);
            $this->db->update('t_jurnal', $jurnal);
        }

        $id_jurnal = $this->am->cekJurnal($daput['id_kbm'], $daput['tanggal'])['id_jurnal'];

        foreach ($daput as $absen => $a) {
            if (substr($absen, 0, 9) == "kehadiran") {
                $absensi []= ['id_absensi'=>$id_jurnal.explode("-", $absen)[1],'jurnal_id'=>$id_jurnal, 'santri_id'=>explode("-", $absen)[1] , 'absen'=>$a]  ;
            }
        }

        foreach ($absensi as $ab) {
            $this->db->replace('t_absensi', $ab);
        }
        // redirect('absensi/dhsantri/'.$daput['id_kbm'],'refresh');
        redirect('absensi', 'refresh');
    }

    public function pilihPeriode()
    {
        $data['judul'] = 'Pilih Periode';

        $list_bulan = $this->am->listBulanAbsen();
        $bulan = [1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        foreach ($list_bulan as $val) {
            $bulan_absen[array_search($val->bulan, $bulan)] = [
                array_search($val->bulan, $bulan),
                $val->bulan,
                $val->tahun
            ];
        }

        $data['bulan']=$bulan_absen;

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/periode', $data);
        $this->load->view('templates/footer');
    }

    public function rekap($bln, $tahun)
    {
        $data['judul'] = 'Rekap Absensi';

        $list_bulan = [1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $bulan = $list_bulan[$bln];


        $this->db->select('id_asatid, nama_asatid');
        $this->db->order_by('niy', 'asc');
        $this->db->where('sts', 1);
        $this->db->where('kategori', 1);
        $asatid = $this->db->get('m_asatid')->result_array();

        foreach ($asatid as $as) {
            $total = 0;

            //membuat array template list ustad, dengan tgl jamke dan total kosongan

            $list_asatid [ $as['nama_asatid'] ] = [
                                                'tgl' => [],
                                                'jamke' => [],
                                                'total' => ''
            ];


            $tgl_hadir = $this->am->tglHadir($as['id_asatid'], $bulan, $tahun);
            foreach ($tgl_hadir as $tgl) {

                //mengisi array tgl pada array ustad
                $list_asatid [$as['nama_asatid']] ['tgl'] [ $tgl['tgl'] ] = $tgl['waktu'];

                $waktu_hadir = $this->am->waktuHadir($as['id_asatid'], $tgl['waktu']);

                $total += count($waktu_hadir);

                foreach ($waktu_hadir as $wh) {
                    foreach ($list_asatid [$as['nama_asatid']] ['tgl'] as $t => $w) {
                        if ($w == $wh['waktu']) {
                            //mengisi array jamke pada array ustad
                            $list_asatid [$as['nama_asatid']] ['jamke'] [$t] [] = $wh['jamke']  ;
                        }
                    }
                }
            }
            $list_asatid [$as['nama_asatid']] ['total'] = $total;
        }

        $data['rekap_semua']=$list_asatid;
        $data['atribut']=[$bulan, $tahun];

        $this->db->order_by('niy', 'asc');
        $data['nonguru'] = $this->db->get_where('m_asatid', ['kategori'=>2])->result();

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/rekap_semua', $data);
        $this->load->view('templates/footer');
    }

    public function rekapPerCivitas($asatid_id)
    {
        $data['judul'] = 'Rekap Kehadiran';

        $jumlah_hari = 31;

        for ($i=1; $i <= $jumlah_hari; $i++) {
            $hari_aktif [$i] = '2020/8/'.$i;
        }

        echo date('l', strtotime($hari_aktif[31]));
        echo date('N', strtotime($hari_aktif[31]));

        var_dump($hari_aktif);
        die();

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/kehadiran_civitas', $data);
        $this->load->view('templates/footer');
    }

    public function Asatid()
    {
        $data['judul'] = 'Kehadiran asatid';
        $data['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $data['list_guru'] = $this->am->listGuru('10', '1');

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/rekap_kehadiran', $data);
        $this->load->view('templates/footer');
    }

    public function rekapPerAsatid()
    {
        $data['judul'] = 'Kehadiran asatid';
        $data['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

        $email = $this->session->userdata['email'];
        $hasil = $this->am->showRuleLevelByEmail($email);
        $data['list_guru'] = $hasil;

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/rekap_kehadiran', $data);
        $this->load->view('templates/footer');
    }

    public function ajax_getMapel()
    {
        $daput = $this->input->post();
        $hasil = $this->am->getMapelAsatid($this->tahunAktif['id_tahun'], $daput['asatid']);
        echo json_encode($hasil);
    }

    public function ajax_getKelas()
    {
        $daput = $this->input->post();
        $hasil = $this->am->getKelasAsatid($this->tahunAktif['id_tahun'], $daput['asatid'], $daput['mapel']);
        echo json_encode($hasil);
    }

    public function ajax_anggotaKelas()
    {
        $daput = $this->input->post();
        $hasil = $this->am->getAnggotaKelas($this->tahunAktif['id_tahun'], $daput['kelas']);
        echo json_encode($hasil);
    }

    public function ajax_jadwal()
    {
        $daput = $this->input->post();
        $hasil = $this->am->getJadwal($this->tahunAktif['id_tahun'], $daput['asatid'], $daput['mapel'], $daput['kelas']);
        echo json_encode($hasil);
    }

    public function ajax_prosesAjuan()
    {
        $daput = $this->input->post();
        $jurnal = [
            'kbm_id' => $daput['data_jurnal']['id_kbm'],
            'tgl' => $daput['data_jurnal']['tanggal'],
            'materi' => $daput['data_jurnal']['materi']
        ];

        $cek = $this->am->cekJurnal($jurnal['kbm_id'], $jurnal['tgl']);
        if (!$cek) {
            $this->db->insert('t_jurnal', $jurnal);
            $id_jurnal_saat_ini = $this->db->insert_id();
        } else {
            $this->db->where('kbm_id', $jurnal['kbm_id']);
            $this->db->where('tgl', $jurnal['tgl']);
            $this->db->update('t_jurnal', $jurnal);
            $id_jurnal_saat_ini = $this->am->cekJurnal($jurnal['kbm_id'], $jurnal['tgl'])['id_jurnal'];
        }

        $absen = $daput['data_absen'];
        foreach ($absen as $ab) {
            $object = [
                'id_absensi' => $id_jurnal_saat_ini.$ab['id'],
                'jurnal_id' => $id_jurnal_saat_ini,
                'santri_id' => $ab['id'],
                'absen' => $ab['value']
            ];
            $this->db->replace('t_absensi', $object);
        }
        echo json_encode(['pesan'=>'berhasil disimpan']);
    }

    public function asatid_ajax()
    {
        $daput = $this->input->post();
        $list_guru = $this->am->dataKehadiran($daput['tahun'], $daput['bulan'], $daput['asatid']);
        echo json_encode($list_guru);
    }


    public function hapusTandaAkhir($string)
    {
        $string = trim($string);
        if (substr($string, -1) === '.' || substr($string, -1) === ',') {
            return $this->hapusTandaAkhir(substr($string, 0, -1));
        }
        return $string;
    }


    public function asatid_ajax_pdf()
    {
        $daput = $this->input->get();
        var_dump($daput);
        die();
    }

    public function asatid_ajax_tcpdf()
    {
        setlocale(
            LC_ALL,
            'id_ID.UTF8',
            'id_ID.UTF-8',
            'id_ID.8859-1',
            'id_ID',
            'IND.UTF8',
            'IND.UTF-8',
            'IND.8859-1',
            'IND',
            'Indonesian.UTF8',
            'Indonesian.UTF-8',
            'Indonesian.8859-1',
            'Indonesian',
            'Indonesia',
            'id',
            'ID',

            // Add english as default (if all Indonesian not available)
            'en_US.UTF8',
            'en_US.UTF-8',
            'en_US.8859-1',
            'en_US',
            'American',
            'ENG',
            'English'
        );
        date_default_timezone_set('Asia/Jakarta');

        $daput = $this->input->get();
        $id_dicari = $daput['asatid'] ;
        $id_pengguna =  $this->pengguna[0]['id_asatid'];

        if ($id_pengguna != '9') {
            if ($id_dicari != $id_pengguna) {
                redirect('My404', 'refresh');
            }
        }

        $periode = $this->ambilPeriode($daput['bulan'], $daput['tahun']);
        $bulan_1 = $periode[0][0];
        $tahun_1 = $periode[0][1];
        $tanggal_1 = $periode[0][2];

        $bulan_2 = $periode[1][0];
        $tahun_2 = $periode[1][1];
        $tanggal_2 = $periode[1][2];

        $data['bulan_tahun'] = [$bulan_2, $tahun_2];

        $data1 = $this->am->dataKehadiran($tahun_1, $bulan_1, $daput['asatid'], $tanggal_1);
        $data2 = $this->am->dataKehadiran($tahun_2, $bulan_2, $daput['asatid'], $tanggal_2);

        $data ['list_guru'] = array_merge($data1, $data2);
        $data ['pengguna'] = $this->pengguna[0];
        $nama_asatid = $this->hapusTandaAkhir($data ['pengguna']['nama_asatid']);

        $this->load->library('QrKode');
        $timestamp = time();
        $data ['tanggal_waktu'] = strftime('%A, %d %B %Y %H:%M:%S', $timestamp);
        $text = $nama_asatid.'\n'.$data ['tanggal_waktu'];
        $file_path = FCPATH . 'assets/qrcode/temp_qrcode.png';
        $this->qrkode->generate($text, $file_path);
        $data['ttd'] = base_url('assets/qrcode/temp_qrcode.png');
        // $data['ttd'] = $file_path;
        $nama_file = "Jurnal Mengajar - $bulan_2 $tahun_2 - $nama_asatid.pdf";

        // $this->load->view('absensi/rekap_asatid_pdf', $data);
        $html = $this->load->view('absensi/rekap_asatid_pdf', $data, true);

        $this->load->library('tcpdf_gen');
        $pdf = new Tcpdf_gen(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);


        // // set document information
        $pdf->SetCreator('www.sim.alittihadalislami.org');
        $pdf->SetAuthor('sim.alittihadalislami.org');
        $pdf->SetTitle($nama_file);
        $pdf->SetSubject('Jurnal Asatidz-Pegawai');

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Call before the addPage() method
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        $pdf->SetFont('amiri', 'B', 14);
        $pdf->Cell(0, 4, 'JURNAL MENGAJAR ASATIDZ', 0, 1, 'C');
        $pdf->SetFont('amiri', '', 18);
        $pdf->Cell(0, 4, 'MA\'HAD AL ITTIHAD AL ISLAMI', 0, 1, 'C');
        // set font
        $pdf->SetFont('amiri', '', 12);
        // set LTR direction for english translation
        $pdf->setRTL(false);
        $pdf->Ln();
        $pdf->WriteHTML($html, true, 0, true, 0);

        $pdf->Ln();
        $pdf->Cell(0, 4, 'File diunduh dari SIM, pada:', 0, 1, 'C');
        $pdf->Cell(0, 4, $data ['tanggal_waktu'], 0, 1, 'C');
        $pdf->Cell(0, 10, 'ttd', 0, 1, 'C');
        $pdf->SetFont('amiri', 'BU', 12);
        $pdf->Cell(0, 4, $nama_asatid, 0, 1, 'C');

        //Close and output PDF document
        $pdf->Output($nama_file, 'I');
    }


    public function ambilPeriode($bulan, $tahun)
    {
        // Array nama bulan dalam bahasa Indonesia
        $bulanArray = array(
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );

        // Temukan indeks bulan dalam array
        $currentMonthIndex = array_search($bulan, $bulanArray);

        // Jika bulan yang dimasukkan adalah Januari, pindah ke Desember tahun sebelumnya
        if ($currentMonthIndex === 0) {
            $previousMonth = 'Desember';
            $previousYear = $tahun - 1;
        } else {
            $previousMonth = $bulanArray[$currentMonthIndex - 1];
            $previousYear = $tahun;
        }

        // Bulan yang dimasukkan tetap
        $currentMonth = $bulan;
        $currentYear = $tahun;

        // Return array dengan bulan sebelumnya dan bulan saat ini
        return [
            [$previousMonth, $previousYear, '>25'],
            [$currentMonth, $currentYear, '<=25']
        ];
    }

    public function santri()
    {
        $data['judul'] = 'Kehadiran santri';
        $data['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $data['list_kelas'] = $this->db->order_by('nama_kelas', 'ASC')->get_where('m_kelas', ['jenjang'=>1])->result_array();

        $data['tahunAktif'] = $this->tahunAktif['id_tahun']; //tahun aktif ajaran saat ini.

        $nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
        $data_mapel_kelas = $this->um->ngajarApa($nohp, $data['tahunAktif']);

        $mapel = [] ;
        $kelas = [] ;
        foreach ($data_mapel_kelas as $dpk) {
            $mapel[] = ['id_mapel'=>$dpk['id_mapel'],'nama_mapel'=>$dpk['nama_mapel']];
            $kelas[] = ['id_kelas'=>$dpk['id_kelas'],'nama_kelas'=>$dpk['nama_kelas']];
        }
        $data['list_mapel'] = array_intersect_key($mapel, array_unique(array_column($mapel, 'id_mapel')));
        $data['list_kelas'] = array_intersect_key($kelas, array_unique(array_column($kelas, 'id_kelas')));

        $this->load->view('templates/header', $data);
        $this->load->view('absensi/rekap_kehadiran_santri', $data);
        $this->load->view('templates/footer');
    }

    public function santri_ajax()
    {
        $daput = $this->input->post();
        // $daput['tahun']= '2024';
        // $daput['bulan']= 'Januari';
        // $daput['kelas']= '22';
        // $daput['mapel']= '6';
        $hasil = $this->am->dataKehadiranSantri($daput['tahun'], $daput['bulan'], $daput['kelas'], $daput['mapel']);
        $list_santri =  array_unique(array_column($hasil, 'santri_id'));

        foreach ($list_santri as $s) {
            $absen [$s] = [
                'detail' => $this->um->showNamaSantri($s),
                'alpa' => 0 ,
                'ijin' => 0 ,
                'sakit' => 0
            ];
            foreach ($hasil as $hsl) {
                if ($hsl['santri_id'] == $s) {
                    if ($hsl['absen'] == 0) {
                        $absen[$s]['alpa'] =+ 1 ;
                    }
                    if ($hsl['absen'] == 1) {
                        $absen[$s]['ijin'] =+ 1 ;
                    }
                    if ($hsl['absen'] == 2) {
                        $absen[$s]['sakit'] =+ 1 ;
                    }
                }
            }
        }

        $absen2 = [];
        foreach ($absen as $ab) {
            $absen2 [] = $ab;
        }

        echo json_encode($absen2);
    }

    public function ajax_santri_wali()
    {
        // $daput = $this->input->post();
        $daput['tahun']= '2023';
        $daput['kelas']= '22';
        $daput['sem']= '1';
        $hasil = $this->am->dataKehadiranSantriPerSemester($daput['tahun'], $daput['sem'], $daput['kelas']);

        $no = 0;
        foreach ($hasil as $h) {
            var_dump($h);


            $no++;
            if ($no >  10) {
                die();
            }
        }

        // var_dump($hasil);
    }
}

/* End of file absensi.php */
/* Location: ./application/controllers/absensi.php */
