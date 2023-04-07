<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uservendor extends CI_Controller {

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
			'vendor' => $this->m_user->get_vendor(),
			'data_vendor' => $this->m_user->get_data_vendor(),
			'kategori' => $this->m_kategori->get_all_data(),
			'isi' => 'v_vendor',
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add()
	{
		$data2 = array(
			'nama_vendor' => $this->input->post('nama_vendor'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'level_user' => $this->input->post('level_user'),
			'alamat' => $this->input->post('alamat'),
			'id_kategori' => $this->input->post('id_kategori'),
			'no_telp' => $this->input->post('no_telp'),
			'email' => $this->input->post('email'),
			'id_wo' => $this->session->userdata('id_wo'),
			'is_active' => 1,
			'gambar' => 'default.jpg',
			'deskripsi' => $this->input->post('deskripsi'),
			'no_rek' => $this->input->post('no_rek'),
			'added_by' => $this->session->userdata('id_wo'),
			'added_time' => time(),
		);

		$this->m_user->add_vendor($data2);
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
		redirect('uservendor');
	}

	public function edit($id_vendor = NULL)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'nama_vendor' => $this->input->post('nama_vendor'),
			'username' => $this->input->post('username'),
			'level_user' => $this->input->post('level_user'),
			'alamat' => $this->input->post('alamat'),
			'id_kategori' => $this->input->post('id_kategori'),
			'no_telp' => $this->input->post('no_telp'),
			'email' => $this->input->post('email'),
			'id_wo' => $this->session->userdata('id_wo'),
			'deskripsi' => $this->input->post('deskripsi'),
			'no_rek' => $this->input->post('no_rek'),
			'edited_by' => $this->session->userdata('id_wo'),
			'edited_time' => time(),
		);

		$this->m_user->edit_vendor($data);
		$this->session->set_flashdata('message', 'Data berhasil diubah!');
		redirect('uservendor');
	}

	public function delete($id_vendor = NULL)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'is_active' => 0,
			'deleted_by' => $this->session->userdata('id_wo'),
			'deleted_time' => time(),
	    );
		$this->m_user->delete_vendor($data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus!');
		redirect('uservendor');
	}


}


?>