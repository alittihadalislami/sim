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

		$nohp = $this->um->dataAktif($this->session->userdata('email'))['nohp'];
		$id_asatid = /*265;//*/ $this->um->idAsatid($nohp)['id_asatid'];

		$data['jadwal'] = $this->am->jadwalHariIni($hari,$id_asatid);


		if ( count($data['jadwal']) < 1) {
			
			$this->load->view('templates/header', $data);
			$this->load->view('absensi/home', $data);
			$this->load->view('templates/footer');				
		}

		$this->load->view('templates/header', $data);
		$this->load->view('absensi/home', $data);
		$this->load->view('templates/footer');	
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
		$waktu ['tanggal'] = date("j");
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

		// var_dump($absensi);die();

		foreach ($absensi as $ab) {
			$this->db->replace('t_absensi', $ab);
		}

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

}

/* End of file absensi.php */
/* Location: ./application/controllers/absensi.php */