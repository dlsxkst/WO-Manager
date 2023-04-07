<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

	public function get_all_data()
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('is_active = 1');
		$this->db->order_by('id_kategori', 'asc');
		return $this->db->get()->result();
	}

	public function get_data($id_user)
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_vendor.id_kategori', 'left');
		$this->db->where('id_vendor', $id_user);
		return $this->db->get()->row();
	}	

	public function add($data)
	{
		$this->db->insert('tb_kategori', $data);
	}

	public function edit($data)
	{
		$this->db->where('id_kategori', $data['id_kategori']);
		$this->db->update('tb_kategori', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_kategori', $data['id_kategori']);
		$this->db->update('tb_kategori', $data);
	}

	public function delete_gallery($data)
	{
		$this->db->where('id_gallery', $data['id_gallery']);
		$this->db->update('tb_gallery', $data);
	}

	public function get_gallery()
	{
		$this->db->select('tb_gallery.*');
		$this->db->from('tb_gallery');
		$this->db->join('tb_detail_gallery', 'tb_detail_gallery.id_gallery = tb_gallery.id_gallery', 'left');
		$this->db->where('tb_gallery.is_active = 1');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		$this->db->order_by('id_gallery', 'asc');
		$this->db->group_by('tb_gallery.id_gallery');
		return $this->db->get()->result();
	}

	public function get_gallery_vendor()
	{
		$this->db->select('tb_gallery.*');
		$this->db->from('tb_gallery');
		$this->db->join('tb_detail_gallery', 'tb_detail_gallery.id_gallery = tb_gallery.id_gallery', 'left');
		$this->db->where('tb_gallery.is_active = 1');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		$this->db->order_by('id_gallery', 'asc');
		$this->db->group_by('tb_gallery.id_gallery');
		return $this->db->get()->result();
	}

	
	public function add_gallery($data)
	{
		$this->db->insert('tb_gallery', $data);
	}

}
