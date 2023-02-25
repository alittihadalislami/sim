<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {
	var $tahunAktif ;
    var $waktuSekarang;
    
	public function __construct()
	{
        parent::__construct();
		is_login();
		$this->load->model('Raport_model','rm');
		$this->load->model('User_model','um');
		$this->load->model('Kelas_model','km');
		$this->tahunAktif = $this->um->tahunAktif();
        date_default_timezone_set('Asia/Jakarta');
        $this->waktuSekarang = date('d-m-Y H:i:s');
	}

    public function cekAjax()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
    }

    function konfersiTimeDate($t=NULL){ // 06-12-2023 00:00:00 
        $x = strpos($t,"-"); // apakah ada tand strip
        if ($x > 0) {
            $t= strlen($t) <= 10 ? $t." 00:00:00": $t ; // tambahkan jam jika tidak ada
            $d = DateTime::createFromFormat('d-m-Y H:i:s', $t);
            if ($d === false) {
                die("Incorrect date string");
            } else {
                return $d->getTimestamp();
            }
        }else{ 
            //return date format
            return date("d-m-Y H:i:s",$t);
        }
    }

	public function index()
	{

    $data['judul'] = 'Dashboard Keuangan';
    $this->load->view('templates/header', $data);
    $this->load->view('keuangan/index_keuangan', $data);
	$this->load->view('templates/footer');
  }
  public function tabel()
  {
    $data['transaksi_terakhir'] = rand(10,100)."%";
    $data['tagihan'] = rand(10,100)."%";
    $data['lunas'] = rand(10,100)."%";
    $data['tunggakan'] = rand(10,100)."%";

    $isi1 = $this->load->view('keuangan/status',$data,true);
    $isi2 = $this->load->view('keuangan/tabel',null,true);
    $isi3 = $this->load->view('keuangan/invoice',null,true);
    // echo $isi1.$isi2.$isi3;
    echo $isi3;
  }

  public function invoice()
  {
    echo $this->load->view('keuangan/invoice',null,true);
  }

  public function database()
  {
    $data['judul'] = "database";
    $stringQ = " SELECT n.`id_tagihan`,m.`mutasi_keuangan`, n.`bulan`, n.`tahun`, n.`tapel`, n.`tagihan`
                FROM tb_tagihan n JOIN tb_mutasi_keuangan m
                WHERE m.`id_mutasi_keuangan` = n.`mutasi_keuangan_id`
                ORDER BY n.`tahun` ASC, n.`bulan` ASC 
                ";
    $data['tagihan'] = $this->db->query($stringQ)->result_array();
    $isi = $this->load->view('keuangan/database',$data, true);
    echo $isi;
  }

  public function isi_database()
  {
    $data['judul'] = "database";
    $stringQ = " SELECT n.`id_tagihan`,m.`mutasi_keuangan`, n.`bulan`, n.`tahun`, n.`tapel`, n.`tagihan`
                FROM tb_tagihan n JOIN tb_mutasi_keuangan m
                WHERE m.`id_mutasi_keuangan` = n.`mutasi_keuangan_id`
                ORDER BY n.`tahun` ASC, n.`bulan` ASC 
                ";
    $data['tagihan'] = $this->db->query($stringQ)->result_array();
    $isi = $this->load->view('keuangan/isi_database',$data, true);
    echo $isi;
  }

  public function cariSantri()
  {
    $daput = $this->input->post();
    $stringQ = " SELECT a.*, s.`nama_santri`, s.`idk_mii`, d.`alamat_ortu`, d.`bapak`, d.`hp_bapak`, d.`hp_ibu`, k.`nama_kelas`
                FROM t_agtkelas a JOIN m_santri s
                ON a.`santri_id` = s.`id_santri` JOIN t_detail_santri d
                ON d.`santri_id` = s.`id_santri` JOIN m_kelas k
                ON k.`id_kelas` = a.`kelas_id`
                WHERE a.`tahun_id` = (SELECT MAX(agt.`tahun_id`) FROM t_agtkelas agt)
                AND k.`active` = 1
                AND ( s.`nama_santri` LIKE '%".$daput['santri_atribut']."%' OR s.`idk_mii` LIKE '%".$daput['santri_atribut']."%' ) ";
    $data['santri_terpilih'] = $this->db->query($stringQ)->result_array();
    $isi = $this->load->view('keuangan/list_santri',$data,true);
    echo $isi;
  }

  public function hapustagihan()
  {
    $daput = $this->input->post();
    $this->db->delete('tb_tagihan', $daput);
  }
  public function duaDigit($int)
  {
    if (strlen($int) < 2) {
        return '0'.$int;
    }
    return $int;
  }
  public function tambahTagihan()
  {
    $this->cekAjax();
    $daput = $this->input->post('daput');
    $cek = $daput['tapel'] != "" && $daput['jenis_mutasi'] != "" && $daput['tagihan_mutasi'] != "" ;
    if ($cek) {
        $tapel = $daput['tapel'];
        $mutasi_keuangan_id = $daput['jenis_mutasi'];
        $tagihan = trim(str_replace('.','',$daput['tagihan_mutasi']));
        
        //cek tapel valid apa tidak 
        $tapel1 = substr($tapel,0,4);
        $tapel2 = substr($tapel,4,4);
        if ($tapel2 < 1) {
            echo json_encode([
                'sts' => 'false',
                'pesan' => 'tapel tidak valid'
            ]);
            return;
        }
        if ($tapel2-$tapel1 == 1) {
            if ($daput['jenis_mutasi'] == 1 ) { //jikas SPP=1
                for ($i=1; $i<13; $i++) {
                    $tahun = ($i < 7) ? $tapel2 : $tapel1;
                    $sem = ($i < 7) ? 2 : 1;
                    $objek = [
                        'id_tagihan' => $mutasi_keuangan_id.$tapel.$this->duaDigit($i),
                        'mutasi_keuangan_id' => $mutasi_keuangan_id,
                        'bulan' => $i,
                        'tahun' => $tahun, 
                        'tapel' => $tapel,
                        'sem' => $sem,
                        'tagihan' => $tagihan
                    ];
                    $this->db->replace('tb_tagihan', $objek);
                    $masuk = $this->db->affected_rows();
                }
            }
            if ($daput['jenis_mutasi'] == 2) { //jika tahunan=2
                $objek = [
                        'id_tagihan' => $mutasi_keuangan_id.$tapel,
                        'mutasi_keuangan_id' => $mutasi_keuangan_id,
                        'bulan' => NULL,
                        'tahun' => NULL, 
                        'tapel' => $tapel,
                        'sem' => NULL,
                        'tagihan' => $tagihan
                    ];
                    $this->db->replace('tb_tagihan', $objek);
            }
        }else {
            echo json_encode([
                'sts' => 'false',
                'pesan' => 'tapel tidak valid'
            ]);
            return;
        }

        echo json_encode([
            'sts' => 'true',
            'pesan' => 'berhasil diproses!!!'
        ]);
    }else{
        echo json_encode([
            'sts' => 'false',
            'pesan' => 'isian tidak lengkap'
        ]);
    }
  }

  function namaBulan($month,$index=1) {
    $month = intval($month);
    $months = [
        1 => ['JAN', 'Januari'],
        2 => ['FEB', 'Februari'],
        3 => ['MAR', 'Maret'],
        4 => ['APR', 'April'],
        5 => ['MEI', 'Mei'],
        6 => ['JUN', 'Juni'],
        7 => ['JUL', 'Juli'],
        8 => ['AGU', 'Agustus'],
        9 => ['SEP', 'September'],
        10 => ['OKT', 'Oktober'],
        11 => ['NOV', 'November'],
        12 => ['DES', 'Desember']
    ];
    return isset($months[$month]) ? $months[$month][$index] : '';
}

  public function hitungTagihan(){
        $id_santri = 701;//$this->input->post('id_santri');
        $stringQ = "SELECT tg.`id_tagihan`, tg.`mutasi_keuangan_id`, tg.`tagihan`
                    FROM `tb_tagihan` tg
                    WHERE tg.`id_tagihan` NOT IN (SELECT ts.`tagihan_id`
                    FROM tb_transaksi ts 
                    WHERE ts.`santri_id` = $id_santri)
                    ORDER BY tg.`tahun`, tg.`id_tagihan`
                    ";
        $hasil = $this->db->query($stringQ)->result_array();
        foreach ($hasil as $key => $hs) {
            $keringanan = $this->cekKeringanan($hs['id_tagihan'], $id_santri);
            if ($hs['mutasi_keuangan_id'] == 2 ) {
                $hasil1 ['tahunan'][$key] = $hs ;
                $hasil1 ['tahunan'] [$key] ['keringanan'] =  $keringanan; 
            }else{
                $hasil1 ['bulanan'][$key] = $hs ;
                $hasil1 ['bulanan'] [$key] ['keringanan'] =  $keringanan;
                
                $bln_angka = substr($hs['id_tagihan'], -2, 2); 
                $thn_angka = substr($hs['id_tagihan'], -6, 4); 
                
                $txt_bln = $this->namaBulan($bln_angka,0);
                
                $hasil1 ['bulanan'] [$key] ['bln'] = $txt_bln ; 
                $hasil1 ['bulanan'] [$key] ['tahun'] = intval($bln_angka) > 6 ? $thn_angka - 1 : $thn_angka;
            }
        }
        echo json_encode($hasil1);
    }

function cekKeringanan($id_tagihan, $id_santri)
{
    $stringQ = "SELECT kr.`harus_dibayar`
                FROM tb_keringanan kr
                WHERE kr.`santri_id` = $id_santri
                AND kr.`tagihan_id` = $id_tagihan ";
    $hasil = $this->db->query($stringQ)->row_array();
    return ($hasil['harus_dibayar']);
  }
}

/* End of file keuangan.php */
/* Location: ./application/controllers/keuangan.php */