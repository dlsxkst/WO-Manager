<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
		
	}

	public function index()
	{
		$keranjang = $this->m_transaksi->keranjang();
		if (empty($keranjang)) {
			redirect('home');
		}
		$data = array(
			'title' => 'Keranjang' ,
			'keranjang' => $this->m_transaksi->keranjang(),
			'isi' => 'home/v_belanja' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function add()
	{
		$this->pelanggan_login->proteksi_halaman();
		$redirect_page = $this->input->post('redirect_page');
		// $cek = $this->db->get_where('tb_keranjang', ['id_barang' => $this->input->post('id'), 'id_pelanggan' => $this->input->post('id_pelanggan'), 'id_vendor' => $this->input->post('id_vendor'), 'id_wo' => $this->input->post('id_wo')]);
		// if ($cek->num_rows() > 0 ) {
		// 	$get = $cek->row_array();
		// 	$this->db->update('tb_keranjang', ['qty' => $get['qty']+1], ['id_barang' => $this->input->post('id'), 'id_pelanggan' => $this->input->post('id_pelanggan'), 'id_vendor' => $this->input->post('id_vendor'), 'id_wo' => $this->input->post('id_wo')]);
		// } else {
			$data = array(
				'id_barang' => $this->input->post('id'),
				'qty' =>  $this->input->post('qty'),
				'price' =>  $this->input->post('price'),
				'name' => $this->input->post('name'),
				'id_pelanggan' => $this->input->post('id_pelanggan'),
				'id_vendor' => $this->input->post('id_vendor'),
				'id_wo' => $this->input->post('id_wo'),
				'time' => date('Y-m-d H:i:s'),
				'is_active' => 1
			);
			$this->db->insert('tb_keranjang', $data);
		// }
		
		// $this->cart->insert($data);
		redirect($redirect_page, 'refresh');
	}

	public function delete($id)
	{
		$data = array(
			'id' => $id,
			'is_active' => 0,
		);
		$this->m_transaksi->delete($data);
		redirect('belanja');
	}

	public function clear()
	{
		$keranjang = $this->m_transaksi->keranjang();
		foreach ($keranjang as $key => $value) {
			$data = array(
			'is_active' => 0,
		);
		$this->db->update('tb_keranjang', $data);
		}
		redirect('belanja');
	}

	public function update()
	{
		$i = 1;
		foreach ($this->cart->contents() as $items) {
			$data = array(
			        'rowid' => $items['rowid'],
			        'qty'   => $this->input->post($i . '[qty]')
		);

		$this->cart->update($data);
		$i++;
		}
		$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate!!');
		redirect('belanja');		

	}

	public function checkout()
	{
		$this->pelanggan_login->proteksi_halaman();

		$this->form_validation->set_rules('provinsi', 'provinsi', 'required');
		$this->form_validation->set_rules('kota', 'kota', 'required');
		$this->form_validation->set_rules('ekspedisi', 'ekspedisi', 'required');
		$this->form_validation->set_rules('paket', 'paket', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('kode_pos', 'kode pos', 'required');
		$this->form_validation->set_rules('nama_penerima', 'nama penerima', 'required');
		$this->form_validation->set_rules('hp_penerima', 'nomor telepon penerima', 'required');


		if ($this->form_validation->run() == FALSE) {
			$data = array(
			'title' => 'Check-out' ,
			
			'isi' => 'v_checkout' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
		} else {
			//simpan ke table transaksi
			$data = array(
				'id_pelanggan' => $this->session->userdata('id_pelanggan'),
				'no_order' => $this->input->post('no_order'),
				'tgl_order' => date('Y-m-d'),
				'nama_penerima' => $this->input->post('nama_penerima'),
				'hp_penerima' => $this->input->post('hp_penerima'),
				'provinsi' => $this->input->post('provinsi'),
				'kota' => $this->input->post('kota'),
				'alamat' => $this->input->post('alamat'),
				'kode_pos' => $this->input->post('kode_pos'),
				'ekspedisi' => $this->input->post('ekspedisi'),
				'paket' => $this->input->post('paket'),
				'estimasi' => $this->input->post('estimasi'),
				'ongkir' => $this->input->post('ongkir'),
				'berat' => $this->input->post('berat'),
				'subtotal' => $this->input->post('subtotal'),
				'total_bayar' => $this->input->post('total_bayar'),
				'status_bayar' => '0',
				'status_order' => '0',
			);

			$this->m_transaksi->simpan_transaksi($data);
			//simpan ke tabel rinc transaksi
			$i = 1;
			foreach ($this->cart->contents() as $items) {
				$data_rinci = array(
					'no_order' => $this->input->post('no_order'),
					'id_barang' => $items['id'],
					'qty' => $this->input->post('qty'.$i++),
				);
				$this->m_transaksi->simpan_rincian_transaksi($data_rinci);
			}


			$this->session->set_flashdata('pesan', 'Pesanan Berhasil Diproses!!');
			$this->db->destroy();
			redirect('pesanan_saya');
		}

		
	}

}
