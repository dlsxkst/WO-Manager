<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambarpaket extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_gambarpaket');
		$this->load->model('m_barang');
	}

	public function index()
	{
		$data = array(
			'title' => 'Gambar Paket' ,
			'gambarpaket' => $this->m_gambarpaket->get_all_data(),
			'isi' => 'gambarpaket/v_index' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add($id_paket)
	{
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');
	

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambarpaket/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Add Gambar Paket',
				'error_upload' => $this->upload->display_errors(),
				'paket' => $this->m_barang->get_paket($id_paket),
				'gambar' => $this->m_gambarpaket->get_gambar($id_paket),
				'isi' => 'gambarpaket/v_add' ,
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gambarpaket/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_paket' => $id_paket,
						'keterangan' => $this->input->post('keterangan'),
						'gambar' => $upload_data['uploads']['file_name'],
					);
					$this->m_gambarpaket->add($data);
					$this->session->set_flashdata('message', 'Gambar berhasil ditambahkan!');
					redirect('gambarpaket/add/'.$id_paket);
				}
		}	

		$data = array(
			'title' => 'Add Gambar Paket' ,
			'paket' => $this->m_barang->get_paket($id_paket),
			'gambar' => $this->m_gambarpaket->get_gambar($id_paket),
			'isi' => 'gambarpaket/v_add' ,
			 );
	
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function delete($id_paket, $id_gambar)
	{
		//hapus gambar
		$gambar = $this->m_gambarpaket->get_data($id_gambar);
		if($gambar->gambar != "" ){
			unlink('./assets/gambarpaket/'.$gambar->gambar);
		}
		//
		$data = array('id_gambar' => $id_gambar);
		$this->m_gambarpaket->delete($data);
		$this->session->set_flashdata('message', 'Gambar berhasil dihapus!');
		redirect('gambarpaket/add/'. $id_paket);
	}
}


?>