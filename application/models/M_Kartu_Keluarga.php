<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Kartu_Keluarga extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_all_kk()
	{
		$this->db->select('kartu_keluarga.*, penduduk.nama');
		$this->db->from('kartu_keluarga');
		$this->db->join('penduduk', 'penduduk.id_penduduk = kartu_keluarga.id_penduduk');
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_kk($data)
	{
		return $this->db->insert('kartu_keluarga', $data);
	}

	public function get_kk_by_id($id_kk)
	{
		// Pastikan ada baris data yang ditemukan atau tidak
		$query = $this->db->get_where('kartu_keluarga', ['id_kk' => $id_kk]);
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false; // Mengembalikan false jika tidak ditemukan
		}
	}

	public function update_kk($id_kk, $data)
	{
		$this->db->where('id_kk', $id_kk);
		return $this->db->update('kartu_keluarga', $data);
	}

	public function delete($id_kk)
	{
		$this->db->where('id_kk', $id_kk);
		return $this->db->delete('kartu_keluarga');
	}
}
