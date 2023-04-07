<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gambarpaket extends CI_Model {

	public function get_all_data()
	{
		$this->db->select('tb_paket.*, COUNT(tb_gambarpaket.id_paket) as total_gambar');
		$this->db->from('tb_paket');
		$this->db->join('tb_gambarpaket', 'tb_gambarpaket.id_paket = tb_paket.id_paket', 'left');
		$this->db->where('tb_paket.is_active = 1');
		$this->db->where('id_wo', $this->session->userdata('id_wo'));
		$this->db->group_by('tb_paket.id_paket');
		$this->db->order_by('tb_paket.id_paket', 'asc');
		return $this->db->get()->result();
	}

	public function get_gambar($id_paket)
	{
		$this->db->select('*');
		$this->db->from('tb_gambarpaket');
		$this->db->where('id_paket', $id_paket);
		return $this->db->get()->result();
	}

	public function get_data($id_gambar)
	{
		$this->db->select('*');
		$this->db->from('tb_gambarpaket');
		$this->db->where('id_gambar', $id_gambar);
		return $this->db->get()->row();
	}

	public function add($data)
	{
		$this->db->insert('tb_gambarpaket', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_gambar', $data['id_gambar']);
		$this->db->delete('tb_gambarpaket', $data);
	}

}
