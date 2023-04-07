<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_kategori');
		$this->load->model('m_user');
	}

	public function index()
	{
		$data = array(
			'title' => 'Produk',
			'barang' => $this->m_barang->get_all_data(),
			'isi' => 'barang/v_barang',
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'required');
		$this->form_validation->set_rules('id_kategori', 'nama kategori', 'required');
		$this->form_validation->set_rules('harga', 'harga barang', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Add Produk',
				'kategori' => $this->m_kategori->get_all_data(),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'barang/v_add',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'nama_barang' => $this->input->post('nama_barang'),
						'id_kategori' => $this->input->post('id_kategori'),
						'id_vendor' => $this->input->post('id_vendor'),
						'harga' => $this->input->post('harga'),
						'kapasitas' => $this->input->post('kapasitas'),
						'deskripsi' => $this->input->post('deskripsi'),
						'is_active' => 1,
						'gambar' => $upload_data['uploads']['file_name'],
						'added_by' => $this->session->userdata('id_vendor'),
						'added_time' => date('Y-m-d H:i:s'),
						
					);
					$this->m_barang->add($data);
					$this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
					redirect('barang');
				}
		}	

		$data = array(
				'title' => 'Add Produk',
				'kategori' => $this->m_kategori->get_all_data(),
				'isi' => 'barang/v_add',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function edit($id_barang = NULL)
	{
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'required');
		$this->form_validation->set_rules('id_kategori', 'nama kategori', 'required');
		$this->form_validation->set_rules('harga', 'harga barang', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Edit Barang',
				'kategori' => $this->m_kategori->get_all_data(),
				'barang' => $this->m_barang->get_data($id_barang),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'barang/v_edit',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$barang = $this->m_barang->get_data($id_barang);
						if($barang->gambar != "" ){
							unlink('./assets/gambar/'.$barang->gambar);
						}
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_barang' => $id_barang,
						'nama_barang' => $this->input->post('nama_barang'),
						'id_kategori' => $this->input->post('id_kategori'),
						'harga' => $this->input->post('harga'),
						'kapasitas' => $this->input->post('kapasitas'),
						'deskripsi' => $this->input->post('deskripsi'),
						'gambar' => $upload_data['uploads']['file_name'],
						'edited_by' => $this->session->userdata('id_vendor'),
						'edited_time' => date('Y-m-d H:i:s'),
					);
					$this->m_barang->edit($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('barang');
				}
				$data = array(
						'id_barang' => $id_barang,
						'nama_barang' => $this->input->post('nama_barang'),
						'id_kategori' => $this->input->post('id_kategori'),
						'harga' => $this->input->post('harga'),
						'kapasitas' => $this->input->post('kapasitas'),
						'deskripsi' => $this->input->post('deskripsi'),
						'edited_by' => $this->session->userdata('id_vendor'),
						'edited_time' => date('Y-m-d H:i:s'),
					);
					$this->m_barang->edit($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('barang');
		}	

		$data = array(
				'title' => 'Edit Barang',
				'kategori' => $this->m_kategori->get_all_data(),
				'barang' => $this->m_barang->get_data($id_barang),
				'isi' => 'barang/v_edit',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function delete($id_barang = NULL)
	{
		//hapus gambar
		$barang = $this->m_barang->get_data($id_barang);
		if($barang->gambar != "" ){
			unlink('./assets/gambar/'.$barang->gambar);
		}
		//
		$data = array(
			'id_barang' => $id_barang,
			'is_active' => 0,
			'deleted_by' => $this->session->userdata('id_vendor'),
			'deleted_time' => date('Y-m-d H:i:s'),
		);
		$this->m_barang->delete($data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus!');
		redirect('barang');
	}


}


?>