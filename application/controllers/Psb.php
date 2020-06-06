<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Psb extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('psb/p_data_awal_list');
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
		'id_data_awal' => $row->id_data_awal,
		'nama' => $row->nama,
		'nik' => $row->nik,
		'nisn' => $row->nisn,
		'alamat_pengenal' => $row->alamat_pengenal,
		'npsn_asal' => $row->npsn_asal,
		'desa_id' => $row->desa_id,
		'nohp' => $row->nohp,
		'proses' => $row->proses,
		'ijasah' => $row->ijasah,
		'skhu' => $row->skhu,
		'kk' => $row->kk,
		'akte' => $row->akte,
		'kartu' => $row->kartu,
		'keuangan' => $row->keuangan,
		'asesment' => $row->asesment,
		'verf_keuangan' => $row->verf_keuangan,
	    );
            $this->load->view('psb/p_data_awal_read', $data);
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
		'nohp' => set_value('nohp', $row->nohp),
		'proses' => set_value('proses', $row->proses),
		'ijasah' => set_value('ijasah', $row->ijasah),
		'skhu' => set_value('skhu', $row->skhu),
		'kk' => set_value('kk', $row->kk),
		'akte' => set_value('akte', $row->akte),
		'kartu' => set_value('kartu', $row->kartu),
		'keuangan' => set_value('keuangan', $row->keuangan),
		'asesment' => set_value('asesment', $row->asesment),
		'verf_keuangan' => set_value('verf_keuangan', $row->verf_keuangan),
	    );
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
	$this->form_validation->set_rules('alamat_pengenal', 'alamat pengenal', 'trim|required');
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

	$this->form_validation->set_rules('id_data_awal', 'id_data_awal', 'trim');
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

}

/* End of file Psb.php */
/* Location: ./application/controllers/Psb.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-06 02:19:16 */
/* http://harviacode.com */