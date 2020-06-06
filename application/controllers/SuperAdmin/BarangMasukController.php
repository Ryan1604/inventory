<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasukController extends CI_Controller
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
                'title' => "Data Barang Masuk"
            );
            $data['barang']         = $this->db->query("SELECT * FROM barang_masuk INNER JOIN barang ON barang_masuk.id_barang = barang.id_barang")->result();
            $this->load->view('pages/SuperAdmin/barang_masuk/index.php', $data);
        } else {
            redirect('/');
        }
    }

    public function create()
    {
        if ($this->session->userdata('role') === '1') {
            $data = array(
                'title' => "Data Barang Masuk"
            );

            $data['barang']         = $this->db->query("SELECT * FROM barang")->result();
            $this->load->view('pages/SuperAdmin/barang_masuk/add', $data);
        } else {
            redirect('/');
        }
    }

    public function store()
    {
        $id_barang                  = $this->input->post('barang');
        $jumlah                     = $this->input->post('jumlah');
        $date                       = $this->input->post('date');
        $result                     = $this->M_Barang->check_id($id_barang);

        if ($result->num_rows() > 0) {
            $data    = $result->row_array();
            // Ambil data dari Database 
            $kode_barang             = $data['id_barang'];
            $baik                    = $data['baik'];
            if ($id_barang === $kode_barang) {
                $jumlahBaru = $baik + $jumlah;
            }
        }

        $data = array(
            'id_barang'             => $id_barang,
            'jumlah'                => $jumlah,
            'date'                  => $date
        );
        $this->db->insert('barang_masuk', $data);

        $data = array(
            'baik'                  => $jumlahBaru
        );
        $where = array('id_barang' => $kode_barang);
        $this->db->update('barang', $data, $where);
        redirect('superadmin/barang_masuk');
    }

    public function edit($id)
    {
        if ($this->session->userdata('role') === '1') {
            $data = array(
                'title' => "Data Barang Masuk"
            );
            $where = array('id_masuk' => $id);
            $data['barang']         = $this->db->query("SELECT * FROM barang")->result();
            $data['masuk'] = $this->db->query("SELECT * FROM barang_masuk WHERE id_masuk='$id'")->result();
            $this->load->view('pages/SuperAdmin/barang_masuk/edit', $data);
        } else {
            redirect('/');
        }
    }

    public function update()
    {
        $id                         = $this->input->post('id');
        $id_barang                  = $this->input->post('barang');
        $jumlahBaru                 = $this->input->post('jumlah');
        $date                       = $this->input->post('date');

        $result                     = $this->M_Barang->check_id_masuk($id);

        if ($result->num_rows() > 0) {
            $data    = $result->row_array();
            // Ambil data dari Database 
            $jumlah                = $data['jumlah'];
        }

        $result2                     = $this->M_Barang->check_id($id_barang);

        if ($result2->num_rows() > 0) {
            $data    = $result2->row_array();
            // Ambil data dari Database 
            $kode_barang             = $data['id_barang'];
            $baik                    = $data['baik'];
            if ($id_barang === $kode_barang) {
                $x1 = $baik - $jumlah;

                if ($x1) {
                    $x2 = $x1 + $jumlahBaru;
                }
            }
        }

        $data = array(
            'baik'                 => $x2
        );

        $where = array('id_barang' => $id_barang);
        $this->db->update('barang', $data, $where);

        $data = array(
            'id_barang'              => $id_barang,
            'jumlah'                 => $jumlahBaru,
            'date'                   => $date
        );

        $where = array('id_masuk' => $id);
        $this->db->update('barang_masuk', $data, $where);
        redirect('superadmin/barang_masuk');
    }

    public function delete($id)
    {

        $result                     = $this->M_Barang->check_id_masuk($id);

        if ($result->num_rows() > 0) {
            $data    = $result->row_array();
            // Ambil data dari Database 
            $id_barang             = $data['id_barang'];
            $jumlah                = $data['jumlah'];
        }

        $result2                     = $this->M_Barang->check_id($id_barang);

        if ($result2->num_rows() > 0) {
            $data    = $result2->row_array();
            // Ambil data dari Database 
            $kode_barang             = $data['id_barang'];
            $baik                    = $data['baik'];
            if ($id_barang === $kode_barang) {
                $jumlahBaru = $baik - $jumlah;
            }
        }

        $data = array(
            'baik'                  => $jumlahBaru
        );
        $where = array('id_barang' => $id_barang);
        $this->db->update('barang', $data, $where);

        $where = array('id_masuk' => $id);
        $this->db->delete('barang_masuk', $where);
        redirect('superadmin/barang_masuk');
    }
}
