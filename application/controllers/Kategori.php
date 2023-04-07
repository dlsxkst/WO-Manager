<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
	}

	public function index()
	{
		$data = array(
			'title' => 'Kategori',
			'kategori' => $this->m_kategori->get_all_data(),
			'isi' => 'admin/v_kategori',
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add()
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
			'is_active' => 1,
			'added_by' => $this->session->userdata('id_user'),
			'added_time' =>date('Y-m-d H:i:s'),
		);

		$this->m_kategori->add($data);
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
		redirect('kategori');
	}

	public function edit($id_kategori = NULL)
	{
		$data = array(
			'id_kategori' => $id_kategori,
			'nama_kategori' => $this->input->post('nama_kategori'),
			'edited_by' => $this->session->userdata('id_user'),
			'edited_time' => date('Y-m-d H:i:s'),
		);

		$this->m_kategori->edit($data);
		$this->session->set_flashdata('message', 'Data berhasil diubah!');
		redirect('kategori');
	}

	public function delete($id_kategori = NULL)
	{
		$data = array(
			'id_kategori' => $id_kategori,
			'is_active' => '0',
			'deleted_by' => $this->session->userdata('id_user'),
			'deleted_time' =>date('Y-m-d H:i:s'),

		);
		$this->m_kategori->delete($data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus!');
		redirect('kategori');
	}

	public function delete_gallery($id_gallery = NULL)
	{
		$data = array(
			'id_gallery' => $id_gallery,
			'is_active' => '0',

		);
		$this->m_kategori->delete_gallery($data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus!');
		redirect('am/gallery');
	}

	public function delete_gallery_vendor($id_gallery = NULL)
	{
		$data = array(
			'id_gallery' => $id_gallery,
			'is_active' => '0',

		);
		$this->m_kategori->delete_gallery($data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus!');
		redirect('vendor/gallery');
	}


	public function add_gallery()
	{
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gallery/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Add Gallery',
				'gallery' => $this->m_kategori->get_gallery(),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'wo/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gallery/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						'is_active' => 1,
						'gambar' => $upload_data['uploads']['file_name'],
						'id_wo' => $this->session->userdata('id_wo'),
						
					);
					$this->m_kategori->add_gallery($data);
					$this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
					redirect('am/gallery');
				}
		}	

		$data = array(
				'title' => 'Add Gallery',
				'gallery' => $this->m_kategori->get_gallery(),
				'isi' => 'wo/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function edit_gallery($id_gallery = NULL)
	{
		
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gallery/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'wo/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$barang = $this->m_barang->get_data_gallery($id_gallery);
						if($barang->gambar != "" ){
							unlink('./assets/gallery/'.$barang->gambar);
						}
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gallery/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_gallery' => $id_gallery,
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						'gambar' => $upload_data['uploads']['file_name'],
					);
					$this->m_barang->edit_gallery($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('am/gallery');
				}
				$data = array(
						'id_gallery' => $id_gallery,
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						
					);
					$this->m_barang->edit_gallery($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('am/gallery');
		}	

		$data = array(
				
				'isi' => 'wo/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add_gallery_vendor()
	{
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gallery/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Add Gallery',
				'gallery' => $this->m_kategori->get_gallery_vendor(),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'vendor/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gallery/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						'is_active' => 1,
						'gambar' => $upload_data['uploads']['file_name'],
						'id_vendor' => $this->session->userdata('id_vendor'),
						
					);
					$this->m_kategori->add_gallery($data);
					$this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
					redirect('vendor/gallery');
				}
		}	

		$data = array(
				'title' => 'Add Gallery',
				'gallery' => $this->m_kategori->get_gallery_vendor(),
				'isi' => 'vendor/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function edit_gallery_vendor($id_gallery = NULL)
	{
		
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gallery/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'vendor/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$barang = $this->m_barang->get_data_gallery($id_gallery);
						if($barang->gambar != "" ){
							unlink('./assets/gallery/'.$barang->gambar);
						}
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gallery/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_gallery' => $id_gallery,
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						'gambar' => $upload_data['uploads']['file_name'],
					);
					$this->m_barang->edit_gallery($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('vendor/gallery');
				}
				$data = array(
						'id_gallery' => $id_gallery,
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						
					);
					$this->m_barang->edit_gallery($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('vendor/gallery');
		}	

		$data = array(
				'isi' => 'vendor/v_gallery',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}
	

	


}


?>