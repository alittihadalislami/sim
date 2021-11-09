<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Psb extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        is_boleh();
        $this->load->model('Psb_model');
        $this->load->model('User_model','um');
        $this->load->model('Kelas_model','km');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {	
    	$data['judul'] = 'PSB';
    	$this->load->view('templates/header', $data);
        $this->load->view('psb/p_data_awal_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Psb_model->json();
    }

    function getText($name_field,$value=null){
    	if ($value == null) {
    		return '';
    	}

    	$id_tabel_baris = $this->db->select('id_kolom')->get_where('u_tabel_baris',['name_kolom' => $name_field])->row()->id_kolom;

    	$this->db->select('select');
    	$this->db->where(['tabel_baris_id'=>$id_tabel_baris,'value'=>$value]);
    	return $this->db->get('u_tabel_pilihan')->row()->select;
    }

    public function read($id) 
    {
        $row = $this->Psb_model->get_by_id($id);
        $detail = $this->db->get_where('p_pendaftaran', ['data_awal_id'=> $id])->row();
        $wali = $this->db->get_where('p_wali_pendaftaran', ['data_awal_id'=> $id])->result();

        if ($detail) {
        	$pendidikan ['Nama'] = $detail->nama_seijasah;
			$pendidikan ['Tempat Lahir'] = $detail->tmp_lahir_seijasah;
			$pendidikan ['Tanggal Lahir'] = $detail->tgl_lahir_seijasah;
			$pendidikan ['No Peserta'] = $detail->nopes;
			$pendidikan ['Jumlah Nilai Ijasah'] = $detail->nilai_ijasah;
			$pendidikan ['Seri Ijasah'] = $detail->no_ijasah;
			$pendidikan ['Seri SKHU'] = $detail->no_skhu;
			$pendidikan ['Tahun Ijasah'] = $detail->thn_ijs;
			$pendidikan ['Sekolah Asal'] = $detail->nama_sekolah_asal;
			$pendidikan ['Status'] = $this->getText('kls_akhir',$detail->kls_akhir);
        }else{
        	$this->session->set_flashdata('message', $row->nama.' belum mengisi formulir');
            redirect(site_url('psb'));
        }

        
        $data = array(
			'id_data_awal' => $row->id_data_awal,
			'desa_id' => $row->desa_id,
			'proses' => $row->proses,
			'asesment' => $row->asesment,
	    );

	    // //file upload
        $doc = ['keuangan','ijasah','skhu','kk','akte','kartu'];

        $upload_berkas = [];
        foreach ($doc as $nama_file) {
 			
 			$cek = $row->$nama_file != NULL OR $row->$nama_file != ''; 

	        if ($cek) {
 				$upload_berkas [$nama_file] = $row->$nama_file;
	        }
        }

        //generate desa
        $alamat = $this->Psb_model->tampilDesa($row->desa_id);
        $alamat_lengkap = 'DESA '.$alamat['ds'].', '.'KEC. '.$alamat['kec'].', '.$alamat['kab'].', '.'PROP. '.$alamat['prop'];
        $alamat_lengkap = ucwords(strtolower($alamat_lengkap));

        //data diri 
        
        if ($detail->tmp_lahir == null || $detail->tmp_lahir == '') {
            $tempat_lahir = '<span class="badge badge-secondary">kososng</span>';
        }else{
            $tempat_lahir = $detail->tmp_lahir;
        }

        if ($detail->tgl_lahir == null || $detail->tgl_lahir == '') {
            $tanggal_lahir = '<span class="badge badge-secondary">kososng</span>';
        }else{
            $tanggal_lahir = $detail->tgl_lahir;
        }

        $diri = [
			'Nama' => $row->nama,
			'NIK' => $row->nik,
			'NISN' => $row->nisn,
			'NPSN Asal' => $row->npsn_asal,
			'Alamat Rumah ' => $row->alamat_pengenal.'<br><strong>'.$alamat_lengkap.'</strong>',
			'No HP' => $row->nohp,
			'Jenis Kelamin' => $this->getText('lp',$detail->lp),
			'TTL' => $tempat_lahir.', '.$tanggal_lahir,
			'Anak ke' => $detail->anak_ke,
			'Saudara' =>  $detail->jml_saudara,
			'Tinggal dengan' => $this->getText('tinggal_dengan',$detail->tinggal_dengan),
			'Gol Darah' => $this->getText('goda',$detail->goda),
			'Riwayat Penyakit' => $detail->r_penyakit,
			'Tinggi/berat' => $detail->t_badan,
			'Ukuran baju' => $detail->b_badan
		];


        if ($wali) {
        	$sts = [
        		1 => 'Bapak',
        		2 => 'Ibu',
        		3 => 'Wali'
        	];

        	$ortu ['Nomor Kartu Keluarga'] = $detail->nok;
        	
        	foreach ($wali as $wl) {
        		foreach ($sts as $key => $value) {
	        		if ($wl->sts == $key ) {
						$ortu ['Nama '.$value] = $wl->nama_ortu;
						$ortu ['NIK '.$value] = $wl->nik_ortu;
						$ortu ['Tempat lahir '.$value] = $wl->tmp_lahir_ortu;
						$ortu ['Tanggal lahir '.$value] = $wl->tgl_lahir_ortu;
						$ortu ['Pendidikan '.$value] = $this->getText('pendidikan_ortu', $wl->pendidikan_ortu);
						$ortu ['Pekerjaan '.$value] = $this->getText('pekerjaan_ortu',$wl->pekerjaan_ortu);
						$ortu ['Penghasilan '.$value] = $this->getText('penghasilan_ortu',$wl->penghasilan_ortu);
						$ortu ['No HP '.$value] = $wl->no_hp_ortu;
						$ortu ['Keterangan '.$value] = $this->getText('keterangan_ortu',$wl->keterangan_ortu);
	        		}
        		}
        	}
        }

        $data ['data_upload'] = $upload_berkas;
        $data ['data_diri'] = $diri;
        $data ['data_ortu'] = $ortu;
        $data ['data_pendidikan'] = $pendidikan;
 
        $data['judul'] = "Detail santri";

        // var_dump($data['data_upload']);die();

        $this->load->view('templates/header', $data);
        $this->load->view('psb/p_data_awal_read', $data);


    }

    function lihat(){





		   $img = "https://psb.alittihadalislami.org/uploads/18-Lagi-ijasah.jpeg";

		   echo "<img src=$img>";

    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('psb/create_action'),
	    'id_data_awal' => set_value('id_data_awal'),
	    'nama' => set_value('nama'),
	    'nik' => set_value('nik'),
	    'nisn' => set_value('nisn'),
	    'alamat_pengenal' => set_value('alamat_pengenal'),
	    'npsn_asal' => set_value('npsn_asal'),
	    'desa_id' => set_value('desa_id'),
	    'nohp' => set_value('nohp'),
	    'proses' => set_value('proses'),
	    'ijasah' => set_value('ijasah'),
	    'skhu' => set_value('skhu'),
	    'kk' => set_value('kk'),
	    'akte' => set_value('akte'),
	    'kartu' => set_value('kartu'),
	    'keuangan' => set_value('keuangan'),
	    'asesment' => set_value('asesment'),
	    'verf_keuangan' => set_value('verf_keuangan'),
	);
        $this->load->view('psb/p_data_awal_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'nisn' => $this->input->post('nisn',TRUE),
		'alamat_pengenal' => $this->input->post('alamat_pengenal',TRUE),
		'npsn_asal' => $this->input->post('npsn_asal',TRUE),
		'desa_id' => $this->input->post('desa_id',TRUE),
		'nohp' => $this->input->post('nohp',TRUE),
		'proses' => $this->input->post('proses',TRUE),
		'ijasah' => $this->input->post('ijasah',TRUE),
		'skhu' => $this->input->post('skhu',TRUE),
		'kk' => $this->input->post('kk',TRUE),
		'akte' => $this->input->post('akte',TRUE),
		'kartu' => $this->input->post('kartu',TRUE),
		'keuangan' => $this->input->post('keuangan',TRUE),
		'asesment' => $this->input->post('asesment',TRUE),
		'verf_keuangan' => $this->input->post('verf_keuangan',TRUE),
	    );

            $this->Psb_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('psb'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Psb_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('psb/update_action'),
				'id_data_awal' => set_value('id_data_awal', $row->id_data_awal),
				'nama' => set_value('nama', $row->nama),
				'nik' => set_value('nik', $row->nik),
				'nisn' => set_value('nisn', $row->nisn),
				'alamat_pengenal' => set_value('alamat_pengenal', $row->alamat_pengenal),
				'npsn_asal' => set_value('npsn_asal', $row->npsn_asal),
				'desa_id' => set_value('desa_id', $row->desa_id),
				'tampil_desa' => $this->Psb_model->tampilDesa($row->desa_id),
				'nohp' => set_value('nohp', $row->nohp),
				/*'proses' => set_value('proses', $row->proses),
				'ijasah' => set_value('ijasah', $row->ijasah),
				'skhu' => set_value('skhu', $row->skhu),
				'kk' => set_value('kk', $row->kk),
				'akte' => set_value('akte', $row->akte),
				'kartu' => set_value('kartu', $row->kartu),
				'keuangan' => set_value('keuangan', $row->keuangan),
				'asesment' => set_value('asesment', $row->asesment),
				'verf_keuangan' => set_value('verf_keuangan', $row->verf_keuangan),*/
	    );
    		$data['judul'] = 'Update Data Awal';
    		$this->load->view('templates/header', $data);
            $this->load->view('psb/p_data_awal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('psb'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_data_awal', TRUE));
        } else {
            $data = array(
			'nama' => $this->input->post('nama',TRUE),
			'nik' => $this->input->post('nik',TRUE),
			'nisn' => $this->input->post('nisn',TRUE),
			'alamat_pengenal' => $this->input->post('alamat_pengenal',TRUE),
			'npsn_asal' => $this->input->post('npsn_asal',TRUE),
			'desa_id' => $this->input->post('desa_id',TRUE),
			'nohp' => $this->input->post('nohp',TRUE),
			/*'proses' => $this->input->post('proses',TRUE),
			'ijasah' => $this->input->post('ijasah',TRUE),
			'skhu' => $this->input->post('skhu',TRUE),
			'kk' => $this->input->post('kk',TRUE),
			'akte' => $this->input->post('akte',TRUE),
			'kartu' => $this->input->post('kartu',TRUE),
			'keuangan' => $this->input->post('keuangan',TRUE),
			'asesment' => $this->input->post('asesment',TRUE),
			'verf_keuangan' => $this->input->post('verf_keuangan',TRUE),*/
	    );

            $this->Psb_model->update($this->input->post('id_data_awal', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('psb'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Psb_model->get_by_id($id);

        if ($row) {
            $this->Psb_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus '.$row->nama.' Success');
            redirect(site_url('psb'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('psb'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('nisn', 'nisn', 'trim|required');
/*	$this->form_validation->set_rules('alamat_pengenal', 'alamat pengenal', 'trim|required');
	$this->form_validation->set_rules('npsn_asal', 'npsn asal', 'trim|required');
	$this->form_validation->set_rules('desa_id', 'desa id', 'trim|required');
	$this->form_validation->set_rules('nohp', 'nohp', 'trim|required');
	$this->form_validation->set_rules('proses', 'proses', 'trim|required');
	$this->form_validation->set_rules('ijasah', 'ijasah', 'trim|required');
	$this->form_validation->set_rules('skhu', 'skhu', 'trim|required');
	$this->form_validation->set_rules('kk', 'kk', 'trim|required');
	$this->form_validation->set_rules('akte', 'akte', 'trim|required');
	$this->form_validation->set_rules('kartu', 'kartu', 'trim|required');
	$this->form_validation->set_rules('keuangan', 'keuangan', 'trim|required');
	$this->form_validation->set_rules('asesment', 'asesment', 'trim|required');
	$this->form_validation->set_rules('verf_keuangan', 'verf keuangan', 'trim|required');

	$this->form_validation->set_rules('id_data_awal', 'id_data_awal', 'trim');*/
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "p_data_awal.xls";
        $judul = "p_data_awal";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Nisn");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Pengenal");
	xlsWriteLabel($tablehead, $kolomhead++, "Npsn Asal");
	xlsWriteLabel($tablehead, $kolomhead++, "Desa Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Nohp");
	xlsWriteLabel($tablehead, $kolomhead++, "Proses");
	xlsWriteLabel($tablehead, $kolomhead++, "Ijasah");
	xlsWriteLabel($tablehead, $kolomhead++, "Skhu");
	xlsWriteLabel($tablehead, $kolomhead++, "Kk");
	xlsWriteLabel($tablehead, $kolomhead++, "Akte");
	xlsWriteLabel($tablehead, $kolomhead++, "Kartu");
	xlsWriteLabel($tablehead, $kolomhead++, "Keuangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Asesment");
	xlsWriteLabel($tablehead, $kolomhead++, "Verf Keuangan");

	foreach ($this->Psb_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nisn);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_pengenal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->npsn_asal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->desa_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nohp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->proses);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ijasah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->skhu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->akte);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kartu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keuangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->asesment);
	    xlsWriteLabel($tablebody, $kolombody++, $data->verf_keuangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=p_data_awal.doc");

        $data = array(
            'p_data_awal_data' => $this->Psb_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('psb/p_data_awal_doc',$data);
    }

    function listPropinsi()
    {
        $this->db->where('char_length(kode)', 2);
        $data = $this->db->get('wilayah_2020')->result_array();
        
        echo json_encode($data);
    }

    function listKabupaten()
    {   $id = $this->input->post('id',true);

        $this->db->where('char_length(kode)', 5);
        $this->db->like('kode', $id, 'after');
        $data = $this->db->get('wilayah_2020')->result_array();
        
        echo json_encode($data);
    }

    function listKecamatan()
    {   $id = $this->input->post('id',true);

        $this->db->where('char_length(kode)', 8);
        $this->db->like('kode', $id, 'after');
        $data = $this->db->get('wilayah_2020')->result_array();

        echo json_encode($data);
    }

    function listDesa()
    {   $id = $this->input->post('id',true);

        $this->db->where('char_length(kode)', 13);
        $this->db->like('kode', $id, 'after');
        $data = $this->db->get('wilayah_2020')->result_array();

        echo json_encode($data);
    }

    public function diterima($id)
    {
       $csantri = $this->db->get_where('p_data_awal', ['id_data_awal' => $id])->row_array();
       $santri['nama_santri'] = ucwords(strtolower($csantri['nama']));
       $santri['nisn'] = $csantri['nisn'];
       
       /*Manual Tanggal diterima*/
       $diterima = '13/07/2020';


       $this->db->where('id_data_awal', $id);
       $this->db->update('p_data_awal', ['diterima' => $diterima]);
       $induk = $this->km->indukAkhir();

       $santri['idk_mii'] = $induk['mii']+1;

       $this->db->where([
        'nama_santri' => $santri['nama_santri'],
        'nisn' => $santri['nisn']
        ]);
       $ada = $this->db->get('m_santri')->num_rows();
       
       if ($ada < 1) {
           $this->db->insert('m_santri', $santri);
           $id_santri = $this->db->insert_id();
           redirect('santri/pilihkelas/'.$id_santri,'refresh');
       }else{
            $this->session->set_flashdata('message', 'Santri Tersebut sudah punya kelas');
            redirect('psb/index','refresh');
       }
    }

}

/* End of file Psb.php */
/* Location: ./application/controllers/Psb.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-06 02:19:16 */
/* http://harviacode.com */