<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Am extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_barang');
		$this->load->model('m_pesanan_masuk');
		$this->load->model('m_user');
		$this->load->model('m_kategori');
		$this->load->model('package_model');
		$this->load->model('m_gambarbarang');
	}

	public function index()
	{
		$data = array(
			'title'           => 'Dashboard' ,
			'total_paket'     => $this->m_admin->total_paket(),
			'total_kerjasama' => $this->m_admin->total_kerjasama(),
			'total_pesanan'   => $this->m_admin->total_pesanan(),
			'isi'             => 'wo/v_am' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function paket()
	{
		$data = array(
			'title'   => 'Paket Pernikahan' ,
			'paket'   =>$this->package_model->get_packages(),
			'package' => $this->package_model->get_paket(),
			'product' => $this->package_model->get_products(),
			'isi'     => 'wo/v_paket' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

public function add_paket()
	{
					if($this->input->post('submit', TRUE) == 'submit'){

					$post = $this->input->post();

					$config['upload_path'] = './assets/gambar/';
					$config['allowed_types'] = 'gif|png|jpg|jpeg';


					$this->upload->initialize($config);
					$field_name = 'gambar';
					if (!$this->upload->do_upload($field_name)) {
						$data = array(
						'title' => 'Add Paket Pernikahan' ,
						'kategori' => $this->m_kategori->get_all_data(),
						'paket' => $this->m_user->paket(),
						'product' => $this->package_model->get_products(),
						'error_upload' => $this->upload->display_errors(),
						'isi' => 'wo/v_add_paket' ,
						 );
					$this->load->view('layout/v_wrapper_backend', $data, FALSE);
						} else {
							if ($post['id_barang'] != '') {
							$upload_data = array('uploads' => $this->upload->data());
							$config['image_library'] = 'gd2';
							$config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
							$this->load->library('image_lib', $config);

							$data = array(
								'nama_paket'		=> $post['nama_paket'],
								'harga_paket'  		=> $post['harga_paket'],
								'kapasitas'  		=> $post['kapasitas'],
								'id_wo'  			=> $post['id_wo'],
								'id_kategori'  		=> $post['id_kategori'],
								'deskripsi'  		=> $post['deskripsi'],
								'is_active'			=> 1,
								'gambar'  			=> $upload_data['uploads']['file_name'],
								'added_by'			=> $this->session->userdata('id_wo'),
								'added_time'		=> date('Y-m-d H:i:s'),
							);

							 $this->db->insert('tb_paket', $data);

							  $package_id = $this->db->insert_id();

							foreach ($post['id_barang'] as $key => $value){
							if($post['id_barang'][$key] != '' || $post['id_vendor'][$key] != ''){

							$result[] = array(
							  'detail_package_id'   => $package_id,
		                      'detail_product_id'   => $_POST['id_barang'][$key],
		                      'id_vendor'           => $_POST['id_vendor'][$key],
							);
						}
					} 
					$this->db->insert_batch('tb_detail_paket', $result);
					$this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
					redirect('am/paket');
							} else {
							$upload_data = array('uploads' => $this->upload->data());
							$config['image_library'] = 'gd2';
							$config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
							$this->load->library('image_lib', $config);

							$data = array(
								'nama_paket'		=> $post['nama_paket'],
								'harga_paket'  		=> $post['harga_paket'],
								'kapasitas'  		=> $post['kapasitas'],
								'id_wo'  			=> $post['id_wo'],
								'id_kategori'  		=> $post['id_kategori'],
								'deskripsi'  		=> $post['deskripsi'],
								'is_active'			=> 1,
								'gambar'  			=> $upload_data['uploads']['file_name'],
								'added_by'			=> $this->session->userdata('id_wo'),
								'added_time'		=> date('Y-m-d H:i:s'),
							);

							 $this->db->insert('tb_paket', $data);
							 $package_id = $this->db->insert_id();
							 $result = array(
							 	'detail_package_id' => $package_id,
							 	
							 	
							 );
							 $this->db->insert('tb_detail_paket', $result);
							 $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
							redirect('am/paket');
							}
							
					}

					}
			
		$data = array(
			'title' => 'Add Paket Pernikahan' ,
			'kategori' => $this->m_kategori->get_all_data(),
			'product' => $this->package_model->get_products(),
			'paket' => $this->m_user->paket(),
			'isi' => 'wo/v_add_paket' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}


	public function edit($id_paket = NULL)
	{
		
		if($this->input->post('submit', TRUE) == 'submit'){

			$post = $this->input->post();
			$id_paket = $post['id_paket'];

			$config['upload_path'] = './assets/gambar/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Edit Paket',
				'kategori' => $this->m_kategori->get_all_data(),
				'paket2' => $this->m_user->paket2($id_paket),
				'paket' => $this->m_barang->get_paket($id_paket),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'wo/v_edit_paket',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					
					$paket = $this->m_barang->get_paket($id_paket);
						if($paket->gambar != "" ){
							unlink('./assets/gambar/'.$paket->gambar);
						}
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);


							$data= array(
								'id_paket'			=> $post['id_paket'],
								'nama_paket'		=> $post['nama_paket'],
								'harga_paket'  		=> $post['harga_paket'],
								'kapasitas'  		=> $post['kapasitas'],
								'id_wo'  			=> $post['id_wo'],
								'id_kategori'  		=> $post['id_kategori'],
								'deskripsi'  		=> $post['deskripsi'],
								'is_active'			=> 1,
								'gambar'  			=> $upload_data['uploads']['file_name'],
								'edited_by'			=> $this->session->userdata('id_wo'),
								'edited_time'		=> date('Y-m-d H:i:s'),

							);
					
					// var_dump($data);
					$this->db->where('id_paket',$id_paket);
            		$this->db->update('tb_paket', $data);
            		$this->db->delete('tb_detail_paket', array('detail_package_id' => $id_paket));
            		$result = array();

            		foreach ($post['id_barang'] as $key => $value){
							if($post['id_barang'][$key] != '' || $post['id_vendor'][$key] != ''){

							$result[] = array(
							  'detail_package_id'   => $id_paket,
		                      'detail_product_id'   => $_POST['id_barang'][$key],
		                      'id_vendor'           => $_POST['id_vendor'][$key],
							);
						}
					}
					// var_dump($result); 
					$this->db->insert_batch('tb_detail_paket', $result);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('am/paket');
			    } 
				$data= array(
								'id_paket'			=> $post['id_paket'],
								'nama_paket'		=> $post['nama_paket'],
								'harga_paket'  		=> $post['harga_paket'],
								'kapasitas'  		=> $post['kapasitas'],
								'id_wo'  			=> $post['id_wo'],
								'id_kategori'  		=> $post['id_kategori'],
								'deskripsi'  		=> $post['deskripsi'],
								'is_active'			=> 1,
								'edited_by'			=> $this->session->userdata('id_wo'),
								'edited_time'		=> date('Y-m-d H:i:s'),
							);
					
					// var_dump($data); 
					$this->db->where('id_paket',$id_paket);
            		$this->db->update('tb_paket', $data);
		
					$this->db->delete('tb_detail_paket', array('detail_package_id' => $id_paket));

					if ($post['id_barang'] == '') {
					 	$result = array(
							 	'detail_package_id' => $id_paket,
							 	
							 	
					);
            		$this->db->insert('tb_detail_paket', $result);
					 } else {
					 foreach ($post['id_barang'] as $key => $value){
            			// echo '<br>id_vendor = '.$post['id_vendor'][$key];
							if($post['id_barang'][$key] != '' || $post['id_vendor'][$key] != ''){

							$result[] = array(
							  'detail_package_id'   => $id_paket,
		                      'detail_product_id'   => $_POST['id_barang'][$key],
		                      'id_vendor'           => $_POST['id_vendor'][$key],
							);
						}
					} 
					// var_dump($result);
					$this->db->insert_batch('tb_detail_paket', $result);
				}
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('am/paket');
			
							
		}

		$data = array(
				'title' => 'Edit Paket',
				'kategori' => $this->m_kategori->get_all_data(),
				'paket2' => $this->m_user->paket2($id_paket),
				'paket' => $this->m_barang->get_paket($id_paket),
				'isi' => 'wo/v_edit_paket',
				 );
		// var_dump($data['paket2']);
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function delete($id_paket = NULL)
	{
		//hapus gambar
		$barang = $this->m_barang->get_paket($id_paket);
		if($barang->gambar != "" ){
			unlink('./assets/gambar/'.$barang->gambar);
		}
		//
		$data = array(
			'id_paket' => $id_paket,
			'is_active' => 0,
			'deleted_by'			=> $this->session->userdata('id_wo'),
			'deleted_time'		=> date('Y-m-d H:i:s'),
			
		);
		$this->m_barang->delete_paket($data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus!');
		redirect('am/paket');
	}

	public function kerjasama()
	{
		$data = array(
			'title' => 'Kerjasama' ,
			'kerjasama' => $this->m_user->kerjasama_wo(),
			'vendor2' => $this->m_user->get_daftarvendor(),
			'daftar_kerjasama' => $this->m_user->daftar_kerjasama(),
			'isi' => 'wo/v_kerjasama' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function ajukan_kerjasama($id_vendor)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'id_wo' => $this->session->userdata('id_wo'),
			'pengirim' => 'wo',
			'penerima' => 'vendor',
			'tanggal' => date('Y-m-d'),
			'lama_kontrak' => '1 tahun',
			'Keterangan' => '2',

		);
		
		$this->m_user->ajukan($data);
		$this->session->set_flashdata('pesan', 'Pengajuan dilakukan! Silakan tunggu konfirmasi dari pihak terkait');
		redirect('am/kerjasama');
	}

	public function terima($id_vendor)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'Keterangan' => 1,

		);
		
		$this->m_user->terima($data);
		$this->session->set_flashdata('pesan', 'Pengajuan diterima!');
		redirect('am/kerjasama');
	}

	public function tolak($id_vendor)
	{
		$data = array(
			'id_vendor' => $id_vendor,
			'Keterangan' => 0,

		);
		
		$this->m_user->tolak($data);
		$this->session->set_flashdata('pesan', 'Pengajuan ditolak!');
		redirect('am/kerjasama');
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
		redirect('am/pesanan_masuk');
		}
	}


	public function chat_pelanggan()
	{
		$data = array(
			'title' => 'Chat Pelanggan',
			'isi' => 'wo/v_chat_pelanggan' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

    public function kirim_pesan() {
      if (!isset($_POST['back']) OR !isset($_POST['id_penerima']) OR !isset($_POST['penerima']) OR !isset($_POST['pesan'])) {
        redirect();
      }
      $back = $_POST['back'];
      $id_pengirim = $this->session->userdata('id_wo');
      $id_penerima = $_POST['id_penerima'];
      $pengirim = 'tb_wo';
      $penerima = $_POST['penerima'];
      $pesan = $_POST['pesan'];
      $waktu = strtotime('now');
      $this->db->query("INSERT INTO `tb_pesan` SET id_pengirim='$id_pengirim', id_penerima='$id_penerima', pengirim='$pengirim', penerima='$penerima', pesan='$pesan', waktu='$waktu'");
      redirect($back);
    }

    public function chat_vendor()
	{
		$data = array(
			'title' => 'Chat vendor',
			'isi' => 'wo/v_chat_vendor' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

     public function kirim_pesan_wo() {
      if (!isset($_POST['back']) OR !isset($_POST['id_penerima']) OR !isset($_POST['penerima']) OR !isset($_POST['pesan'])) {
        redirect();
      }
      $back = $_POST['back'];
      $id_pengirim = $this->session->userdata('id_wo');
      $id_penerima = $_POST['id_penerima'];
      $pengirim = 'tb_wo';
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
			'pesanan' => $this->m_pesanan_masuk->pesanan(),
			'pesanan_diproses' => $this->m_pesanan_masuk->pesanan_diproses_wo(),
			// 'pesanan_dikirim' => $this->m_pesanan_masuk->pesanan_dikirim(),
			'pesanan_selesai' => $this->m_pesanan_masuk->pesanan_selesai_wo(),
			'isi' => 'v_pesanan_masuk' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
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
			'wo' => $this->m_user->get_data_wo(),
			'isi' => 'wo/v_profile' ,
			 );
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}


	public function edit_profile()
	{
		if($this->input->post('submit', TRUE) == 'submit'){
		$this->form_validation->set_rules('nama_toko', 'nama toko', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'nomor telepon', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('no_rek', 'nomor rekening', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/foto/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'gambar';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Edit Profile',
				'wo' => $this->m_user->get_data_wo(),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'wo/v_edit',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
				} else {
					$barang = $this->m_user->get_data_wo();
						if($barang->gambar != "" ){
							unlink('./assets/foto/'.$barang->gambar);
						}
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/foto/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_wo' => $this->input->post('id_wo'),
						'nama_toko' => $this->input->post('nama_toko'),
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
					$this->m_user->edit_wo($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('am/profile');
				}
				$data = array(
						'id_wo' => $this->input->post('id_wo'),
						'nama_toko' => $this->input->post('nama_toko'),
						'username' => $this->input->post('username'),
						'no_telp' => $this->input->post('no_telp'),
						'email' => $this->input->post('email'),
						'no_rek' => $this->input->post('no_rek'),
						'alamat' => $this->input->post('alamat'),
						'deskripsi' => $this->input->post('deskripsi'),
						'edited_by' => $this->session->userdata('id_wo'),
						'edited_time' => date('Y-m-d H:i:s')
					);
					$this->m_user->edit_wo($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('am/profile');
		}
		}elseif($this->input->post('changepass', TRUE) == 'changepass'){
			$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
            $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|matches[new_password1]');

        if($this->form_validation->run() == TRUE) {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if ($current_password == $this->session->userdata('password')) {
                $this->session->set_flashdata('error', 'Wrong current password!');
                redirect('am/edit_profile');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'New password cannot be the same as current password!');
                    redirect('am/edit_profile');
                } else {
                	$password = md5($new_password);    
                 $this->db->set('password', $password);
                    $this->db->where('id_wo', $this->session->userdata('id_wo'));
                    $this->db->update('tb_wo');

                    $this->session->set_flashdata('message', 'Password changed!');
                    redirect('am/profile');
                }
            }
	   }
	}	

		$data = array(
				'title' => 'Edit Profile',
				'wo' => $this->m_user->get_data_wo(),
				'isi' => 'wo/v_edit',
				 );
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function gallery()
	{
		$data = array(
			'title' => 'Gallery',
			'gallery' => $this->m_kategori->get_gallery(),
			'isi' => 'wo/v_gallery',
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
				'isi' => 'wo/v_add_gallery' ,
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
					redirect('am/add_gallery/'.$id_gallery);
				}
		}	

		$data = array(
			'title' => 'Add Gambar' ,
			'gallery' => $this->m_barang->get_data_gallery($id_gallery),
			'gambar' => $this->m_gambarbarang->get_gallery($id_gallery),
			'isi' => 'wo/v_add_gallery' ,
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
		redirect('am/add_gallery/'. $id_gallery);
	}



}


?>