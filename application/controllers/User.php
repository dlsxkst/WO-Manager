<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_kategori');
	}

	public function index($offset = 0)
	{
		$data = array(
			'title' => 'User',
			'user' => $this->m_user->get_all_data(),
			'vendor' =>  $this->m_user->get_data(),
			'belum_verif' => $this->m_user->belum_verif(),
			'belum_verif_wo' => $this->m_user->belum_verif_wo(),
			'isi' => 'admin/v_user',
			'kategori' => $this->m_kategori->get_all_data(),
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}


	public function edit($id_wo = NULL)
	{
		$data = array(
			'id_wo' => $id_wo,
			'nama_toko' => $this->input->post('nama_toko'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'level_user' => $this->input->post('level_user'),
			'edited_by' => $this->session->userdata('id_user'),
			'edited_time' => date('Y-m-d H:i:s'),
		);

		$this->m_user->edit($data);
		$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
		redirect('user');
	}

	public function delete($id_wo = NULL)
	{
		$data = array(
			'id_wo' => $id_wo,
			'is_active' => '0',
			'deleted_by' => $this->session->userdata('id_user'),
			'deleted_time' => date('Y-m-d H:i:s'),

		);
		$this->m_user->delete($data);
		$this->session->set_flashdata('pesan', 'Akun berhasil dinonaktifkan!');
		redirect('user');
	}

	public function aktif($id_wo = NULL)
	{
		$data = array(
			'id_wo' => $id_wo,
			'is_active' => '1',
			'deleted_by' => $this->session->userdata('id_user'),
			'deleted_time' => date('Y-m-d H:i:s'),

		);
		$this->m_user->aktif($data);
		$this->session->set_flashdata('pesan', 'Akun berhasil diaktifkan!');
		redirect('user');
	}

	public function edit_vendor($id_vendor = NULL)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'nama_vendor' => $this->input->post('nama_vendor'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'id_kategori' => $this->input->post('id_kategori'),
			'edited_by' => $this->session->userdata('id_user'),
			'edited_time' => date('Y-m-d H:i:s'),
		);

		$this->m_user->edit_vendor($data);
		$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
		redirect('user');
	}

	public function delete_vendor($id_vendor = NULL)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'is_active' => '0',
			'deleted_by' => $this->session->userdata('id_user'),
			'deleted_time' => date('Y-m-d H:i:s'),

		);
		$this->m_user->delete_vendor($data);
		$this->session->set_flashdata('pesan', 'Akun berhasil dinonaktifkan!');
		redirect('user');
	}

	public function aktif_vendor($id_vendor = NULL)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'is_active' => '1',
			'deleted_by' => $this->session->userdata('id_user'),
			'deleted_time' => date('Y-m-d H:i:s'),

		);
		$this->m_user->aktif_vendor($data);
		$this->session->set_flashdata('pesan', 'Akun berhasil diaktifkan!');
		redirect('user');
	}


	public function verif($id_wo)
	{
		$data = array(
			'id_wo' => $id_wo,
			'is_active' => '1',

		);
		
		$this->m_user->update_wo($data);
		$this->session->set_flashdata('pesan', 'Data terverifikasi!');
		redirect('user');
	}

	public function verif_vendor($id_vendor)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'is_active' => '1',

		);
		
		$this->m_user->update_vendor($data);
		$this->session->set_flashdata('pesan', 'Data terverifikasi!');
		redirect('user');
	}


}


?>