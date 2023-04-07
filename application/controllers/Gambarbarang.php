<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambarbarang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_gambarbarang');
		$this->load->model('m_barang');
	}

	public function index()
	{
		$data = array(
			'title' => 'Gambar Produk' ,
			'gambarbarang' => $this->m_gambarbarang->get_all_data(),
			'isi' => 'gambarbarang/v_index' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add($id_barang)
	{
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');
	

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambarbarang/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Add Gambar Produk',
				'error_upload' => $this->upload->display_errors(),
				'barang' => $this->m_barang->get_data($id_barang),
				'gambar' => $this->m_gambarbarang->get_gambar($id_barang),
				'isi' => 'gambarbarang/v_add' ,
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gambarbarang/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_barang' => $id_barang,
						'keterangan' => $this->input->post('keterangan'),
						'gambar' => $upload_data['uploads']['file_name'],
					);
					$this->m_gambarbarang->add($data);
					$this->session->set_flashdata('message', 'Gambar berhasil ditambahkan!');
					redirect('gambarbarang/add/'.$id_barang);
				}
		}	

		$data = array(
			'title' => 'Add Gambar Produk' ,
			'barang' => $this->m_barang->get_data($id_barang),
			'gambar' => $this->m_gambarbarang->get_gambar($id_barang),
			'isi' => 'gambarbarang/v_add' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function delete($id_barang, $id_gambar)
	{
		//hapus gambar
		$gambar = $this->m_gambarbarang->get_data($id_gambar);
		if($gambar->gambar != "" ){
			unlink('./assets/gambarbarang/'.$gambar->gambar);
		}
		//
		$data = array('id_gambar' => $id_gambar);
		$this->m_gambarbarang->delete($data);
		$this->session->set_flashdata('message', 'Gambar berhasil dihapus!');
		redirect('gambarbarang/add/'. $id_barang);
	}
}


?>