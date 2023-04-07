<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {


	public function total_barang()
	{
		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->where('is_active = 1');
		return $this->db->get()->num_rows();
	}

	public function total_paket()
	{
		$this->db->select('*');
		$this->db->from('tb_paket');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		$this->db->group_by('nama_paket');
		return $this->db->get()->num_rows();
	}

	public function total_barang_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		$this->db->where('is_active = 1');
		return $this->db->get()->num_rows();
	}

	public function total_kategori()
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('is_active = 1');
		return $this->db->get()->num_rows();
	}

	public function total_user()
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		// $this->db->where('id_wo', $this->session->userdata('id_wo'));
		$this->db->where('is_active = 1');
		return $this->db->get()->num_rows();
	}

	public function total_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->where('is_active = 1');
		return $this->db->get()->num_rows();
	}

	public function total_kerjasama()
	{
		$this->db->select('*');
		$this->db->from('tb_kerjasama');
	    $this->db->where('id_wo', $this->session->userdata('id_wo'));
		
		return $this->db->get()->num_rows();
	}

	public function total_kerjasama_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_kerjasama');
	    $this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		
		return $this->db->get()->num_rows();
	}

	public function total_pesanan()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		return $this->db->get()->num_rows();
	}

	public function total_pesanan_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get()->num_rows();
	}

	public function data_setting_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_setting');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get()->row();
	}

	public function edit($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_setting', $data);
	}

}