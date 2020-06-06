<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Barang extends CI_Model
{

	public function check_id($id_barang)
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id_barang', $id_barang);
		$query = $this->db->get();

		return $query;
	}

	public function check_id_masuk($id)
	{
		$this->db->select('*');
		$this->db->from('barang_masuk');
		$this->db->where('id_masuk', $id);
		$query = $this->db->get();

		return $query;
	}

	public function check_id_keluar($id)
	{
		$this->db->select('*');
		$this->db->from('barang_keluar');
		$this->db->where('id_keluar', $id);
		$query = $this->db->get();

		return $query;
	}
}
