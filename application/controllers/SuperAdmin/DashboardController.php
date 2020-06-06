<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
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
				'title' => "Dashboard"
			);
			$data['barang'] 	   	= $this->db->query('SELECT * FROM barang')->num_rows();
			$data['unit'] 	   		= $this->db->query('SELECT * FROM category')->num_rows();
			$this->load->view('pages/SuperAdmin/dashboard/index.php', $data);
		} else {
			redirect('/');
		}
	}
}
