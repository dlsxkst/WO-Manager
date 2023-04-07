<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_gambarbarang');
	}

	public function index()
	{
		$data = array(
			'title' => 'Home' ,
			'barang' => $this->m_home->get_all_data(),
			'paket' => $this->m_home->get_data_paket(),
			'isi' => 'home/v_home' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function kategori($id_kategori)
	{
		$kategori = $this->m_home->kategori($id_kategori);
		$data = array(
			'title' => 'Kategori Barang: '.$kategori->nama_kategori ,
			'barang' => $this->m_home->get_all_data_barang($id_kategori),
			'paket' => $this->m_home->get_all_data_paket($id_kategori),
			'isi' => 'home/v_kategori_barang' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function detail_barang($id_barang)
	{
		$data = array(
			'title' => 'Detail Barang',
			'detail_barang' => $this->m_home->detail_barang($id_barang),
			
			'gambar' => $this->m_home->gambar_barang($id_barang),
			'isi' => 'home/v_detail_barang' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function detail_vendor($id_vendor)
	{
		$data = array(
			'title' => 'Detail Vendor',
			'vendor' => $this->m_home->detail_vendor($id_vendor),
			'toko'  => $this->m_home->toko($id_vendor),
			'barang' => $this->m_home->barang_vendor($id_vendor),
			'gallery' => $this->m_home->gallery_vendor($id_vendor),
			'isi' => 'home/v_detail_vendor' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function detail_gallery($id_gallery)
	{
		$data = array(
			'title' => 'Detail Gallery',
			'gallery' => $this->m_barang->get_data_gallery($id_gallery),
			'gambar' => $this->m_gambarbarang->get_gallery($id_gallery),
			'isi' => 'home/v_detail_gallery' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function detail_paket($id_paket)
	{
		$data = array(
			'title' => 'Detail Barang',
			'paket' => $this->m_home->detail_paket($id_paket),
			
			'gambar' => $this->m_home->gambar_paket($id_paket),
			'isi' => 'home/v_detail_paket' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function produk()
	{
		$get_prov = $this->db->select('*')->from('wilayah_kabupaten')->get();
		$data = array(
			'title' => 'Produk' ,
			'barang' => $this->m_home->get_all_data(),
			'paket' => $this->m_home->get_data_paket(),
			'kota' => $get_prov->result(),
			'kategori' => $this->m_kategori->get_all_data(),
			'isi' => 'home/v_produk' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function search()
	{
		$keyword = $this->input->post('keyword');
		
		$data = array(
			'title' => 'Hasil Pencarian' ,
			'cari' => $this->m_home->get_keyword($keyword),
			'kategori' => $this->m_kategori->get_all_data(),
			'cari_paket' => $this->m_home->get_keyword_paket($keyword),
			'isi' => 'home/v_cari' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

	}

	public function pencarian()
	{
		$kota = $this->input->post('kota');
		$kategori = $this->input->post('kategori');
		$harga_from = $this->input->post('harga_from');
		$harga_to = $this->input->post('harga_to');
		$kapasitas_from = $this->input->post('kapasitas_from');
		$kapasitas_to = $this->input->post('kapasitas_to');
		$data = array(
			'title' => 'Hasil Pencarian' ,
			'kategori' => $this->m_kategori->get_all_data(),
			'hasil' => $this->m_home->hasil_pencarian($kota, $kategori, $harga_from, $harga_to, $kapasitas_from, $kapasitas_to),
			'hasil_paket' => $this->m_home->hasil_pencarian_paket($kota, $kategori, $harga_from, $harga_to, $kapasitas_from, $kapasitas_to),
			'isi' => 'home/v_cari_2' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function toko()
	{
		$data = array(
			'title' => 'Toko' ,
			'toko' => $this->m_home->get_toko(),
			'vendor' => $this->m_home->get_vendor(),
			'isi' => 'home/v_toko' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function search_toko()
	{
		$keyword = $this->input->post('keyword');
		$data = array(
			'title' => 'Hasil Pencarian' ,
			'cari' => $this->m_home->get_keyword_toko($keyword),
			'isi' => 'home/v_cari_toko' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

	}

	public function detail_toko($id_wo)
	{
		$data = array(
			'title' => 'Detail Toko',
			'toko' => $this->m_home->detail_toko($id_wo),
			'vendor' => $this->m_home->vendor($id_wo),
			'paket' => $this->m_home->paket($id_wo),
			'barang' => $this->m_home->barang($id_wo),
			'gallery' => $this->m_home->gallery($id_wo),
			'isi' => 'home/v_detail_toko' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}
}


?>