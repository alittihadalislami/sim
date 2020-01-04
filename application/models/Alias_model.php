<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alias_model extends User_model

function Alias_Model()
{
    parent::User_model();
    $this->load->model('User_model','um');
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */