<?php

defined('BASEPATH') or exit('No direct script access allowed');

// Cek apakah TCPDF sudah diinstal via Composer atau manual
if (file_exists(APPPATH . 'third_party/tcpdf/tcpdf.php')) {
    require_once(APPPATH . 'third_party/tcpdf/tcpdf.php');
} elseif (file_exists(FCPATH . 'vendor/tecnickcom/tcpdf/tcpdf.php')) {
    require_once(FCPATH . 'vendor/tecnickcom/tcpdf/tcpdf.php');
} else {
    exit('TCPDF library not found.');
}

class Tcpdf_gen extends TCPDF
{
    public function __construct()
    {
        parent::__construct();
    }
}
