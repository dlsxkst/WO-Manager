<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan_masuk extends CI_Model {

	public function pesanan()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 201');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function pesanan_masuk()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_transaksi.id_wo');
		$this->db->where('status_code = 201');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function pesanan_masuk2()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_transaksi.id_vendor');
		$this->db->where('status_code = 201');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function diproses()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_transaksi.id_wo');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function diproses2()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_transaksi.id_vendor');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function dikirim()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_transaksi.id_wo');
		$this->db->where('sudah_bayar', NULL);
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function dikirim2()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_transaksi.id_vendor');
		$this->db->where('sudah_bayar', NULL);
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function selesai()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->join('tb_wo', 'tb_wo.id_wo = tb_transaksi.id_wo');
		$this->db->where('sudah_bayar = 1');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function selesai2()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->join('tb_vendor', 'tb_vendor.id_vendor = tb_transaksi.id_vendor');
		$this->db->where('sudah_bayar = 1');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function pesanan_vendor()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 201');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function pesanan_diproses()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		$this->db->where('progress != 100');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function pesanan_diproses_wo()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		$this->db->where('progress != 100');
		$this->db->order_by('id_transaksi', 'desc');
		$this->db->group_by('tb_transaksi.order_id');
		return $this->db->get()->result();
	}

	public function progress($data)
	{
		if ($data['progress'] == '') {
			$this->db->insert('tb_progress', $data);
		} else {
			$this->db->where('id', $data['id']);
			$this->db->update('tb_progress', $data);
			
	    }
	}

	public function pesanan_selesai()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		$this->db->where('progress = 100');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function pesanan_selesai_wo()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('status_code = 200');
		$this->db->join('tb_progress', 'tb_progress.order_id = tb_transaksi.order_id', 'left');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		$this->db->where('progress = 100');
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->get()->result();
	}

	public function update_order($data)
	{
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->update('tb_transaksi', $data);
	}

	public function bayar($data)
	{
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->update('tb_transaksi', $data);
	}
		


}