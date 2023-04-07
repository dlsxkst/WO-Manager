<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
			'total_kategori' => $this->m_admin->total_kategori(),
			'total_vendor' => $this->m_admin->total_vendor(),
			'total_user' => $this->m_admin->total_user(),
			'isi' => 'admin/v_admin' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');

			if($this->form_validation->run() == TRUE){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$this->admin_login->login($email, $password);
			}
		
		$data = array(
			'title' => 'Login Admin' ,
			'isi' => 'auth/v_login' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function backup()
	{
		$data = array(
			'title' => 'Backup Data' ,
			'isi' => 'admin/v_backup' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function backup_data()
	{
		$this->load->dbutil();

		$tanggal = date('YmdS-His');

		$config = array(
			'format' => 'zip',
			'filename' => 'Womanager_'.$tanggal.'_db.sql',
			'add_drop' => true,
			'add_insert' => true,
			'newline' => "\n",
			'foreign_key_checks' => false,
		);

		$backup =& $this->dbutil->backup($config);
		$nama_file = 'Womanager_'.$tanggal.'.zip';
		$this->load->helper('download');
		force_download($nama_file, $backup);
	}

	public function transaksi()
	{
		$data = array(
			'title' => 'Transaksi' ,
			'isi' => 'admin/v_transaksi' ,
			'pesanan' => $this->m_pesanan_masuk->pesanan_masuk(),
			'pesanan2' => $this->m_pesanan_masuk->pesanan_masuk2(),
			'diproses' => $this->m_pesanan_masuk->diproses(),
			'diproses2' => $this->m_pesanan_masuk->diproses2(),
			'dikirim' => $this->m_pesanan_masuk->dikirim(),
			'dikirim2' => $this->m_pesanan_masuk->dikirim2(),
			'selesai' => $this->m_pesanan_masuk->selesai(),
			'selesai2' => $this->m_pesanan_masuk->selesai2()
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function sudah_bayar($id_transaksi)
	{
		
		$data = array(
			'id_transaksi' => $id_transaksi,
			'sudah_bayar' => 1
		);

		$this->m_pesanan_masuk->bayar($data);
		$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
		redirect('admin/transaksi');
	
	}

	// public function restore()
	// {
	// 	$this->restore_model->droptabel();

	// 	$fileinput = $_FILES['datafile'];
	// 	$nama = $_FILES['datafile']['name'];

	// 	if (isset($fileinput)) {
	// 		$lokasi_file = $fileinput['tmp_name'];
	// 		$direktori = "backup/$nama";
	// 		move_uploaded_file($lokasi_file, "$direktori");
	// 	}
	// 	//restore
	// 	$isi_file = file_get_contents($direktori);
	// 	$string_query = rtrim($isi_file, "\n;");
	// 	$array_query = explode("~", $string_query);

	// 	foreach ($array_query as $query) {
	// 		$this->db->query($query);
	// 	}

	// 	unlink($direktori);

	// 	$this->session->set_flashdata('message', 'Restore berhasil!');
	// 	redirect('admin/backup', 'refresh');
	// }



	

}


?>