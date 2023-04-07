<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function get_all_data()
	{
		$this->db->select('tb_barang.*, tb_kategori.*, tb_vendor.kab, tb_vendor.prov');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor');
		$this->db->where('tb_barang.is_active = 1');
		$this->db->order_by('tb_barang.id_barang', 'desc');
		return $this->db->get()->result();
	}

	public function get_data_paket()
	{
		$this->db->select('tb_paket.*, tb_kategori.*, tb_wo.kab, tb_wo.prov');
		$this->db->from('tb_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_paket.id_wo', 'left');
		$this->db->where('tb_paket.is_active = 1');
		$this->db->order_by('tb_paket.id_paket', 'desc');
		return $this->db->get()->result();
	}

	public function get_keyword($keyword)
	{
		$this->db->select('tb_barang.*, tb_kategori.nama_kategori, tb_vendor.kab');
		$this->db->from('tb_barang');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->like('nama_barang', $keyword);
		$this->db->or_like('harga', $keyword);
		$this->db->or_like('tb_barang.deskripsi', $keyword);
		$this->db->or_like('tb_vendor.kab', $keyword);
		$this->db->having('tb_barang.is_active = 1');
		return $this->db->get()->result();
	}

	public function hasil_pencarian($kota, $kategori,$harga_from, $harga_to, $kapasitas_from, $kapasitas_to)
	{
		if ($harga_to < $harga_from || $kapasitas_to < $kapasitas_from) {
		$this->db->select('tb_barang.*, tb_kategori.id_kategori, tb_kategori.nama_kategori, tb_vendor.kab');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor');
		$this->db->like('tb_barang.id_kategori', $kategori);
		$this->db->like('tb_vendor.kab', $kota);
		$this->db->where('harga between "'.$harga_to.'" and "'.$harga_from.'"');
		$this->db->where('kapasitas between "'.$kapasitas_to.'" and "'.$kapasitas_from.'"');
		$this->db->where('tb_barang.is_active = 1');
		return $this->db->get()->result();
		} else {
		$this->db->select('tb_barang.*, tb_kategori.id_kategori, tb_kategori.nama_kategori, tb_vendor.kab');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor');
		$this->db->like('tb_barang.id_kategori', $kategori);
		$this->db->like('tb_vendor.kab', $kota);
		$this->db->where('harga between "'.$harga_from.'" and "'.$harga_to.'"');
		$this->db->where('kapasitas between "'.$kapasitas_from.'" and "'.$kapasitas_to.'"');
		$this->db->where('tb_barang.is_active = 1');
		return $this->db->get()->result();
		}
		
	}

	public function hasil_pencarian_paket($kota, $kategori,$harga_from, $harga_to, $kapasitas_from, $kapasitas_to)
	{
		if ($harga_to < $harga_from || $kapasitas_to < $kapasitas_from) {
		$this->db->select('tb_paket.*, tb_kategori.id_kategori, tb_kategori.nama_kategori, tb_wo.kab');
		$this->db->from('tb_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_paket.id_wo');
		$this->db->like('tb_paket.id_kategori', $kategori);
		$this->db->like('tb_wo.kab', $kota);
		$this->db->where('harga_paket between "'.$harga_to.'" and "'.$harga_from.'"');
		$this->db->where('kapasitas between "'.$kapasitas_to.'" and "'.$kapasitas_from.'"');
		$this->db->where('tb_paket.is_active = 1');
		return $this->db->get()->result();
		} else {
		$this->db->select('tb_paket.*, tb_kategori.id_kategori, tb_kategori.nama_kategori, tb_wo.kab');
		$this->db->from('tb_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_paket.id_wo');
		$this->db->like('tb_paket.id_kategori', $kategori);
		$this->db->like('tb_wo.kab', $kota);
		$this->db->where('harga_paket between "'.$harga_from.'" and "'.$harga_to.'"');
		$this->db->where('kapasitas between "'.$kapasitas_from.'" and "'.$kapasitas_to.'"');
		$this->db->where('tb_paket.is_active = 1');
		return $this->db->get()->result();
		}
	}

	public function get_keyword_paket($keyword)
	{
		$this->db->select('tb_paket.*, tb_kategori.nama_kategori, tb_wo.kab');
		$this->db->from('tb_paket');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_paket.id_wo');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->like('nama_paket', $keyword);
		$this->db->or_like('harga_paket', $keyword);
		$this->db->or_like('tb_paket.deskripsi', $keyword);
		$this->db->or_like('tb_wo.kab', $keyword);
		$this->db->having('tb_paket.is_active = 1');
		return $this->db->get()->result();
	}

	public function get_keyword_toko($keyword)
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->like('nama_toko', $keyword);
		$this->db->or_like('alamat', $keyword);
		$this->db->or_like('deskripsi', $keyword);
		$this->db->having('is_active = 1');
		return $this->db->get()->result();
	}

	public function get_all_data_kategori()
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('is_active = 1');
		$this->db->order_by('id_kategori', 'desc');
		return $this->db->get()->result();
	}

	public function detail_barang($id_barang)
	{
		$this->db->select('tb_barang.*, tb_barang.gambar , tb_kategori.*, tb_vendor.nama_vendor, tb_vendor.kab, tb_vendor.prov');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor', 'left');
		$this->db->where('tb_barang.id_barang', $id_barang);
		return $this->db->get()->row();
	}

	public function chat()
	{
		$this->db->select('*');
		$this->db->from('tb_chat');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_chat.receiver', 'left');
		$this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_chat.sender', 'left');
		// $this->db->join('tb_wo', 'tb_wo.id_wo = tb_chat.receiver', 'left');
		// $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
		return $this->db->get()->result();
	}

	public function detail_paket($id_paket)
	{
		$this->db->select('tb_paket.nama_paket as nama_paket, tb_paket.gambar as gambar, tb_kategori.nama_kategori as nama_kategori, tb_paket.deskripsi as deskripsi, tb_barang.nama_barang as nama_barang, tb_vendor.nama_vendor as nama_vendor, tb_paket.harga_paket as harga_paket, tb_paket.id_paket as id_paket, tb_paket.kapasitas, tb_paket.id_wo, tb_wo.nama_toko as nama_toko, tb_wo.kab as kab, tb_wo.prov as prov');
		$this->db->from('tb_detail_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = 1');
		$this->db->join('tb_paket', 'tb_paket.id_paket = tb_detail_paket.detail_package_id', 'left');
		$this->db->join('tb_barang', 'tb_barang.id_barang = tb_detail_paket.detail_product_id', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_detail_paket.id_vendor', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_paket.id_wo', 'left');
		$this->db->where('tb_paket.id_paket', $id_paket);
		return $this->db->get()->row();
	}

	public function detail_paket2($id_paket)
	{
		$this->db->select('tb_barang.nama_barang as nama_barang, tb_vendor.nama_vendor as nama_vendor');
		$this->db->from('tb_detail_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = 1');
		$this->db->join('tb_paket', 'tb_paket.id_paket = tb_detail_paket.detail_package_id', 'left');
		$this->db->join('tb_barang', 'tb_barang.id_barang = tb_detail_paket.detail_product_id', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_detail_paket.id_vendor', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_paket.id_wo', 'left');
		$this->db->where('tb_paket.id_paket', $id_paket);
		return $this->db->get()->row();
	}



	public function detail_toko($id_wo)
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->where('is_active = 1');
		$this->db->where('id_wo', $id_wo);
		return $this->db->get()->row();
	}

	public function detail_vendor($id_vendor)
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->where('is_active = 1');
		$this->db->where('id_vendor', $id_vendor);
		return $this->db->get()->row();
	}

	public function gambar_barang($id_barang)
	{
		$this->db->select('*');
		$this->db->from('tb_gambar');
		$this->db->where('id_barang', $id_barang);
		return $this->db->get()->result();
	}

	public function gambar_paket($id_paket)
	{
		$this->db->select('*');
		$this->db->from('tb_gambarpaket');
		$this->db->where('id_paket', $id_paket);
		return $this->db->get()->result();
	}

	public function kategori($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('id_kategori', $id_kategori);
		$this->db->where('is_active = 1');
		return $this->db->get()->row();	
	}

	public function get_all_data_barang($id_kategori)
	{
		$this->db->select('tb_barang.*, tb_kategori.*, tb_vendor.kab, tb_vendor.prov');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor');
		$this->db->where('tb_barang.is_active = 1');
		$this->db->where('tb_barang.id_kategori', $id_kategori);
		return $this->db->get()->result();
	}

	public function get_all_data_paket($id_kategori)
	{
		$this->db->select('tb_paket.*, tb_kategori.*, tb_wo.kab, tb_wo.prov');
		$this->db->from('tb_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_paket.id_wo');
		$this->db->where('tb_paket.is_active = 1');
		$this->db->where('tb_paket.id_kategori', $id_kategori);
		return $this->db->get()->result();
	}

	public function get_toko()
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->where('is_active = 1');
		return $this->db->get()->result();
	}

	public function get_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->where('is_active = 1');
		return $this->db->get()->result();
	}

	public function vendor($id_wo)
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor = tb_vendor.id_vendor', 'left');
		$this->db->where('tb_kerjasama.id_wo', $id_wo);
		return $this->db->get()->result();
	}

	public function gallery($id_wo)
	{
		$this->db->select('*');
		$this->db->from('tb_gallery');
		// $this->db->join('tb_kerjasama', 'tb_kerjasama.id_wo = tb_gallery.id_wo', 'left');
		$this->db->where('is_active = 1');
		$this->db->where('id_wo', $id_wo);
		return $this->db->get()->result();
	}

	public function gallery_vendor($id_vendor)
	{
		$this->db->select('*');
		$this->db->from('tb_gallery');
		// $this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor = tb_gallery.id_vendor', 'left');
		$this->db->where('is_active = 1');
		$this->db->where('id_vendor', $id_vendor);
		return $this->db->get()->result();
	}

	public function toko($id_vendor)
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_wo = tb_wo.id_wo', 'left');
		$this->db->where('tb_kerjasama.id_vendor', $id_vendor);
		return $this->db->get()->result();
	}

	public function barang($id_wo)
	{
		$this->db->select('tb_barang.id_barang as id_barang, tb_barang.nama_barang as nama_barang, tb_barang.gambar as gambar');
		$this->db->from('tb_barang');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor', 'inner');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor = tb_barang.id_vendor', 'left');
		$this->db->where('tb_barang.is_active = 1');
		$this->db->where('tb_kerjasama.id_wo', $id_wo);
		return $this->db->get()->result();
	}

	public function barang_vendor($id_vendor)
	{
		$this->db->select('tb_barang.id_barang as id_barang, tb_barang.nama_barang as nama_barang, tb_barang.gambar as gambar');
		$this->db->from('tb_barang');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor', 'inner');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor = tb_barang.id_vendor', 'left');
		$this->db->where('tb_barang.is_active = 1');
		$this->db->where('tb_kerjasama.id_vendor', $id_vendor);
		return $this->db->get()->result();
	}

	public function paket($id_wo)
	{
		$this->db->select('tb_paket.id_paket as id_paket, tb_paket.nama_paket as nama_paket, tb_paket.gambar as gambar');
		$this->db->from('tb_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->join('tb_detail_paket', 'tb_detail_paket.detail_package_id = tb_paket.id_paket', 'left outer');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_wo = tb_paket.id_wo', 'left');
		$this->db->where('tb_paket.is_active = 1');
		$this->db->where('tb_kerjasama.id_wo', $id_wo);
		$this->db->group_by('id_paket');
		return $this->db->get()->result();
	}
}