<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once(APPPATH . 'libraries/phpqrcode/qrlib.php');

class QrKode
{
    public function generate($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4)
    {
        // Menghasilkan kode QR
        QRcode::png($text, $outfile, $level, $size, $margin);
    }
}
