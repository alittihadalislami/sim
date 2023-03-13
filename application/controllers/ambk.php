<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ambk extends CI_Controller {
	public function index()
	{
        $this->load->view('ambk/link_ambk');
    }
}