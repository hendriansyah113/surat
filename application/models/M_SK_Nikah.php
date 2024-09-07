<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_SK_Nikah extends CI_Model
{
	public function tambah_permohonan($data)
	{
		return $this->db->insert('sk_nikah', $data);
	}

	public function get_all_permohonan()
	{
		$this->db->select('sk_nikah.*, penduduk.*'); // Memilih kolom yang ingin diambil
		$this->db->from('sk_nikah');
		$this->db->join('penduduk', 'penduduk.id_penduduk = sk_nikah.id_penduduk'); // Melakukan join dengan tabel penduduk
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result(); // Mengembalikan hasil query
	}


	public function get_permohonan_by_id($id)
	{
		$this->db->select('sk_nikah.*, penduduk.*');
		$this->db->from('sk_nikah');
		$this->db->join('penduduk', 'sk_nikah.id_penduduk = penduduk.id_penduduk');
		$this->db->where('sk_nikah.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_permohonan($id, $data)
	{
		return $this->db->where('id', $id)->update('sk_nikah', $data);
	}

	public function delete_permohonan($id)
	{
		return $this->db->delete('sk_nikah', ['id' => $id]);
	}

	public function update_status($id, $status)
	{
		$this->db->where('id', $id);
		$this->db->update('sk_nikah', ['status' => $status]);
	}
}
