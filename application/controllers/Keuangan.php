<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {
	var $tahunAktif ;

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Raport_model','rm');
		$this->load->model('User_model','um');
		$this->load->model('Kelas_model','km');
		$this->tahunAktif = $this->um->tahunAktif();
	}

    public function cekAjax()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
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
    $stringQ = " SELECT n.`id_nominal`,m.`mutasi_keuangan`, n.`bulan`, n.`tahun`, n.`tapel`, n.`nominal`
                FROM tb_nominal n JOIN tb_mutasi_keuangan m
                WHERE m.`id_mutasi_keuangan` = n.`mutasi_keuangan_id`
                ORDER BY n.`tahun` ASC, n.`bulan` ASC 
                ";
    $data['nominal'] = $this->db->query($stringQ)->result_array();
    $isi = $this->load->view('keuangan/database',$data, true);
    echo $isi;
  }

  public function isi_database()
  {
    $data['judul'] = "database";
    $stringQ = " SELECT n.`id_nominal`,m.`mutasi_keuangan`, n.`bulan`, n.`tahun`, n.`tapel`, n.`nominal`
                FROM tb_nominal n JOIN tb_mutasi_keuangan m
                WHERE m.`id_mutasi_keuangan` = n.`mutasi_keuangan_id`
                ORDER BY n.`tahun` ASC, n.`bulan` ASC 
                ";
    $data['nominal'] = $this->db->query($stringQ)->result_array();
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

  public function hapusNominal()
  {
    $daput = $this->input->post();
    $this->db->delete('tb_nominal', $daput);
  }
  public function duaDigit($int)
  {
    if (strlen($int) < 2) {
        return '0'.$int;
    }
    return $int;
  }
  public function tambahNominal()
  {
    $this->cekAjax();
    $daput = $this->input->post('daput');
    $cek = $daput['tapel'] != "" && $daput['jenis_mutasi'] != "" && $daput['nominal_mutasi'] != "" ;
    if ($cek) {
        $tapel = $daput['tapel'];
        $mutasi_keuangan_id = $daput['jenis_mutasi'];
        $nominal = trim(str_replace('.','',$daput['nominal_mutasi']));
        
        //cek tapel valid apa tidak 
        $tapel1 = substr($tapel,0,4);
        $tapel2 = substr($tapel,4,4);
        if ($tapel2-$tapel1 == 1) {
            if ($daput['jenis_mutasi'] == 1 ) { //jikas SPP=1
                for ($i=1; $i<13; $i++) {
                    $tahun = ($i < 7) ? $tapel2 : $tapel1;
                    $sem = ($i < 7) ? 2 : 1;
                    $objek = [
                        'id_nominal' => $mutasi_keuangan_id.$tapel.$this->duaDigit($i),
                        'mutasi_keuangan_id' => $mutasi_keuangan_id,
                        'bulan' => $i,
                        'tahun' => $tahun, 
                        'tapel' => $tapel,
                        'sem' => $sem,
                        'nominal' => $nominal
                    ];
                    $this->db->replace('tb_nominal', $objek);
                }
            }
            if ($daput['jenis_mutasi'] == 2) { //jika tahunan=2
                $objek = [
                        'id_nominal' => $mutasi_keuangan_id.$tapel,
                        'mutasi_keuangan_id' => $mutasi_keuangan_id,
                        'bulan' => NULL,
                        'tahun' => NULL, 
                        'tapel' => $tapel,
                        'sem' => NULL,
                        'nominal' => $nominal
                    ];
                    $this->db->replace('tb_nominal', $objek);
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
            'pesan' => 'berhasil diproses'
        ]);
    }else{
        echo json_encode([
            'sts' => 'false',
            'pesan' => 'isian tidak lengkap'
        ]);
    }
  }
}

/* End of file keuangan.php */
/* Location: ./application/controllers/keuangan.php */