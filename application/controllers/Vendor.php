<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_pesanan_masuk');
		$this->load->model('m_user');
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_gambarbarang');
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard' ,
			'total_barang' => $this->m_admin->total_barang_vendor(),
			'total_kerjasama' => $this->m_admin->total_kerjasama_vendor(),
			'total_pesanan' => $this->m_admin->total_pesanan_vendor(),
			'isi' => 'vendor/v_dashboard_vendor' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function kerjasama()
	{
		$data = array(
			'title' => 'Kerjasama' ,
			'wo' => $this->m_user->get_wo(),
			'kerjasama_vendor' => $this->m_user->kerjasama_vendor(),
			'kerjasama' => $this->m_user->kerjasama(),
			'isi' => 'vendor/v_kerjasama_vendor' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
		
	}

	public function ajukan_kerjasama($id_wo)
	{
		$data = array(
			'id_wo' => $id_wo,
			'id_vendor' => $this->session->userdata('id_vendor'),
			'pengirim' => 'vendor',
			'penerima' => 'wo',
			'tanggal' => date('Y-m-d'),
			'lama_kontrak' => '1 tahun',
			'Keterangan' => '2',

		);
		
		$this->m_user->ajukan($data);
		$this->session->set_flashdata('pesan', 'Pengajuan dilakukan! Silakan tunggu konfirmasi dari pihak terkait');
		redirect('vendor/kerjasama');
	}

	public function terima_wo($id_wo)
	{
		$data = array(
			'id_wo' => $id_wo,
			'keterangan' => '1',

		);
		
		$this->m_user->terima_wo($data);
		$this->session->set_flashdata('pesan', 'Pengajuan diterima!');
		redirect('vendor/kerjasama');
	}

	public function tolak_wo($id_wo)
	{
		$data = array(
			'id_wo' => $id_wo,
			'keterangan' => 0,

		);
		
		$this->m_user->tolak_wo($data);
		$this->session->set_flashdata('pesan', 'Pengajuan ditolak!');
		redirect('vendor/kerjasama');
	}


	public function chat_pelanggan()
	{
		$data = array(
			'title' => 'Chat Pelanggan',
			'isi' => 'vendor/v_chat_pelanggan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

    public function kirim_pesan() {
      if (!isset($_POST['back']) OR !isset($_POST['id_penerima']) OR !isset($_POST['penerima']) OR !isset($_POST['pesan'])) {
        redirect();
      }
      $back = $_POST['back'];
      $id_pengirim = $this->session->userdata('id_vendor');
      $id_penerima = $_POST['id_penerima'];
      $pengirim = 'tb_vendor';
      $penerima = $_POST['penerima'];
      $pesan = $_POST['pesan'];
      $waktu = strtotime('now');
      $this->db->query("INSERT INTO `tb_pesan` SET id_pengirim='$id_pengirim', id_penerima='$id_penerima', pengirim='$pengirim', penerima='$penerima', pesan='$pesan', waktu='$waktu'");
      redirect($back);
    }

    	public function chat_wo()
	{
		$data = array(
			'title' => 'Chat Wedding Organizer',
			'isi' => 'vendor/v_chat_wo' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

    public function kirim_pesan_wo() {
      if (!isset($_POST['back']) OR !isset($_POST['id_penerima']) OR !isset($_POST['penerima']) OR !isset($_POST['pesan'])) {
        redirect();
      }
      $back = $_POST['back'];
      $id_pengirim = $this->session->userdata('id_vendor');
      $id_penerima = $_POST['id_penerima'];
      $pengirim = 'tb_vendor';
      $penerima = $_POST['penerima'];
      $pesan = $_POST['pesan'];
      $waktu = strtotime('now');
      $this->db->query("INSERT INTO `tb_pesan` SET id_pengirim='$id_pengirim', id_penerima='$id_penerima', pengirim='$pengirim', penerima='$penerima', pesan='$pesan', waktu='$waktu'");
      redirect($back);
    }


	public function pesanan_masuk()
	{
		$data = array(
			'title' => 'Pesanan Masuk' ,
			'pesanan' => $this->m_pesanan_masuk->pesanan_vendor(),
			'pesanan_diproses' => $this->m_pesanan_masuk->pesanan_diproses(),
			// 'pesanan_dikirim' => $this->m_pesanan_masuk->pesanan_dikirim(),
			'pesanan_selesai' => $this->m_pesanan_masuk->pesanan_selesai(),
			'isi' => 'vendor/v_pesanan_masuk' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function progress()
	{
		if($this->input->post('submit', TRUE) == 'submit'){
		$data = array(
			'id' => $this->input->post('id'),
			'order_id' => $this->input->post('order_id'),
			'id_pelanggan' => $this->input->post('id_pelanggan'),
			'progress' => $this->input->post('progress'),
		);
		$this->m_pesanan_masuk->progress($data);
		$this->session->set_flashdata('pesan', 'Progress berhasil diperbaharui!');
		redirect('vendor/pesanan_masuk');
		}
	}

	public function proses($id_transaksi)
	{
		$data = array(
			'id_transaksi' => $id_transaksi,
			'status_order' => '1',

		);
		$this->m_pesanan_masuk->update_order($data);
		$this->session->set_flashdata('pesan', 'Pesanan berhasil diproses!');
		redirect('admin/pesanan_masuk');
	}

	public function kirim($id_transaksi)
	{
		$data = array(
			'id_transaksi' => $id_transaksi,
			'no_resi' => $this->input->post('no_resi'),
			'status_order' => '2',

		);
		$this->m_pesanan_masuk->update_order($data);
		$this->session->set_flashdata('pesan', 'Pesanan berhasil dikirim!');
		redirect('admin/pesanan_masuk');
	}

	public function profile()
	{
		$data = array(
			'title' => 'Profile' ,
			'vendor' => $this->m_user->get_data_vendor2(),
			'isi' => 'vendor/v_profile_vendor' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}


	public function edit_profile()
	{
		if($this->input->post('submit', TRUE) == 'submit'){
		$this->form_validation->set_rules('nama_vendor', 'nama vendor', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'nomor telepon', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('no_rek', 'nomor rekening', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/foto/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Edit Profile',
				'vendor' => $this->m_user->get_data_vendor2(),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'vendor/v_edit_vendor',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$barang = $this->m_user->get_data_vendor2();
						if($barang->gambar != "" ){
							unlink('./assets/foto/'.$barang->gambar);
						}
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/foto/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_vendor' => $this->input->post('id_vendor'),
						'nama_vendor' => $this->input->post('nama_vendor'),
						'username' => $this->input->post('username'),
						'no_telp' => $this->input->post('no_telp'),
						'email' => $this->input->post('email'),
						'no_rek' => $this->input->post('no_rek'),
						'alamat' => $this->input->post('alamat'),
						'deskripsi' => $this->input->post('deskripsi'),
						'gambar' => $upload_data['uploads']['file_name'],
						'edited_by' => $this->session->userdata('id_wo'),
						'edited_time' => date('Y-m-d H:i:s')
					);
					$this->m_user->edit_vendor2($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('vendor/profile');
				}
				$data = array(
						'id_vendor' => $this->input->post('id_vendor'),
						'nama_vendor' => $this->input->post('nama_vendor'),
						'username' => $this->input->post('username'),
						'no_telp' => $this->input->post('no_telp'),
						'email' => $this->input->post('email'),
						'no_rek' => $this->input->post('no_rek'),
						'alamat' => $this->input->post('alamat'),
						'deskripsi' => $this->input->post('deskripsi'),
						'edited_by' => $this->session->userdata('id_wo'),
						'edited_time' => date('Y-m-d H:i:s')
					);
					$this->m_user->edit_vendor2($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('vendor/profile');
		}
		}elseif ($this->input->post('changepass', TRUE) == 'changepass') {
			$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
            $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|matches[new_password1]');

        if($this->form_validation->run() == TRUE) {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if ($current_password == $this->session->userdata('password')) {
                $this->session->set_flashdata('error', 'Wrong current password!');
                redirect('vendor/edit_profile');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'New password cannot be the same as current password!');
                    redirect('vendor/edit_profile');
                } else {
                	$password = md5($new_password);    
                 $this->db->set('password', $password);
                    $this->db->where('id_vendor', $this->session->userdata('id_vendor'));
                    $this->db->update('tb_vendor');

                    $this->session->set_flashdata('message', 'Password changed!');
                    redirect('vendor/profile');
                }
            }
	   }
		}	

		$data = array(
				'title' => 'Edit Profile',
				'vendor' => $this->m_user->get_data_vendor2(),
				'isi' => 'vendor/v_edit_vendor',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function setting()
	{
		$this->form_validation->set_rules('nama_toko', 'nama toko', 'required');
		$this->form_validation->set_rules('kab', 'kota', 'required');
		$this->form_validation->set_rules('alamat_toko', 'alamat toko', 'required');
		$this->form_validation->set_rules('no_telepon', 'nomor telepon', 'required');
		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();

		if($this->form_validation->run() == FALSE) {
			$data = array(
			'title' => 'Setting' ,
			'provinsi' => $get_prov->result(),
			'isi' => 'vendor/v_setting' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);

		}else{
			$data = array(
			'id_vendor' => $this->session->userdata('id_vendor'),
			'provinsi' => $this->input->post('prov'), 
			'kota' => $this->input->post('kab'),
			'nama_toko' => $this->input->post('nama_toko'),
			'alamat_toko' => $this->input->post('alamat_toko'),
			'no_telepon' => $this->input->post('no_telepon'),
			'add_charge' => $this->input->post('add_charge'),
		);


		$this->db->insert('tb_setting', $data);
		$this->session->set_flashdata('message', 'Setting berhasil diubah!');
		redirect('vendor/setting');
		}
		
	}

	public function gallery()
	{
		$data = array(
			'title' => 'Gallery',
			'gallery' => $this->m_kategori->get_gallery_vendor(),
			'isi' => 'vendor/v_gallery',
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add_gallery($id_gallery)
	{
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');
	

		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gallery/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Add Gambar',
				'error_upload' => $this->upload->display_errors(),
				'gallery' => $this->m_barang->get_data_gallery($id_gallery),
				'gambar' => $this->m_gambarbarang->get_gallery($id_gallery),
				'isi' => 'vendor/v_add_gallery' ,
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gallery/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_gallery' => $id_gallery,
						'keterangan' => $this->input->post('keterangan'),
						'gambar' => $upload_data['uploads']['file_name'],
					);
					$this->db->insert('tb_detail_gallery', $data);
					$this->session->set_flashdata('message', 'Gambar berhasil ditambahkan!');
					redirect('vendor/add_gallery/'.$id_gallery);
				}
		}	

		$data = array(
			'title' => 'Add Gambar' ,
			'gallery' => $this->m_barang->get_data_gallery($id_gallery),
			'gambar' => $this->m_gambarbarang->get_gallery($id_gallery),
			'isi' => 'vendor/v_add_gallery' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function delete_gambar($id_gallery, $id_gambar)
	{
		//hapus gambar
		$gambar = $this->m_gambarbarang->get_data_gambar($id_gambar);
		if($gambar->gambar != "" ){
			unlink('./assets/gallery/'.$gambar->gambar);
		}
		//
		$data = array('id_gambar' => $id_gambar);
		$this->m_gambarbarang->delete_gambar($data);
		$this->session->set_flashdata('message', 'Gambar berhasil dihapus!');
		redirect('vendor/add_gallery/'. $id_gallery);
	}

	public function delete_gambar_vendor($id_gallery, $id_gambar)
	{
		//hapus gambar
		$gambar = $this->m_gambarbarang->get_data_gambar($id_gambar);
		if($gambar->gambar != "" ){
			unlink('./assets/gallery/'.$gambar->gambar);
		}
		//
		$data = array('id_gambar' => $id_gambar);
		$this->m_gambarbarang->delete_gambar($data);
		$this->session->set_flashdata('message', 'Gambar berhasil dihapus!');
		redirect('vendor/add_gallery/'. $id_gallery);
	}

}


?>