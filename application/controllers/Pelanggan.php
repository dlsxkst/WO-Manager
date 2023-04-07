<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pelanggan');
		$this->load->model('m_auth');
	}

	
	public function akun()
	{
		$this->pelanggan_login->proteksi_halaman();
		$data = array(
			'title' => 'Akun Saya' ,
			'pelanggan' => $this->m_pelanggan->akun(),
			'isi' => 'v_akun_saya' ,
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function edit()
	{
		if($this->input->post('submit', TRUE) == 'submit'){
		$this->form_validation->set_rules('nama_pelanggan', 'nama pelanggan', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');


		if($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/foto/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';


			$this->upload->initialize($config);
			$field_name = 'foto';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
				'title' => 'Edit Profile',
				'pelanggan' => $this->m_pelanggan->akun(),
				'error_upload' => $this->upload->display_errors(),
				'isi' => 'v_edit_profile',
				 );
			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
				} else {
					$pelanggan = $this->m_pelanggan->akun();
						if($pelanggan->foto != "" ){
							unlink('./assets/foto/'.$pelanggan->foto);
						}
					$upload_data = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/foto/'.$upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);
					$data = array(
						'id_pelanggan' => $this->input->post('id_pelanggan'),
						'nama_pelanggan' => $this->input->post('nama_pelanggan'),
						'email' => $this->input->post('email'),
						'foto' => $upload_data['uploads']['file_name'],
					);
					$this->m_pelanggan->edit($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('pelanggan/akun');
				}
				$data = array(
						'id_pelanggan' => $this->input->post('id_pelanggan'),
						'nama_pelanggan' => $this->input->post('nama_pelanggan'),
						'email' => $this->input->post('email'),
					);
					$this->m_pelanggan->edit($data);
					$this->session->set_flashdata('message', 'Data berhasil diubah!');
					redirect('pelanggan/akun');
		}	
	} elseif($this->input->post('changepass', TRUE) == 'changepass') {
			$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
            $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|matches[new_password1]');

        if($this->form_validation->run() == TRUE) {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if ($current_password == $this->session->userdata('password')) {
                $this->session->set_flashdata('error', 'Wrong current password!');
                redirect('pelanggan/edit');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'New password cannot be the same as current password!');
                    redirect('pelanggan/edit');
                } else {
                	$password = md5($new_password);    
                 $this->db->set('password', $password);
                    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
                    $this->db->update('tb_pelanggan');

                    $this->session->set_flashdata('message', 'Password changed!');
                    redirect('pelanggan/akun');
                }
            }
	   }
		}	
	$data = array(
				'title' => 'Edit Profile',
				'pelanggan' => $this->m_pelanggan->akun(),
				'isi' => 'v_edit_profile',
				 );
			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}



	public function changepass()
	{
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|matches[new_password1]');

        if($this->form_validation->run() == TRUE) {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if ($current_password == $this->session->userdata('password')) {
                $this->session->set_flashdata('error', 'Wrong current password!');
                redirect('pelanggan/changepass');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'New password cannot be the same as current password!');
                    redirect('pelanggan/changepass');
                } else {
                	$password = md5($new_password);    
                 $this->db->set('password', $password);
                    $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
                    $this->db->update('tb_pelanggan');

                    $this->session->set_flashdata('message', 'Password changed!');
                    redirect('pelanggan/changepass');
                }
            }
	   } else {
		$data = array(
				'title' => 'Ganti Password',
				'pelanggan' => $this->m_pelanggan->akun(),
				'isi' => 'v_edit_password',
				 );
			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

		
	}

}