<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_laporan');
	}

	public function index()
	{
		$data = array(
			'title' => 'Laporan Penjualan' ,
			'isi' => 'v_laporan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function laporan_vendor()
	{
		$data = array(
			'title' => 'Laporan Penjualan' ,
			'isi' => 'vendor/v_laporan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_harian()
	{
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$data = array(
			'title' => 'Laporan Penjualan Harian' ,
			'tanggal' => $tanggal,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_harian($tanggal, $bulan, $tahun),
			'isi' => 'v_lap_harian' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_harian_vendor()
	{
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$data = array(
			'title' => 'Laporan Penjualan Harian' ,
			'tanggal' => $tanggal,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_harian_vendor($tanggal, $bulan, $tahun),
			'isi' => 'vendor/v_lap_harian' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$data = array(
			'title' => 'Laporan Penjualan Bulanan' ,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_bulanan($bulan, $tahun),
			'isi' => 'v_lap_bulanan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_bulanan_vendor()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$data = array(
			'title' => 'Laporan Penjualan Bulanan' ,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_bulanan_vendor($bulan, $tahun),
			'isi' => 'vendor/v_lap_bulanan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_tahunan()
	{
		$tahun = $this->input->post('tahun');

		$data = array(
			'title' => 'Laporan Penjualan Tahunan' ,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_tahunan($tahun),
			'isi' => 'v_lap_tahunan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_tahunan_vendor()
	{
		$tahun = $this->input->post('tahun');

		$data = array(
			'title' => 'Laporan Penjualan Tahunan' ,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_tahunan_vendor($tahun),
			'isi' => 'vendor/v_lap_tahunan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}



}