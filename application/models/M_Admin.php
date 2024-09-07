<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function insert_user($data)
	{
		return $this->db->insert('users', $data);
	}

	public function update_user($user_id, $data)
	{
		$this->db->where('id', $user_id);
		return $this->db->update('users', $data);
	}

	public function delete_user($user_id)
	{
		$this->db->where('id', $user_id);
		return $this->db->delete('users');
	}

	public function get_users()
	{
		$query = $this->db->get('users');
		return $query->result();
	}

	public function get_user_by_id($id)
	{
		return $this->db->get_where('users', array('id' => $id))->row_array();
	}

	public function delete($id)
	{
		return $this->db->delete('users', array('id' => $id));
	}
}
