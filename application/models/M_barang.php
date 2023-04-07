<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function get_all_data()
	{
		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->where('tb_barang.is_active = 1');
		$this->db->where('tb_kategori.is_active = 1');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		$this->db->order_by('tb_barang.id_barang', 'desc');
		return $this->db->get()->result();
	}

	public function get_data($id_barang)
	{
		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
		$this->db->where('id_barang', $id_barang);
		return $this->db->get()->row();
	}	

	public function get_data_gallery($id_gallery)
	{
		$this->db->select('*');
		$this->db->from('tb_gallery');
		$this->db->where('id_gallery', $id_gallery);
		return $this->db->get()->row();
	}	

	public function get_data_paket($id_paket)
	{
		$this->db->select('*');
		$this->db->from('tb_paket');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->where('id_paket', $id_paket);
		return $this->db->get()->row();
	}	

	public function get_paket($id_paket)
	{
		$this->db->select('*');
		$this->db->from('tb_paket');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_wo = tb_paket.id_wo', 'left outer');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->group_by('tb_paket.nama_paket');
		$this->db->where('tb_paket.id_paket', $id_paket);
		return $this->db->get()->row();
	}

	public function edit_batch($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_paket', $data);
	}	


	public function add($data)
	{
		$this->db->insert('tb_barang', $data);
	}

	public function edit($data)
	{
		$this->db->where('id_barang', $data['id_barang']);
		$this->db->update('tb_barang', $data);
	}

	public function edit_gallery($data)
	{
		$this->db->where('id_gallery', $data['id_gallery']);
		$this->db->update('tb_gallery', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_barang', $data['id_barang']);
		$this->db->update('tb_barang', $data);
	}

	public function delete_paket($data)
	{
		$this->db->where('id_paket', $data['id_paket']);
		$this->db->update('tb_paket', $data);
	}

	

}
