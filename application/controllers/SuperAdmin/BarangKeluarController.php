<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluarController extends CI_Controller
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
                'title' => "Data Barang Keluar"
            );
            $data['barang']         = $this->db->query("SELECT * FROM barang_keluar INNER JOIN barang ON barang_keluar.id_barang = barang.id_barang")->result();
            $this->load->view('pages/SuperAdmin/barang_keluar/index.php', $data);
        } else {
            redirect('/');
        }
    }

    public function create()
    {
        if ($this->session->userdata('role') === '1') {
            $data = array(
                'title' => "Data Barang Keluar"
            );

            $data['barang']         = $this->db->query("SELECT * FROM barang")->result();
            $this->load->view('pages/SuperAdmin/barang_keluar/add', $data);
        } else {
            redirect('/');
        }
    }

    public function store()
    {
        $id_barang                  = $this->input->post('barang');
        $jumlah                     = $this->input->post('jumlah');
        $date                       = $this->input->post('date');
        $ket                        = $this->input->post('ket');
        $result                     = $this->M_Barang->check_id($id_barang);

        if ($ket === 'Rusak') {
            if ($result->num_rows() > 0) {
                $data    = $result->row_array();
                // Ambil data dari Database 
                $kode_barang             = $data['id_barang'];
                $baik                    = $data['baik'];
                $rusak                   = $data['rusak'];
                if ($id_barang === $kode_barang) {
                    $jumlahBaru = $rusak + $jumlah;
                    $x = $baik - $jumlah;

                    $data = array(
                        'baik'                   => $x,
                        'rusak'                  => $jumlahBaru
                    );
                    $where = array('id_barang' => $kode_barang);
                    $this->db->update('barang', $data, $where);
                }
            }
        } elseif ($ket === 'Pembuangan') {
            if ($result->num_rows() > 0) {
                $data    = $result->row_array();
                // Ambil data dari Database 
                $kode_barang             = $data['id_barang'];
                $rusak                   = $data['rusak'];
                if ($id_barang === $kode_barang) {
                    $jumlahBaru = $rusak - $jumlah;

                    $data = array(
                        'rusak'                  => $jumlahBaru
                    );
                    $where = array('id_barang' => $kode_barang);
                    $this->db->update('barang', $data, $where);
                }
            }
        }

        $data = array(
            'id_barang'             => $id_barang,
            'jumlah'                => $jumlah,
            'date'                  => $date,
            'keterangan'            => $ket
        );
        $this->db->insert('barang_keluar', $data);

        redirect('superadmin/barang_keluar');
    }

    public function edit($id)
    {
        if ($this->session->userdata('role') === '1') {
            $data = array(
                'title' => "Data Barang Keluar"
            );
            $where = array('id_keluar' => $id);
            $data['barang']         = $this->db->query("SELECT * FROM barang")->result();
            $data['keluar']         = $this->db->query("SELECT * FROM barang_keluar WHERE id_keluar='$id'")->result();
            $this->load->view('pages/SuperAdmin/barang_keluar/edit', $data);
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
        $ket                        = $this->input->post('ket');
        $result                     = $this->M_Barang->check_id_keluar($id);

        if ($result->num_rows() > 0) {
            $data    = $result->row_array();
            // Ambil data dari Database 
            $jumlahLama               = $data['jumlah'];
        }


        $result2                     = $this->M_Barang->check_id($id_barang);

        if ($ket === 'Rusak') {
            if ($result2->num_rows() > 0) {
                $data    = $result2->row_array();
                // Ambil data dari Database 
                $kode_barang             = $data['id_barang'];
                $baik                    = $data['baik'];
                $rusakLama               = $data['rusak'];
                if ($id_barang === $kode_barang) {
                    $rusak1 = $rusakLama - $jumlahLama;
                    $baik1  = $baik + $jumlahLama;

                    if ($rusak1) {
                        $x2 = $rusak1 + $jumlahBaru;
                        $x3 = $baik1 - $jumlahBaru;
                    }

                    $data = array(
                        'baik'                   => $x3,
                        'rusak'                  => $x2
                    );
                    $where = array('id_barang' => $kode_barang);
                    $this->db->update('barang', $data, $where);
                }
            }
        } elseif ($ket === 'Pembuangan') {
            if ($result2->num_rows() > 0) {
                $data    = $result2->row_array();
                // Ambil data dari Database 
                $kode_barang             = $data['id_barang'];
                $baik                    = $data['baik'];
                $rusakLama               = $data['rusak'];
                if ($id_barang === $kode_barang) {
                    $rusak1 = $rusakLama - $jumlahLama;
                    $baik1  = $baik + $jumlahLama;

                    if ($rusak1) {
                        $x2 = $rusak1 - $jumlahBaru;
                    }

                    $data = array(
                        'baik'                   => $baik1,
                        'rusak'                  => $x2
                    );
                    $where = array('id_barang' => $kode_barang);
                    $this->db->update('barang', $data, $where);
                }
            }
        }

        $data = array(
            'id_barang'              => $id_barang,
            'jumlah'                 => $jumlahBaru,
            'date'                   => $date,
            'keterangan'             => $ket
        );

        $where = array('id_keluar' => $id);
        $this->db->update('barang_keluar', $data, $where);
        redirect('superadmin/barang_keluar');
    }

    public function delete($id)
    {

        $result                     = $this->M_Barang->check_id_keluar($id);

        if ($result->num_rows() > 0) {
            $data    = $result->row_array();
            // Ambil data dari Database 
            $id_barang             = $data['id_barang'];
            $jumlahLama                = $data['jumlah'];
            $ket                   = $data['keterangan'];
        }

        $result2                     = $this->M_Barang->check_id($id_barang);

        if ($ket === 'Rusak') {
            if ($result2->num_rows() > 0) {
                $data    = $result2->row_array();
                // Ambil data dari Database 
                $kode_barang             = $data['id_barang'];
                $baik                    = $data['baik'];
                $rusakLama               = $data['rusak'];
                if ($id_barang === $kode_barang) {
                    $rusak1 = $rusakLama - $jumlahLama;
                    $baik1  = $baik + $jumlahLama;

                    $data = array(
                        'baik'                   => $baik1,
                        'rusak'                  => $rusak1
                    );
                    $where = array('id_barang' => $kode_barang);
                    $this->db->update('barang', $data, $where);
                }
            }
        } elseif ($ket === 'Pembuangan') {
            if ($result2->num_rows() > 0) {
                $data    = $result2->row_array();
                // Ambil data dari Database 
                $kode_barang             = $data['id_barang'];
                $baik                    = $data['baik'];
                $rusakLama               = $data['rusak'];
                if ($id_barang === $kode_barang) {
                    $rusak1 = $rusakLama + $jumlahLama;

                    $data = array(
                        'rusak'                  => $rusak1
                    );
                    $where = array('id_barang' => $kode_barang);
                    $this->db->update('barang', $data, $where);
                }
            }
        }
        $where = array('id_keluar' => $id);
        $this->db->delete('barang_keluar', $where);
        redirect('superadmin/barang_keluar');
    }
}
