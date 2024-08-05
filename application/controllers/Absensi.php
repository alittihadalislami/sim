<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('User_model','um');
		$this->load->model('Absensi_model','am');
		$this->tahunAktif = $this->um->tahunAktif();
	}

	public function index()
	{
		$data['judul'] = 'Absensi';
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

		if ($hari == 'Jum\'at'){
			$data['jadwal'] = [];
		}else{
			$data['jadwal'] = $this->am->jadwalHariIni($hari,$id_asatid,$this->tahunAktif['id_tahun']);
		}

		$this->load->view('templates/header', $data);
		$this->load->view('absensi/home', $data);
		$this->load->view('templates/footer');	

	}

	public function simpanPegawai()
	{
		$daput = $this->input->post(null,true);

		$this->db->where('id', $daput['id']);
		$ada = $this->db->get('t_jurnal_pegawai')->num_rows();

		if ($ada < 1) {
			$this->db->insert('t_jurnal_pegawai', $daput);
		}else{
			$object = [
				'pulang' => $daput['pulang'],
				'kegiatan' => $daput['kegiatan']
			];
			$this->db->where('id', $daput['id']);
			$this->db->update('t_jurnal_pegawai', $object);
		}

		redirect('absensi','refresh');
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
		$data['judul'] = 'Absensi';
		$data['jam'] = $this->waktuAbsen()['jam'].'.'.$this->waktuAbsen()['menit'];
		$data['tanggal'] = $this->waktuAbsen()['tanggal'];
		$data['kbm'] = $this->am->detailKbm($this->uri->segment(3));
		$data['santri'] = $this->um->santriKelas($data['kbm']['id_kelas'] ,$this->tahunAktif['id_tahun']);

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
		}else{
			$this->db->where('kbm_id', $daput['id_kbm']);
			$this->db->where('tgl', $daput['tanggal']);
			$this->db->update('t_jurnal', $jurnal);
		}

		$id_jurnal = $this->am->cekJurnal($daput['id_kbm'], $daput['tanggal'])['id_jurnal'];

		foreach ($daput as $absen => $a) {
			if (substr($absen,0,9) == "kehadiran") {
				$absensi []= ['id_absensi'=>$id_jurnal.explode("-",$absen)[1],'jurnal_id'=>$id_jurnal, 'santri_id'=>explode("-",$absen)[1] , 'absen'=>$a]  ;
			}
		}

		foreach ($absensi as $ab) {
			$this->db->replace('t_absensi', $ab);
		}
		// redirect('absensi/dhsantri/'.$daput['id_kbm'],'refresh');
		redirect('absensi','refresh');
	}

	public function pilihPeriode()
	{
		$data['judul'] = 'Pilih Periode';

		$list_bulan = $this->am->listBulanAbsen();
		$bulan = [1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

		foreach ($list_bulan as $val) {
			$bulan_absen[array_search($val->bulan,$bulan)] = [
				array_search($val->bulan,$bulan),
				$val->bulan,
				$val->tahun
			];
		}

		$data['bulan']=$bulan_absen;
		
		$this->load->view('templates/header', $data);
		$this->load->view('absensi/periode', $data);
		$this->load->view('templates/footer');
	}

	public function rekap($bln,$tahun)
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

		echo date('l',strtotime($hari_aktif[31]) );
		echo date('N',strtotime($hari_aktif[31]) );

		var_dump($hari_aktif);die();

		$this->load->view('templates/header', $data);
		$this->load->view('absensi/kehadiran_civitas', $data);
		$this->load->view('templates/footer');
	}

	function Asatid()
	{
		$data['judul'] = 'Kehadiran asatid';
        $data['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $data['list_guru'] = $this->am->listGuru('10','1');

		$this->load->view('templates/header', $data);
		$this->load->view('absensi/rekap_kehadiran', $data);
		$this->load->view('templates/footer');
	}

    function rekapPerAsatid()
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

    function ajax_getMapel() {
        $daput = $this->input->post();
        $hasil = $this->am->getMapelAsatid($this->tahunAktif['id_tahun'],$daput['asatid']);
        echo json_encode($hasil);
    }

    function ajax_getKelas() {
        $daput = $this->input->post();
        $hasil = $this->am->getKelasAsatid($this->tahunAktif['id_tahun'],$daput['asatid'],$daput['mapel']);
        echo json_encode($hasil);
    }

    function ajax_anggotaKelas() {
        $daput = $this->input->post();
        $hasil = $this->am->getAnggotaKelas($this->tahunAktif['id_tahun'],$daput['kelas']);
        echo json_encode($hasil);
    }

    function ajax_jadwal() {
        $daput = $this->input->post();
        $hasil = $this->am->getJadwal($this->tahunAktif['id_tahun'],$daput['asatid'],$daput['mapel'],$daput['kelas']);
        echo json_encode($hasil);
    }

    function ajax_prosesAjuan(){
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
		}else{
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

    function asatid_ajax() {
        $daput = $this->input->post();
        $list_guru = $this->am->dataKehadiran($daput['tahun'],$daput['bulan'],$daput['asatid']);
        echo json_encode($list_guru);
    }

    function santri()
	{
		$data['judul'] = 'Kehadiran santri';
        $data['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $data['list_kelas'] = $this->db->order_by('nama_kelas', 'ASC')->get_where('m_kelas', ['jenjang'=>1])->result_array();
        
        $data['tahunAktif'] = $this->tahunAktif['id_tahun']; //tahun aktif ajaran saat ini.

		$nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
		$data_mapel_kelas = $this->um->ngajarApa($nohp,$data['tahunAktif']);

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

    function santri_ajax() {
        $daput = $this->input->post();
        // $daput['tahun']= '2024';
        // $daput['bulan']= 'Januari';
        // $daput['kelas']= '22';
        // $daput['mapel']= '6';
        $hasil = $this->am->dataKehadiranSantri($daput['tahun'],$daput['bulan'],$daput['kelas'],$daput['mapel']);
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
        foreach ($absen as $ab ) {
            $absen2 [] = $ab;
        }

        echo json_encode($absen2);
    }

    function ajax_santri_wali() {
        // $daput = $this->input->post();
        $daput['tahun']= '2023';
        $daput['kelas']= '22';
        $daput['sem']= '1';
        $hasil = $this->am->dataKehadiranSantriPerSemester($daput['tahun'],$daput['sem'],$daput['kelas']);

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