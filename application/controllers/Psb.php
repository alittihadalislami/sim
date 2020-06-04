<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Psb extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model');
        $this->load->model('User_model','um');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('psb/p_pendaftaran_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Psb_model->json();
    }

    public function read($id) 
    {
        $row = $this->Psb_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pendaftaran' => $row->id_pendaftaran,
		'nama' => $row->nama,
		'nik' => $row->nik,
		'nisn' => $row->nisn,
		'npsn_asal' => $row->npsn_asal,
		'alamat_pengenal' => $row->alamat_pengenal,
		'nohp' => $row->nohp,
		'lp' => $row->lp,
		'tmp_lahir' => $row->tmp_lahir,
		'tgl_lahir' => $row->tgl_lahir,
		'anak_ke' => $row->anak_ke,
		'jml_saudara' => $row->jml_saudara,
		'bhs_hari' => $row->bhs_hari,
		'tinggal_dengan' => $row->tinggal_dengan,
		'goda' => $row->goda,
		'r_penyakit' => $row->r_penyakit,
		't_badan' => $row->t_badan,
		'b_badan' => $row->b_badan,
		'ukr_baju' => $row->ukr_baju,
		'nama_seijasah' => $row->nama_seijasah,
		'tmp_lahir_seijasah' => $row->tmp_lahir_seijasah,
		'tgl_lahir_seijasah' => $row->tgl_lahir_seijasah,
		'nopes' => $row->nopes,
		'nilai_ijasah' => $row->nilai_ijasah,
		'no_ijasah' => $row->no_ijasah,
		'no_skhu' => $row->no_skhu,
		'thn_ijs' => $row->thn_ijs,
		'nama_sekolah_asal' => $row->nama_sekolah_asal,
		'kls_akhir' => $row->kls_akhir,
		'tgl_daftar' => $row->tgl_daftar,
		'data_awal_id' => $row->data_awal_id,
		'nok' => $row->nok,
	    );
            $this->load->view('psb/p_pendaftaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('psb'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('psb/create_action'),
	    'id_pendaftaran' => set_value('id_pendaftaran'),
	    'nama' => set_value('nama'),
	    'nik' => set_value('nik'),
	    'nisn' => set_value('nisn'),
	    'npsn_asal' => set_value('npsn_asal'),
	    'alamat_pengenal' => set_value('alamat_pengenal'),
	    'nohp' => set_value('nohp'),
	    'lp' => set_value('lp'),
	    'tmp_lahir' => set_value('tmp_lahir'),
	    'tgl_lahir' => set_value('tgl_lahir'),
	    'anak_ke' => set_value('anak_ke'),
	    'jml_saudara' => set_value('jml_saudara'),
	    'bhs_hari' => set_value('bhs_hari'),
	    'tinggal_dengan' => set_value('tinggal_dengan'),
	    'goda' => set_value('goda'),
	    'r_penyakit' => set_value('r_penyakit'),
	    't_badan' => set_value('t_badan'),
	    'b_badan' => set_value('b_badan'),
	    'ukr_baju' => set_value('ukr_baju'),
	    'nama_seijasah' => set_value('nama_seijasah'),
	    'tmp_lahir_seijasah' => set_value('tmp_lahir_seijasah'),
	    'tgl_lahir_seijasah' => set_value('tgl_lahir_seijasah'),
	    'nopes' => set_value('nopes'),
	    'nilai_ijasah' => set_value('nilai_ijasah'),
	    'no_ijasah' => set_value('no_ijasah'),
	    'no_skhu' => set_value('no_skhu'),
	    'thn_ijs' => set_value('thn_ijs'),
	    'nama_sekolah_asal' => set_value('nama_sekolah_asal'),
	    'kls_akhir' => set_value('kls_akhir'),
	    'tgl_daftar' => set_value('tgl_daftar'),
	    'data_awal_id' => set_value('data_awal_id'),
	    'nok' => set_value('nok'),
	);
        $this->load->view('psb/p_pendaftaran_form', $data);
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
		'npsn_asal' => $this->input->post('npsn_asal',TRUE),
		'alamat_pengenal' => $this->input->post('alamat_pengenal',TRUE),
		'nohp' => $this->input->post('nohp',TRUE),
		'lp' => $this->input->post('lp',TRUE),
		'tmp_lahir' => $this->input->post('tmp_lahir',TRUE),
		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
		'anak_ke' => $this->input->post('anak_ke',TRUE),
		'jml_saudara' => $this->input->post('jml_saudara',TRUE),
		'bhs_hari' => $this->input->post('bhs_hari',TRUE),
		'tinggal_dengan' => $this->input->post('tinggal_dengan',TRUE),
		'goda' => $this->input->post('goda',TRUE),
		'r_penyakit' => $this->input->post('r_penyakit',TRUE),
		't_badan' => $this->input->post('t_badan',TRUE),
		'b_badan' => $this->input->post('b_badan',TRUE),
		'ukr_baju' => $this->input->post('ukr_baju',TRUE),
		'nama_seijasah' => $this->input->post('nama_seijasah',TRUE),
		'tmp_lahir_seijasah' => $this->input->post('tmp_lahir_seijasah',TRUE),
		'tgl_lahir_seijasah' => $this->input->post('tgl_lahir_seijasah',TRUE),
		'nopes' => $this->input->post('nopes',TRUE),
		'nilai_ijasah' => $this->input->post('nilai_ijasah',TRUE),
		'no_ijasah' => $this->input->post('no_ijasah',TRUE),
		'no_skhu' => $this->input->post('no_skhu',TRUE),
		'thn_ijs' => $this->input->post('thn_ijs',TRUE),
		'nama_sekolah_asal' => $this->input->post('nama_sekolah_asal',TRUE),
		'kls_akhir' => $this->input->post('kls_akhir',TRUE),
		'tgl_daftar' => $this->input->post('tgl_daftar',TRUE),
		'data_awal_id' => $this->input->post('data_awal_id',TRUE),
		'nok' => $this->input->post('nok',TRUE),
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
		'id_pendaftaran' => set_value('id_pendaftaran', $row->id_pendaftaran),
		'nama' => set_value('nama', $row->nama),
		'nik' => set_value('nik', $row->nik),
		'nisn' => set_value('nisn', $row->nisn),
		'npsn_asal' => set_value('npsn_asal', $row->npsn_asal),
		'alamat_pengenal' => set_value('alamat_pengenal', $row->alamat_pengenal),
		'nohp' => set_value('nohp', $row->nohp),
		'lp' => set_value('lp', $row->lp),
		'tmp_lahir' => set_value('tmp_lahir', $row->tmp_lahir),
		'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
		'anak_ke' => set_value('anak_ke', $row->anak_ke),
		'jml_saudara' => set_value('jml_saudara', $row->jml_saudara),
		'bhs_hari' => set_value('bhs_hari', $row->bhs_hari),
		'tinggal_dengan' => set_value('tinggal_dengan', $row->tinggal_dengan),
		'goda' => set_value('goda', $row->goda),
		'r_penyakit' => set_value('r_penyakit', $row->r_penyakit),
		't_badan' => set_value('t_badan', $row->t_badan),
		'b_badan' => set_value('b_badan', $row->b_badan),
		'ukr_baju' => set_value('ukr_baju', $row->ukr_baju),
		'nama_seijasah' => set_value('nama_seijasah', $row->nama_seijasah),
		'tmp_lahir_seijasah' => set_value('tmp_lahir_seijasah', $row->tmp_lahir_seijasah),
		'tgl_lahir_seijasah' => set_value('tgl_lahir_seijasah', $row->tgl_lahir_seijasah),
		'nopes' => set_value('nopes', $row->nopes),
		'nilai_ijasah' => set_value('nilai_ijasah', $row->nilai_ijasah),
		'no_ijasah' => set_value('no_ijasah', $row->no_ijasah),
		'no_skhu' => set_value('no_skhu', $row->no_skhu),
		'thn_ijs' => set_value('thn_ijs', $row->thn_ijs),
		'nama_sekolah_asal' => set_value('nama_sekolah_asal', $row->nama_sekolah_asal),
		'kls_akhir' => set_value('kls_akhir', $row->kls_akhir),
		'tgl_daftar' => set_value('tgl_daftar', $row->tgl_daftar),
		'data_awal_id' => set_value('data_awal_id', $row->data_awal_id),
		'nok' => set_value('nok', $row->nok),
	    );
            $this->load->view('psb/p_pendaftaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('psb'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pendaftaran', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'nisn' => $this->input->post('nisn',TRUE),
		'npsn_asal' => $this->input->post('npsn_asal',TRUE),
		'alamat_pengenal' => $this->input->post('alamat_pengenal',TRUE),
		'nohp' => $this->input->post('nohp',TRUE),
		'lp' => $this->input->post('lp',TRUE),
		'tmp_lahir' => $this->input->post('tmp_lahir',TRUE),
		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
		'anak_ke' => $this->input->post('anak_ke',TRUE),
		'jml_saudara' => $this->input->post('jml_saudara',TRUE),
		'bhs_hari' => $this->input->post('bhs_hari',TRUE),
		'tinggal_dengan' => $this->input->post('tinggal_dengan',TRUE),
		'goda' => $this->input->post('goda',TRUE),
		'r_penyakit' => $this->input->post('r_penyakit',TRUE),
		't_badan' => $this->input->post('t_badan',TRUE),
		'b_badan' => $this->input->post('b_badan',TRUE),
		'ukr_baju' => $this->input->post('ukr_baju',TRUE),
		'nama_seijasah' => $this->input->post('nama_seijasah',TRUE),
		'tmp_lahir_seijasah' => $this->input->post('tmp_lahir_seijasah',TRUE),
		'tgl_lahir_seijasah' => $this->input->post('tgl_lahir_seijasah',TRUE),
		'nopes' => $this->input->post('nopes',TRUE),
		'nilai_ijasah' => $this->input->post('nilai_ijasah',TRUE),
		'no_ijasah' => $this->input->post('no_ijasah',TRUE),
		'no_skhu' => $this->input->post('no_skhu',TRUE),
		'thn_ijs' => $this->input->post('thn_ijs',TRUE),
		'nama_sekolah_asal' => $this->input->post('nama_sekolah_asal',TRUE),
		'kls_akhir' => $this->input->post('kls_akhir',TRUE),
		'tgl_daftar' => $this->input->post('tgl_daftar',TRUE),
		'data_awal_id' => $this->input->post('data_awal_id',TRUE),
		'nok' => $this->input->post('nok',TRUE),
	    );

            $this->Psb_model->update($this->input->post('id_pendaftaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('psb'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Psb_model->get_by_id($id);

        if ($row) {
            $this->Psb_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
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
	$this->form_validation->set_rules('npsn_asal', 'npsn asal', 'trim|required');
	$this->form_validation->set_rules('alamat_pengenal', 'alamat pengenal', 'trim|required');
	$this->form_validation->set_rules('nohp', 'nohp', 'trim|required');
	$this->form_validation->set_rules('lp', 'lp', 'trim|required');
	$this->form_validation->set_rules('tmp_lahir', 'tmp lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
	$this->form_validation->set_rules('anak_ke', 'anak ke', 'trim|required');
	$this->form_validation->set_rules('jml_saudara', 'jml saudara', 'trim|required');
	$this->form_validation->set_rules('bhs_hari', 'bhs hari', 'trim|required');
	$this->form_validation->set_rules('tinggal_dengan', 'tinggal dengan', 'trim|required');
	$this->form_validation->set_rules('goda', 'goda', 'trim|required');
	$this->form_validation->set_rules('r_penyakit', 'r penyakit', 'trim|required');
	$this->form_validation->set_rules('t_badan', 't badan', 'trim|required');
	$this->form_validation->set_rules('b_badan', 'b badan', 'trim|required');
	$this->form_validation->set_rules('ukr_baju', 'ukr baju', 'trim|required');
	$this->form_validation->set_rules('nama_seijasah', 'nama seijasah', 'trim|required');
	$this->form_validation->set_rules('tmp_lahir_seijasah', 'tmp lahir seijasah', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir_seijasah', 'tgl lahir seijasah', 'trim|required');
	$this->form_validation->set_rules('nopes', 'nopes', 'trim|required');
	$this->form_validation->set_rules('nilai_ijasah', 'nilai ijasah', 'trim|required');
	$this->form_validation->set_rules('no_ijasah', 'no ijasah', 'trim|required');
	$this->form_validation->set_rules('no_skhu', 'no skhu', 'trim|required');
	$this->form_validation->set_rules('thn_ijs', 'thn ijs', 'trim|required');
	$this->form_validation->set_rules('nama_sekolah_asal', 'nama sekolah asal', 'trim|required');
	$this->form_validation->set_rules('kls_akhir', 'kls akhir', 'trim|required');
	$this->form_validation->set_rules('tgl_daftar', 'tgl daftar', 'trim|required');
	$this->form_validation->set_rules('data_awal_id', 'data awal id', 'trim|required');
	$this->form_validation->set_rules('nok', 'nok', 'trim|required');

	$this->form_validation->set_rules('id_pendaftaran', 'id_pendaftaran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "p_pendaftaran.xls";
        $judul = "p_pendaftaran";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Npsn Asal");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Pengenal");
	xlsWriteLabel($tablehead, $kolomhead++, "Nohp");
	xlsWriteLabel($tablehead, $kolomhead++, "Lp");
	xlsWriteLabel($tablehead, $kolomhead++, "Tmp Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Anak Ke");
	xlsWriteLabel($tablehead, $kolomhead++, "Jml Saudara");
	xlsWriteLabel($tablehead, $kolomhead++, "Bhs Hari");
	xlsWriteLabel($tablehead, $kolomhead++, "Tinggal Dengan");
	xlsWriteLabel($tablehead, $kolomhead++, "Goda");
	xlsWriteLabel($tablehead, $kolomhead++, "R Penyakit");
	xlsWriteLabel($tablehead, $kolomhead++, "T Badan");
	xlsWriteLabel($tablehead, $kolomhead++, "B Badan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ukr Baju");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Seijasah");
	xlsWriteLabel($tablehead, $kolomhead++, "Tmp Lahir Seijasah");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir Seijasah");
	xlsWriteLabel($tablehead, $kolomhead++, "Nopes");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Ijasah");
	xlsWriteLabel($tablehead, $kolomhead++, "No Ijasah");
	xlsWriteLabel($tablehead, $kolomhead++, "No Skhu");
	xlsWriteLabel($tablehead, $kolomhead++, "Thn Ijs");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Sekolah Asal");
	xlsWriteLabel($tablehead, $kolomhead++, "Kls Akhir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Daftar");
	xlsWriteLabel($tablehead, $kolomhead++, "Data Awal Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Nok");

	foreach ($this->Psb_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nisn);
	    xlsWriteLabel($tablebody, $kolombody++, $data->npsn_asal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_pengenal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nohp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tmp_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->anak_ke);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jml_saudara);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bhs_hari);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tinggal_dengan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->goda);
	    xlsWriteLabel($tablebody, $kolombody++, $data->r_penyakit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->t_badan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->b_badan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ukr_baju);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_seijasah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tmp_lahir_seijasah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir_seijasah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nopes);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_ijasah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_ijasah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_skhu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->thn_ijs);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_sekolah_asal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kls_akhir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_daftar);
	    xlsWriteNumber($tablebody, $kolombody++, $data->data_awal_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nok);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Psb.php */
/* Location: ./application/controllers/Psb.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-28 21:24:50 */
/* http://harviacode.com */