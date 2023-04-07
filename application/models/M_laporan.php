<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

	public function lap_harian($tanggal, $bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('tb_rincian_transaksi');
		$this->db->join('tb_transaksi', 'tb_transaksi.order_id= tb_rincian_transaksi.order_id', 'left');
		$this->db->join('tb_barang', 'tb_barang.id_barang = tb_rincian_transaksi.id_barang', 'left');
		$this->db->where('DAY(tb_transaksi.transaction_time)', $tanggal);
		$this->db->where('MONTH(tb_transaksi.transaction_time)', $bulan);
		$this->db->where('YEAR(tb_transaksi.transaction_time)', $tahun);
		$this->db->where('tb_transaksi.id_wo', $this->session->userdata('id_wo'));
		return $this->db->get()->result();
	}

	public function lap_harian_vendor($tanggal, $bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('tb_rincian_transaksi');
		$this->db->join('tb_transaksi', 'tb_transaksi.order_id= tb_rincian_transaksi.order_id', 'left');
		$this->db->join('tb_barang', 'tb_barang.id_barang = tb_rincian_transaksi.id_barang', 'left');
		$this->db->where('DAY(tb_transaksi.transaction_time)', $tanggal);
		$this->db->where('MONTH(tb_transaksi.transaction_time)', $bulan);
		$this->db->where('YEAR(tb_transaksi.transaction_time)', $tahun);
		$this->db->where('tb_transaksi.id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get()->result();
	}

	public function lap_bulanan($bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('MONTH(tb_transaksi.transaction_time)', $bulan);
		$this->db->where('YEAR(tb_transaksi.transaction_time)', $tahun);
		$this->db->where('status_code = 200');
		$this->db->where('tb_transaksi.id_wo', $this->session->userdata('id_wo'));
		return $this->db->get()->result();
	}

	public function lap_bulanan_vendor($bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('MONTH(tb_transaksi.transaction_time)', $bulan);
		$this->db->where('YEAR(tb_transaksi.transaction_time)', $tahun);
		$this->db->where('status_code = 200');
		$this->db->where('tb_transaksi.id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get()->result();
	}

	public function lap_tahunan($tahun)
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('YEAR(tb_transaksi.transaction_time)', $tahun);
		$this->db->where('status_code = 200');
		$this->db->where('tb_transaksi.id_wo', $this->session->userdata('id_wo'));
		return $this->db->get()->result();
	}

	public function lap_tahunan_vendor($tahun)
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('YEAR(tb_transaksi.transaction_time)', $tahun);
		$this->db->where('status_code = 200');
		$this->db->where('tb_transaksi.id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get()->result();
	}	


}