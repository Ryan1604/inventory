<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KondisiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in' !== TRUE)) {
            redirect('/');
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') === '1') {
            $data = array(
                'title' => "Data Kondisi Barang"
            );
            $data['barang']         = $this->db->query("SELECT * FROM barang INNER JOIN category ON barang.id_category = category.id_category ORDER BY nama_barang DESC")->result();
            $this->load->view('pages/SuperAdmin/kondisi/index.php', $data);
        } else {
            redirect('/');
        }
    }
}
