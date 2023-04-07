<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	public function simpan_transaksi($data)
	{
		$this->db->insert('tb_transaksi', $data);
	}

	public function simpan_rincian_transaksi($data_rinci)
	{
		$this->db->insert('tb_rincian_transaksi', $data_rinci);
	}

	public function keranjang()
	{
		$this->db->select('*');
		$this->db->from('tb_keranjang');
		$this->db->join('tb_barang', 'tb_barang.id_barang = tb_keranjang.id_barang', 'left');
		$this->db->join('tb_paket', 'tb_paket.id_paket = tb_keranjang.id_barang', 'left');
		$this->db->where('tb_keranjang.is_active = 1');
		$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
		return $this->db->get()->result();
	}

	public function progress()
	{
		$this->db->select('*');
		$this->db->from('tb_progress');
		$this->db->where('id_pelanggan',  $this->session->userdata('id_pelanggan'));
		return $this->db->get()->row();
	}

	public function belum_bayar()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
		$this->db->where('status_code = 201');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function diproses()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->where('tb_progress.id_pelanggan', $this->session->userdata('id_pelanggan'));
		$this->db->where('status_code = 200');
		$this->db->where('progress != 100');
		$this->db->order_by('id_transaksi', 'desc');
		$this->db->group_by('tb_transaksi.order_id');
		return $this->db->get()->result();
	}

	public function selesai()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->where('tb_progress.id_pelanggan', $this->session->userdata('id_pelanggan'));
		$this->db->where('status_code = 200');
		$this->db->where('progress = 100');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function detail_pesanan($id_transaksi)
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('id_transaksi', $id_transaksi);
		return $this->db->get()->row();
	}

	public function rekening()
	{
		$this->db->select('*');
		$this->db->from('tb_rekening');
		return $this->db->get()->result();
	}

	public function upload_buktibayar($data)
	{
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->update('tb_transaksi', $data);
	}

	public function delete($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tb_keranjang', $data);
	}

	public function delete_cart()
	{
		$keranjang = $this->m_transaksi->keranjang();
		foreach ($keranjang as $key => $value) {
			$this->db->where('id', $value->id);
		    $this->db->delete('tb_keranjang');
		}
		
	}

	public function get_id()
	{
		$this->db->select('tb_barang.id_vendor, tb_paket.id_wo');
		$this->db->from('tb_kerjasama');
		$this->db->join('tb_barang', 'tb_barang.id_vendor = tb_kerjasama.id_vendor', 'left');
		$this->db->join('tb_paket', 'tb_paket.id_wo = tb_kerjasama.id_wo', 'left');
		return $this->db->get()->result();
	}


}