<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akses_model extends CI_Model
{

    public $table = 'user_dapat_rule';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('d.id,d.user_id,d.rule_id, u.nama, r.nama_rule');
        $this->datatables->from('user_dapat_rule d');
        //add this line for join
        $this->datatables->join('user_data u', 'u.id_user = d.user_id');
        $this->datatables->join('user_rule r', 'r.id_rule = d.rule_id');
        $this->datatables->add_column('action', anchor(site_url('akses/read/$1'),'Read')." | ".anchor(site_url('akses/update/$1'),'Update')." | ".anchor(site_url('akses/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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

    // get data by data
    function get_by_data($where)
    {
        $this->db->where($where);
        return $this->db->get($this->table)->num_rows();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('user_id', $q);
	$this->db->or_like('rule_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('user_id', $q);
	$this->db->or_like('rule_id', $q);
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

/* End of file Akses_model.php */
/* Location: ./application/models/Akses_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-08 02:32:07 */
/* http://harviacode.com */