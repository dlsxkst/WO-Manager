<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_pelanggan');
		$this->load->model('m_auth');
		$this->load->model('m_kategori');
	}

	private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                //cek pass
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                    } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                    }
             } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This Email has not been activated!</div>');
                redirect('auth');
            }
        } else {
            //user gaada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered.</div>');
            redirect('auth');
        }
      }

	public function login_user()
	{
		$data = array(
				'title' => 'Login User',
				'isi' =>'auth/v_login_pelanggan'
				 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);	

		$level = $this->input->post('level_user');
		if ($level == 1) {
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');

			if($this->form_validation->run() == TRUE){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$this->admin_login->login($email, $password);
			}
		}
		elseif ($level == 2) {
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');

			if($this->form_validation->run() == TRUE){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$this->wo_login->login_wo($email, $password);
			}
		}
		elseif ($level == 3) {
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');

			if($this->form_validation->run() == TRUE){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$this->vendor_login->login_vendor($email, $password);
			}
			
		} else{
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');

			if($this->form_validation->run() == TRUE){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$this->pelanggan_login->login($email, $password);
			}
		}

	}


	public function logout_admin()
	{
		$this->admin_login->logout();
	}

	public function logout_wo()
	{
		$this->wo_login->logout();
	}

	public function logout_vendor()
	{
		$this->vendor_login->logout();
	}


		public function register()
	    {
	    	$this->form_validation->set_rules('nama_pelanggan', 'full name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[tb_pelanggan.email]', array(
				'is_unique' => 'This email has already taken'
			));
			$this->form_validation->set_rules('password', 'Password', 'required|matches[ulangi_password]', array(
				'matches' => 'Password not match!',
			));
			$this->form_validation->set_rules('ulangi_password', 'Retype Password', 'required');
			$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
		    $level = $this->input->post('level_user');
		    if ($level == 2) 
		    {
			

			if ($this->form_validation->run() == true) {
				$data = array(
				'title' => 'Register WO' ,
				'provinsi' => $get_prov->result(),
				 );
			$this->load->view('auth/v_register_wo', $data, FALSE);
			
		} }
		elseif ($level == 3)
		{
			
			if ($this->form_validation->run() == true) {
				$data = array(
				'title' => 'Register Vendor' ,
				'kategori' => $this->m_kategori->get_all_data(),
				'provinsi' => $get_prov->result(),
				 );
			$this->load->view('auth/v_register_vendor', $data, FALSE);
			} else{
				redirect('auth/register');
			} 
		}else {
			$this->form_validation->set_rules('nama_pelanggan', 'full name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[tb_pelanggan.email]', array(
				'is_unique' => 'This email has already taken'
			));
			$this->form_validation->set_rules('password', 'Password', 'required|matches[ulangi_password]', array(
				'matches' => 'Password not match!',
			));
			$this->form_validation->set_rules('ulangi_password', 'Retype Password', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array(
				'title' => 'Register' ,
				'isi' => 'auth/v_register' ,
				 );
			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

			}else{
				$data = array(
				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'foto' => 'default.jpg'
			);


			$this->m_pelanggan->register($data);
			$this->session->set_flashdata('message', 'Congratulations! Your account has been created. Please Login!!');
			redirect('auth/login_user');
			}
		}
		
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
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function logout()
	{
		$this->pelanggan_login->logout();
	}

	public function register_wo()
	{
		$this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[tb_wo.email]', array(
				'is_unique' => 'This email has already taken'
			));
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('alamat', 'alamat', 'required');
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('no_telp', 'nomor telepon', 'required');
			$this->form_validation->set_rules('no_rek', 'nomor rekening', 'required');
		    $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		    $this->form_validation->set_rules('kab', 'kota', 'required');

		    $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
			$data = array(
				'title' => 'Register WO' ,
				'provinsi' => $get_prov->result(),
			);

            $hasil = json_decode(file_get_contents('assets/json/kota.json'), true);
            $cek_kota = array();
            foreach ($hasil as $kota) {
            	array_push($cek_kota, $kota['city']);
            }
		    if (!in_array($this->input->post('add_charge'), $cek_kota)) {
		    	$this->session->set_flashdata('kota', 'Silakan pilih kota dalam daftar!');
		    	$this->load->view('auth/v_register_wo', $data, FALSE);
		    } else {
				if ($this->form_validation->run() == FALSE) {
				$this->load->view('auth/v_register_wo', $data, FALSE);
				} else {
		            foreach ($hasil as $dapatkan) {
		            	if ($this->input->post('add_charge') == $dapatkan['city']) {
		            		$latlong = $dapatkan['lat'].'==='.$dapatkan['lng'];
		            	}
		            }
					$data2 = array(
							'nama_toko' => $this->input->post('nama_toko'),
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post('password')),
							'level_user' => $this->input->post('level_user'),
							'no_telp' => $this->input->post('no_telp'),
							'email' => $this->input->post('email'),
							'no_rek' => $this->input->post('no_rek'),
							'prov' => $this->input->post('prov'),
							'kab' => $this->input->post('kab'),
							'alamat' => $this->input->post('alamat'),
							'add_charge' => $latlong,
							'jumlah' => $this->input->post('jumlah'),
							'deskripsi' => $this->input->post('deskripsi'),
							'gambar' => 'default.jpg',
							'is_active' => 3,
							'added_by' => $this->session->userdata('id_wo'),
							'added_time' => date('Y-m-d H:i:s'),
					);
					$this->m_user->add_wo($data2);

					$this->session->set_flashdata('message', 'Akun berhasil dibuat! Silakan tunggu proses Verifikasi!');
					redirect('auth/login_user');
				}
			}
	}

	public function register_vendor()
	{
		$this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[tb_vendor.email]', array(
				'is_unique' => 'This email has already taken'
			));
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('alamat', 'alamat', 'required');
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('no_telp', 'nomor telepon', 'required');
			$this->form_validation->set_rules('no_rek', 'nomor rekening', 'required');
		    $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		     $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
				$data = array(
				'title' => 'Register Vendor' ,
				'kategori' => $this->m_kategori->get_all_data(),
				'provinsi' => $get_prov->result(),
				 );

            $hasil = json_decode(file_get_contents('assets/json/kota.json'), true);
            $cek_kota = array();
            foreach ($hasil as $kota) {
            	array_push($cek_kota, $kota['city']);
            }
		    if (!in_array($this->input->post('add_charge'), $cek_kota)) {
		    	$this->session->set_flashdata('kota', 'Silakan pilih kota dalam daftar!');
			$this->load->view('auth/v_register_vendor', $data, FALSE);
		    } else {
			if ($this->form_validation->run() == FALSE) {

			$this->load->view('auth/v_register_vendor', $data, FALSE);
			} else {

		            foreach ($hasil as $dapatkan) {
		            	if ($this->input->post('add_charge') == $dapatkan['city']) {
		            		$latlong = $dapatkan['lat'].'==='.$dapatkan['lng'];
		            	}
		            }
				$data2 = array(
					'nama_vendor' => $this->input->post('nama_vendor'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'level_user' => $this->input->post('level_user'),
					'prov' => $this->input->post('prov'),
					'kab' => $this->input->post('kab'),
					'alamat' => $this->input->post('alamat'),
					'add_charge' => $latlong,
					'jumlah' => $this->input->post('jumlah'),
					'id_kategori' => $this->input->post('id_kategori'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'),
					'is_active' => 3,
					'gambar' => 'default.jpg',
					'deskripsi' => $this->input->post('deskripsi'),
					'no_rek' => $this->input->post('no_rek'),
					'added_by' => $this->session->userdata('id_vendor'),
					'added_time' =>date('Y-m-d H:i:s'),
				);
				$this->m_user->add_vendor($data2);
				$this->session->set_flashdata('message', 'Akun berhasil dibuat! Silakan tunggu proses Verifikasi!');
				redirect('auth/login_user');
			}
		}
	}

}


?>