<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Psb_model extends CI_Model
{

    public $table = 'p_pendaftaran';
    public $id = 'id_pendaftaran';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select(
            'p_data_awal.proses,
            p_pendaftaran.id_pendaftaran,
        	p_pendaftaran.nama,
        	p_pendaftaran.nik,
        	p_pendaftaran.nisn,
        	p_pendaftaran.npsn_asal,
        	p_pendaftaran.alamat_pengenal,
        	p_pendaftaran.nohp,
        	p_pendaftaran.lp,
        	p_pendaftaran.tmp_lahir,
        	p_pendaftaran.tgl_lahir,
        	p_pendaftaran.anak_ke,
        	p_pendaftaran.jml_saudara,
        	p_pendaftaran.bhs_hari,
        	p_pendaftaran.tinggal_dengan,
        	p_pendaftaran.goda,
        	p_pendaftaran.r_penyakit,
        	p_pendaftaran.t_badan,
        	p_pendaftaran.b_badan,
        	p_pendaftaran.ukr_baju,
        	p_pendaftaran.nama_seijasah,
        	p_pendaftaran.tmp_lahir_seijasah,
        	p_pendaftaran.tgl_lahir_seijasah,
        	p_pendaftaran.nopes,
        	p_pendaftaran.nilai_ijasah,
        	p_pendaftaran.no_ijasah,
        	p_pendaftaran.no_skhu,
        	p_pendaftaran.thn_ijs,
        	p_pendaftaran.nama_sekolah_asal,
        	p_pendaftaran.kls_akhir,
        	p_pendaftaran.tgl_daftar,
        	p_pendaftaran.data_awal_id,
        	p_pendaftaran.nok,
            p_data_awal.skhu');
        $this->datatables->from('p_pendaftaran');
        //add this line for join
        $this->datatables->join('p_data_awal', 'p_pendaftaran.data_awal_id = p_data_awal.id_data_awal');

        $this->datatables->add_column('action', anchor(site_url('psb/read/$1'),'Read')." | ".anchor(site_url('psb/update/$1'),'Update')." | ".anchor(site_url('psb/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'ukr_baju','nok');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_pendaftaran', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('nisn', $q);
	$this->db->or_like('npsn_asal', $q);
	$this->db->or_like('alamat_pengenal', $q);
	$this->db->or_like('nohp', $q);
	$this->db->or_like('lp', $q);
	$this->db->or_like('tmp_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('anak_ke', $q);
	$this->db->or_like('jml_saudara', $q);
	$this->db->or_like('bhs_hari', $q);
	$this->db->or_like('tinggal_dengan', $q);
	$this->db->or_like('goda', $q);
	$this->db->or_like('r_penyakit', $q);
	$this->db->or_like('t_badan', $q);
	$this->db->or_like('b_badan', $q);
	$this->db->or_like('ukr_baju', $q);
	$this->db->or_like('nama_seijasah', $q);
	$this->db->or_like('tmp_lahir_seijasah', $q);
	$this->db->or_like('tgl_lahir_seijasah', $q);
	$this->db->or_like('nopes', $q);
	$this->db->or_like('nilai_ijasah', $q);
	$this->db->or_like('no_ijasah', $q);
	$this->db->or_like('no_skhu', $q);
	$this->db->or_like('thn_ijs', $q);
	$this->db->or_like('nama_sekolah_asal', $q);
	$this->db->or_like('kls_akhir', $q);
	$this->db->or_like('tgl_daftar', $q);
	$this->db->or_like('data_awal_id', $q);
	$this->db->or_like('nok', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pendaftaran', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('nisn', $q);
	$this->db->or_like('npsn_asal', $q);
	$this->db->or_like('alamat_pengenal', $q);
	$this->db->or_like('nohp', $q);
	$this->db->or_like('lp', $q);
	$this->db->or_like('tmp_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('anak_ke', $q);
	$this->db->or_like('jml_saudara', $q);
	$this->db->or_like('bhs_hari', $q);
	$this->db->or_like('tinggal_dengan', $q);
	$this->db->or_like('goda', $q);
	$this->db->or_like('r_penyakit', $q);
	$this->db->or_like('t_badan', $q);
	$this->db->or_like('b_badan', $q);
	$this->db->or_like('ukr_baju', $q);
	$this->db->or_like('nama_seijasah', $q);
	$this->db->or_like('tmp_lahir_seijasah', $q);
	$this->db->or_like('tgl_lahir_seijasah', $q);
	$this->db->or_like('nopes', $q);
	$this->db->or_like('nilai_ijasah', $q);
	$this->db->or_like('no_ijasah', $q);
	$this->db->or_like('no_skhu', $q);
	$this->db->or_like('thn_ijs', $q);
	$this->db->or_like('nama_sekolah_asal', $q);
	$this->db->or_like('kls_akhir', $q);
	$this->db->or_like('tgl_daftar', $q);
	$this->db->or_like('data_awal_id', $q);
	$this->db->or_like('nok', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Psb_model.php */
/* Location: ./application/models/Psb_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-28 21:24:50 */
/* http://harviacode.com */