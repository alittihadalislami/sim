<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Yayasan extends CI_Controller
{
    public $tahunAktif ;

    public function __construct()
    {
        parent::__construct();
        is_login();
        is_boleh();
        $this->load->model('User_model', 'um');
        $this->tahunAktif = $this->um->tahunAktif();
    }

    public function index()
    {
        $data['judul'] = 'Yayasan';

        $data['tahun_ajaran'] = $this->tahunAktif['nama_tahun'];

        $this->load->view('templates/header', $data);
        $this->load->view('yayasan/home', $data);
        $this->load->view('templates/footer');
    }

    public function tampilData($tahun='2023-2024', $niy=null)
    {
        $this->db->select('m.nama_asatid, p.*, l.lembaga, t.tugas');
        $this->db->from('t_penugasan p');
        $this->db->join('t_lembaga l', 'l.id_lembaga = p.lembaga_id', 'left');
        $this->db->join('t_tugas t', 'p.tugas_id = t.id_tugas', 'left');
        $this->db->join('m_asatid m', 'm.niy = p.niy', 'left');
        $this->db->where('p.tahun', $tahun);
        if ($niy != null) {
            $this->db->where('p.niy', $niy);
        }
        $this->db->order_by('l.id_lembaga', 'ASC');
        $this->db->order_by('p.tugas_id', 'ASC');
        $this->db->order_by('p.niy', 'ASC');
        $data = $this->db->get()->result_array();

        if ($niy != null) {
            return $data;
        }
        echo json_encode($data);
    }

    public function tampilSatuData($id)
    {
        $this->db->select('m.nama_asatid, p.*, l.lembaga, t.tugas');
        $this->db->from('t_penugasan p');
        $this->db->join('t_lembaga l', 'l.id_lembaga = p.lembaga_id', 'left');
        $this->db->join('t_tugas t', 'p.tugas_id = t.id_tugas', 'left');
        $this->db->join('m_asatid m', 'm.niy = p.niy', 'left');
        $this->db->where('p.id_penugasan', $id);
        $this->db->order_by('l.id_lembaga', 'ASC');
        $this->db->order_by('p.tugas_id', 'ASC');
        $this->db->order_by('p.niy', 'ASC');
        return $data = $this->db->get()->row_array();
    }

    public function buatSkYayasan($id)
    {
        $terpilih = $this->tampilSatuData($id);
        $jenjang = explode(" ", $terpilih['lembaga'])[0];

        $status_lengkap = [
            'guru tetap' => 'Guru Tetap Yayasan (GTY)',
            'guru tidak tetap' => 'Guru Tidak Tetap (GTT)',
            'pegawai tetap' => 'Pegawai Tetap Yayasan (PTY)',
            'pegawai tidak tetap' => 'Pegawai Tidak Tetap (PTT)'
        ];

        require_once 'vendor/autoload.php';
        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor('file/phpword/sk_yayasan-gupeg-2024.docx');
        $data = [
            'nomor_surat' => $terpilih['no_surat'],
            'jenis_surat' => 'PERPANJANGAN',
            'status' => strtoupper($terpilih['tugas'].' '.$terpilih['status']),
            'lembaga_kap' => strtoupper($terpilih['lembaga']),
            'status_lengkap' =>  $status_lengkap[$terpilih['tugas'].' '.$terpilih['status']],
            'lembaga' => $terpilih['lembaga'],
            'tahun_ajaran' => $terpilih['tahun'],
            'tmt' => $terpilih['tgl_ditetapkan'],
            'nama' => $terpilih['nama_asatid'],
            'niy' => $terpilih['niy'],
            'ttl' => 'Pamekasan, 10 Juli 20216',
            'alamat' => 'Jl. Raya Sudirman',
            'desa' => 'Ambat',
            'kec' => 'Tlanakan',
            'kab' => 'Pamekasan',
            'tgl_surat' => $terpilih['tgl_ditetapkan'],
            'mapel' => "",
            'dijenis' => 'Diperpanjang',
            'mejenis' => 'memperpanjang',
        ];

        $templateProcessor->setValues($data);

        // Menyiapkan untuk output ke browser
        $filename = 'SK Yayasan - '. $jenjang.' - '.$data['nama']. ' ('.$data['tahun_ajaran'].').docx';
        // Membuat output dengan format Word2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Menulis file ke output
        $templateProcessor->saveAs('php://output');
        exit;

        // // Menyimpan file hasil
        // $pathToSave = 'file/phpword/hasil/SK Yayasan - '. $jenjang.' - '.$data['nama']. ' ('.$data['tahun_ajaran'].').docx';
        // $templateProcessor->saveAs($pathToSave);


        // redirect('yayasan/index', 'refresh');
    }
}

/* End of file asatid.php */
/* Location: ./application/controllers/asatid.php */
