<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function index()
	{
		$data['sql']= $this->db->get('tb_transaksi');
		$data['isi'] = 'v_order';
       $this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}




}

?>
