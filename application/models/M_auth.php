<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function login_user($email, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_admin');
		$this->db->where(array(
			'email' => $email,
			'password' => md5($password)
		));
		return $this->db->get()->row();
	}

	public function login_pelanggan($email, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where(array(
			'email' => $email,
			'password' => md5($password)
		));
		return $this->db->get()->row();
	}

	public function login_wo($email, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->where(array(
			'email' => $email,
			'password' => md5($password)
		));
		return $this->db->get()->row();
	}

	public function login_vendor($email, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->where(array(
			'email' => $email,
			'password' => md5($password)
		));
		return $this->db->get()->row();
	}

}


?>