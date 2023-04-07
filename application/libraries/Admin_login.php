<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login {

	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('m_auth');
	}

	public function login($email, $password)
	{
		$cek = $this->ci->m_auth->login_user($email, $password);
		if ($cek) {
			$nama_user = $cek->nama_user;
			$id_user = $cek->id_user;
			$username = $cek->username;
			$email = $cek->email;
			$level_user = $cek->level_user;
			$is_active = $cek->is_active;
			$gambar = $cek->gambar;

			$this->ci->session->set_userdata('username', $username);
			$this->ci->session->set_userdata('id_user', $id_user);
			$this->ci->session->set_userdata('email', $email);
			$this->ci->session->set_userdata('nama_user', $nama_user);
			$this->ci->session->set_userdata('level_user', $level_user);
			$this->ci->session->set_userdata('is_active', $is_active);
			$this->ci->session->set_userdata('gambar', $gambar);
			
			redirect('admin');
		
		}else{
			$this->ci->session->set_flashdata('error', 'Email atau Password Salah!!');
			redirect('auth/login');
		}
	}


	public function proteksi_halaman()
	{
		if ($this->ci->session->userdata('username') == "") {
			$this->ci->session->set_flashdata('error', 'Anda Belum Login!!');
			redirect('auth/login_user');
		}
	}

	public function logout()
	{
			$this->ci->session->unset_userdata('username');
			$this->ci->session->unset_userdata('id_user');
			$this->ci->session->unset_userdata('email');
			$this->ci->session->unset_userdata('is_active');
			$this->ci->session->unset_userdata('nama_user');
			$this->ci->session->unset_userdata('level_user');
			$this->ci->session->set_flashdata('message', 'You have been logged out!!');
			redirect('auth/login');
	}
}


?>