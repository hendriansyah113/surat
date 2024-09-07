<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Penduduk extends CI_Model
{

	public function get_all_penduduk()
	{
		$this->db->order_by('id_penduduk', 'DESC');
		return $this->db->get('penduduk')->result();
	}

	public function insert_penduduk($data)
	{
		return $this->db->insert('penduduk', $data);
	}

	public function get_penduduk_by_id($id_penduduk)
	{
		return $this->db->get_where('penduduk', array('id_penduduk' => $id_penduduk))->row_array();
	}

	public function update_penduduk($id, $data)
	{
		$this->db->where('id_penduduk', $id);
		return $this->db->update('penduduk', $data);
	}

	public function delete($id_penduduk)
	{
		return $this->db->delete('penduduk', array('id_penduduk' => $id_penduduk));
	}
}
