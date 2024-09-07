<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_SK_Usaha extends CI_Model
{
	public function tambah_permohonan($data)
	{
		return $this->db->insert('sk_usaha', $data);
	}

	public function get_all_permohonan()
	{
		$this->db->select('sk_usaha.*, penduduk.nama, penduduk.alamat'); // Memilih kolom yang ingin diambil
		$this->db->from('sk_usaha');
		$this->db->join('penduduk', 'penduduk.id_penduduk = sk_usaha.id_penduduk'); // Melakukan join dengan tabel penduduk
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result(); // Mengembalikan hasil query
	}


	public function get_permohonan_by_id($id)
	{
		$this->db->select('sk_usaha.*, penduduk.*');
		$this->db->from('sk_usaha');
		$this->db->join('penduduk', 'sk_usaha.id_penduduk = penduduk.id_penduduk');
		$this->db->where('sk_usaha.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_permohonan($id, $data)
	{
		return $this->db->where('id', $id)->update('sk_usaha', $data);
	}

	public function delete_permohonan($id)
	{
		return $this->db->delete('sk_usaha', ['id' => $id]);
	}

	public function update_status($id, $status)
	{
		$this->db->where('id', $id);
		$this->db->update('sk_usaha', ['status' => $status]);
	}
}