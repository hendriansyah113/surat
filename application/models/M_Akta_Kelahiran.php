<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Akta_Kelahiran extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_all_akta()
	{
		$this->db->select('akta_kelahiran.*, penduduk.nama');
		$this->db->from('akta_kelahiran');
		$this->db->join('penduduk', 'penduduk.id_penduduk = akta_kelahiran.id_penduduk');
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_akta($data)
	{
		return $this->db->insert('akta_kelahiran', $data);
	}

	public function get_akta_by_id($id_akta)
	{
		// Pastikan ada baris data yang ditemukan atau tidak
		$query = $this->db->get_where('akta_kelahiran', ['id_akta' => $id_akta]);
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false; // Mengembalikan false jika tidak ditemukan
		}
	}

	public function update_akta($id_akta, $data)
	{
		$this->db->where('id_akta', $id_akta);
		return $this->db->update('akta_kelahiran', $data);
	}

	public function delete($id_akta)
	{
		$this->db->where('id_akta', $id_akta);
		return $this->db->delete('akta_kelahiran');
	}
}
