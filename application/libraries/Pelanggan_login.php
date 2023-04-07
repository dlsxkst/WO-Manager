<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_login {

	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('m_auth');
	}

	public function login($email, $password)
	{
		$cek = $this->ci->m_auth->login_pelanggan($email, $password);
		if ($cek) {
			$nama_pelanggan = $cek->nama_pelanggan;
			$id_pelanggan = $cek->id_pelanggan;
			$email = $cek->email;
			$password = $cek->password;
			$foto = $cek->foto;

			$this->ci->session->set_userdata('email', $email);
			$this->ci->session->set_userdata('password', $password);
			$this->ci->session->set_userdata('id_pelanggan', $id_pelanggan);
			$this->ci->session->set_userdata('nama_pelanggan', $nama_pelanggan);
			$this->ci->session->set_userdata('foto', $foto);
			
			redirect('home');
		}else{
			$this->ci->session->set_flashdata('error', 'Email atau Password Salah!!');
			redirect('auth/login_user');
		}
	}

	public function proteksi_halaman()
	{
		if ($this->ci->session->userdata('nama_pelanggan') == "") {
			$this->ci->session->set_flashdata('error', 'Anda Belum Login!!');
			redirect('auth/login_user');
		}
	}

	public function logout()
	{
		$this->ci->session->unset_userdata('nama_pelanggan');
		    $this->ci->session->unset_userdata('id_pelanggan');
			$this->ci->session->unset_userdata('email');
			$this->ci->session->unset_userdata('password');
			
			$this->ci->session->sess_destroy();
			$this->ci->session->set_flashdata('message', 'You have been logged out!!');
			redirect('auth/login_user','refresh');
	}
}


?>