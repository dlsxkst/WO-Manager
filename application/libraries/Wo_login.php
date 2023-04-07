<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wo_login {

	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('m_auth');
	}

	public function login_wo($email, $password)
	{
		$cek = $this->ci->m_auth->login_wo($email, $password);
		if ($cek) {
			$nama_toko = $cek->nama_toko;
			$id_wo = $cek->id_wo;
			$username = $cek->username;
			$email = $cek->email;
			$level_user = $cek->level_user;
			$is_active = $cek->is_active;
			$gambar = $cek->gambar;

			$this->ci->session->set_userdata('username', $username);
			$this->ci->session->set_userdata('id_wo', $id_wo);
			$this->ci->session->set_userdata('email', $email);
			$this->ci->session->set_userdata('nama_toko', $nama_toko);
			$this->ci->session->set_userdata('level_user', $level_user);
			$this->ci->session->set_userdata('is_active', $is_active);
			$this->ci->session->set_userdata('gambar', $gambar);
			if ($is_active == 1) {
			redirect('am');
			} else {
				$this->ci->session->set_flashdata('error', 'Akun Anda belum Aktif!');
				redirect('auth/login_user');
			}
		}else{
			$this->ci->session->set_flashdata('error', 'Email atau Password Salah!!');
			redirect('auth/login_user');
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
		$this->ci->session->unset_userdata('email');
		$this->ci->session->unset_userdata('id_wo');
			$this->ci->session->unset_userdata('nama_toko');
			$this->ci->session->unset_userdata('is_active');
			$this->ci->session->unset_userdata('level_user');
			$this->ci->session->set_flashdata('message', 'You have been logged out!!');
			redirect('auth/login_user');
	}
}


?>
