<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

	public function register($data)
	{
		$this->db->insert('tb_pelanggan', $data);
	}

	public function akun()
	{
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
		return $this->db->get()->row();	
	}

	public function edit($data)
	{
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('tb_pelanggan', $data);
	}

	public function changepass($data)
	{
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('tb_pelanggan', $data);
	}


}
