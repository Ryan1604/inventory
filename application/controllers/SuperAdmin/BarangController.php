<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangController extends CI_Controller
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
                'title' => "Data Barang"
            );
            $data['barang']         = $this->db->query("SELECT * FROM barang INNER JOIN category ON barang.id_category = category.id_category ORDER BY nama_barang DESC")->result();
            $this->load->view('pages/SuperAdmin/barang/index.php', $data);
        } else {
            redirect('/');
        }
    }

    public function create()
    {
        if ($this->session->userdata('role') === '1') {
            $data = array(
                'title' => "Data Barang"
            );

            $table = "barang";
            $field = "kode_barang";

            $prefix = "B";

            $lastCode = $this->M_Kode->generate($prefix, $table, $field);

            $noUrut = (int) substr($lastCode['kode_barang'], -3, 3);
            $noUrut++;

            $data['newCode'] = $prefix . sprintf('%03s', $noUrut);

            $data['category']         = $this->db->query("SELECT * FROM category")->result();
            $this->load->view('pages/SuperAdmin/barang/add', $data);
        } else {
            redirect('/');
        }
    }

    public function store()
    {
        $kode                       = $this->input->post('kode');
        $name                       = $this->input->post('name');
        $unit                       = $this->input->post('category');
        $baik                       = $this->input->post('baik');
        $rusak                      = $this->input->post('rusak');

        $data = array(
            'kode_barang'           => $kode,
            'id_category'           => $unit,
            'nama_barang'           => $name,
            'baik'                  => $baik,
            'rusak'                 => $rusak
        );
        $this->db->insert('barang', $data);
        redirect('superadmin/barang');
    }

    public function edit($id)
    {
        if ($this->session->userdata('role') === '1') {
            $data = array(
                'title' => "Data Barang"
            );
            $where = array('id_barang' => $id);
            $data['category']         = $this->db->query("SELECT * FROM category")->result();
            $data['barang'] = $this->db->query("SELECT c.id_category as id, c.name_category, b.id_barang, b.kode_barang, b.id_category, b.nama_barang, b.baik, b.rusak FROM barang b INNER JOIN (category c) ON (b.id_category = c.id_category) WHERE id_barang='$id'")->result();
            $this->load->view('pages/SuperAdmin/barang/edit', $data);
        } else {
            redirect('/');
        }
    }

    public function update()
    {
        $id                         = $this->input->post('id');
        $kode                       = $this->input->post('kode');
        $name                       = $this->input->post('name');
        $category                   = $this->input->post('category');
        $baik                       = $this->input->post('baik');
        $rusak                      = $this->input->post('rusak');

        $data = array(
            'kode_barang'            => $kode,
            'id_category'            => $category,
            'nama_barang'            => $name,
            'baik'                   => $baik,
            'rusak'                  => $rusak
        );

        $where = array('id_barang' => $id);
        $this->db->update('barang', $data, $where);
        redirect('superadmin/barang');
    }

    public function delete($id)
    {
        $where = array('id_barang' => $id);
        $this->db->delete('barang', $where);
        redirect('superadmin/barang');
    }
}
