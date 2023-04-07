<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_pesanan_masuk');
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard' ,
			
			'isi' => 'v_pimpinan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	
}


?>