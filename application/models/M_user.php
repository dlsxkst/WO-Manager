<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function get_all_data()
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->where('tb_wo.is_active != 3');
		$this->db->order_by('id_wo', 'asc');
		return $this->db->get()->result();
	}

	public function get_wo()
	{
		$this->db->select('tb_wo.*, tb_kerjasama.*, tb_wo.id_wo');
		$this->db->from('tb_wo');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_wo = tb_wo.id_wo and tb_kerjasama.id_vendor =  '.$this->session->userdata('id_vendor').'', 'left');
		$this->db->where('tb_wo.is_active = 1');
		$this->db->order_by('tb_wo.id_wo', 'asc');
		$this->db->group_by('tb_wo.id_wo');
		return $this->db->get()->result();
	}

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->where('tb_vendor.is_active != 3');
		$this->db->order_by('id_vendor', 'asc');
		return $this->db->get()->result();
	}	

	public function get_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_vendor.id_kategori', 'left');
		$this->db->where('tb_vendor.id_wo', $this->session->userdata('id_wo'));
		$this->db->where('tb_vendor.is_active = 1');
		$this->db->order_by('tb_vendor.id_vendor', 'desc');
		return $this->db->get()->result();
	}

	public function get_data_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_admin');
		$this->db->join('tb_vendor', 'tb_vendor.nama_vendor = tb_admin.nama_user', 'left');
		$this->db->where('tb_vendor.id_wo', $this->session->userdata('id_wo'));
		$this->db->where('tb_vendor.is_active = 1');
		return $this->db->get()->result();
	}

	public function get_data_wo()
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		return $this->db->get()->row();
	}	

	public function edit_wo($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_wo', $data);
	}

	public function save_batch($data)
	{
		$this->db->insert_batch('tb_paket', $data);
	}

	public function daftar_paket()
	{
		$this->db->distinct('nama_paket');
		$this->db->from('tb_paket');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_wo=tb_paket.id_wo', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_barang=tb_paket.id_barang', 'outer left');
        $this->db->where('tb_paket.is_active = 1');
        $this->db->group_by('nama_paket');
		return $this->db->get()->result();
	}

	public function get_data_vendor2()
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get()->row();
	}	

	public function edit_vendor2($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_vendor', $data);
	}

	public function add($data)
	{
		$this->db->insert('tb_admin', $data);
	}

	public function add_wo($data2)
	{
		$this->db->insert('tb_wo', $data2);
	}

	public function add_vendor($data2)
	{
		$this->db->insert('tb_vendor', $data2);
	}

	public function edit($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_wo', $data);
	}

	public function edit_vendor($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_vendor', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_wo', $data);
	}

	public function aktif($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_wo', $data);
	}

	public function update_wo($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_wo', $data);
	}

	public function update_vendor($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_vendor', $data);
	}

	public function update_paket($data)
	{
		$this->db->where('id_paket', $data['id_paket']);
		$this->db->update('tb_paket', $data);
	}

	public function delete_vendor($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_vendor', $data);
	}

	public function aktif_vendor($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_vendor', $data);
	}

	public function belum_verif_wo()
	{
		$this->db->select('*');
		$this->db->from('tb_wo');
		$this->db->where('is_active = 3');
		$this->db->order_by('id_wo', 'desc');
		return $this->db->get()->result();
	}

	public function belum_verif()
	{
		$this->db->select('*');
		$this->db->from('tb_vendor');
		$this->db->where('is_active = 3');
		$this->db->order_by('id_vendor', 'desc');
		return $this->db->get()->result();
	}

	public function kerjasama()
	{
		$this->db->select('*');
		$this->db->from('tb_kerjasama');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_kerjasama.id_wo', 'left');
		$this->db->where('keterangan = 1');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get()->result();
	}

	public function kerjasama_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_kerjasama');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_kerjasama.id_wo', 'left');
		$this->db->where('keterangan = 2 AND penerima = "vendor" AND id_vendor = '.$this->session->userdata('id_vendor').' ');

		return $this->db->get()->result();
	}

	public function ajukan($data)
	{
		$this->db->insert('tb_kerjasama', $data);
	}

	public function kerjasama_wo()
	{
		$this->db->select('*');
		$this->db->from('tb_kerjasama');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_kerjasama.id_vendor', 'left');
		$this->db->where('keterangan = 2 AND penerima = "wo" AND id_wo = '.$this->session->userdata('id_wo').' ');
		return $this->db->get()->result();
	}

	public function terima($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_kerjasama', $data);
	}

	public function tolak($data)
	{
		$this->db->where('id_vendor', $data['id_vendor']);
		$this->db->update('tb_kerjasama', $data);
	}

	public function terima_wo($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_kerjasama', $data);
	}

	public function tolak_wo($data)
	{
		$this->db->where('id_wo', $data['id_wo']);
		$this->db->update('tb_kerjasama', $data);
	}

	public function get_daftarvendor()
	{
		$this->db->select('tb_kerjasama.*, tb_vendor.*');
		$this->db->from('tb_vendor');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor = tb_vendor.id_vendor and tb_kerjasama.id_wo =  '.$this->session->userdata('id_wo').'', 'left');
		$this->db->where('tb_vendor.is_active = 1');
		$this->db->order_by('tb_vendor.id_vendor', 'asc');
		$this->db->group_by('tb_vendor.id_vendor');
		return $this->db->get()->result();
	}

	public function daftar_kerjasama()
	{
		$this->db->select('*');
		$this->db->from('tb_kerjasama');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_kerjasama.id_vendor', 'left');
		$this->db->where('keterangan = 1');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		return $this->db->get()->result();
	}

	public function paket()
	{
		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor', 'inner');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor = tb_barang.id_vendor', 'outer left');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		return $this->db->get()->result();
	}

		public function get_paket($id_paket)
	{
		$this->db->select('*');
		$this->db->from('tb_paket');
		$this->db->join('tb_barang', 'tb_barang.id_barang = tb_paket.id_barang', 'left');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_wo = tb_paket.id_wo', 'left outer');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_paket.id_kategori', 'left');
		$this->db->group_by('tb_paket.nama_paket');
		$this->db->where('id_paket', $id_paket);
		return $this->db->get()->row();
	}

	public function paket2($id_paket)
	{
		$this->db->select('tb_barang.id_barang as id_barang, tb_barang.id_vendor as id_vendor, tb_detail_paket.detail_product_id as detail_product_id, tb_barang.nama_barang as nama_barang, tb_barang.harga as harga, tb_vendor.nama_vendor as nama_vendor');
		$this->db->from('tb_barang');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_barang.id_vendor', 'inner');
		$this->db->join('tb_detail_paket', 'tb_detail_paket.detail_product_id = tb_barang.id_barang AND tb_detail_paket.detail_package_id ='.$id_paket.'', 'left');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor = tb_detail_paket.id_vendor');
		// $this->db->where('tb_detail_paket.detail_package_id', $id_paket);
		$this->db->group_by('tb_barang.nama_barang');
		return $this->db->get()->result();
	}

	public function data_paket()
	{
		$this->db->select('*');
		$this->db->from('tb_paket');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_paket.id_vendor', 'left');
		$this->db->join('tb_barang', 'tb_barang.id_barang = tb_paket.id_barang', 'inner');
		$this->db->join('tb_kerjasama', 'tb_kerjasama.id_barang = tb_paket.id_barang', 'left outer');
		$this->db->group_by('tb_paket.nama_paket');
		return $this->db->get()->result();
	}


}

?>
