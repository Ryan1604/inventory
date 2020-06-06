<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UnitController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in' !== TRUE)) {
			redirect('/auth');
		}
	}

	public function index()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Inventaris Unit"
			);
			$data['category']	 	= $this->db->query("SELECT * FROM category")->result();
			$this->load->view('pages/SuperAdmin/unit/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function create()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Inventaris Unit"
			);
			$data['hak_akses'] = $this->M_Role->get_data()->result();
			$this->load->view('pages/SuperAdmin/unit/add', $data);
		} else {
			redirect('/');
		}
	}

	public function store()
	{
		$name                   = $this->input->post('name');

		$data = array(
			'name_category'			=> $name
		);

		$this->M_Unit->store($data, 'category');
		redirect('superadmin/unit');
	}

	public function edit($id)
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Inventaris Unit"
			);
			$where = array('id_auth' => $id);
			$data['category'] = $this->db->query("SELECT * FROM category WHERE id_category='$id'")->result();
			$this->load->view('pages/SuperAdmin/unit/edit', $data);
		} else {
			redirect('/');
		}
	}

	public function update()
	{
		$id					= $this->input->post('id');
		$name               = $this->input->post('name');

		$data = array(
			'name_category'				=> $name
		);

		$where = array('id_category' => $id);
		$this->M_Unit->update('category', $data, $where);
		redirect('superadmin/unit');
	}

	public function delete($id)
	{
		$where = array('id_category' => $id);
		$this->db->delete('category', $where);
		redirect('superadmin/unit');
	}
}
