<?php

class M_Kode extends CI_Model
{
    public function generate($prefix =  null, $table = null, $field = null)
    {
        $this->db->select('kode_barang');
        $this->db->like($field, $prefix, 'after');
        $this->db->order_by($field, 'desc');
        $this->db->limit(1);

        return $this->db->get($table)->row_array();
    }
}
