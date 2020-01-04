<?php 
class My404 extends CI_Controller 
{
 public function __construct() 
 {
    parent::__construct(); 
    $this->load->model('User_model','um');
 } 

 public function index() 
 { 
 	$data['judul'] = 'Block';
 	$this->load->vars($data);
    $this->output->set_status_header('404'); 
    $this->load->view('templates/header');//loading in custom error view
    $this->load->view('blocker');//loading in custom error view
    $this->load->view('templates/footer');//loading in custom error view
 } 
}