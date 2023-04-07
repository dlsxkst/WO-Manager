<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Package extends CI_Controller{
     
    function __construct(){
        parent::__construct();
        $this->load->model('Package_model','package_model');
        $this->load->model('M_kategori','m_kategori');
    }
 
    // READ
    function index(){
        $data['title'] = 'Paket Pernikahan';
        $data['kategori'] = $this->m_kategori->get_all_data();
        $data['product'] = $this->package_model->get_products();
        $data['package'] = $this->package_model->get_packages();
        $data['isi'] = 'package_view';
       $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
 
    //CREATE
    function create(){
        $package = $this->input->post('nama_paket',TRUE);
        $harga = $this->input->post('harga_paket',TRUE);
        $id_barang = $this->input->post('id_barang',TRUE);
        $id_wo = $this->input->post('id_wo',TRUE);
        $id_kategori = $this->input->post('id_kategori',TRUE);
        $deskripsi = $this->input->post('deskripsi',TRUE);
        $id_vendor = $this->input->post('id_vendor',TRUE);
        $this->package_model->create_package($package,$harga,$id_barang,$id_wo,$id_kategori,$deskripsi,$id_vendor);
        redirect('package');
    }
 
    // GET DATA PRODUCT BERDASARKAN PACKAGE ID
    function get_product_by_package(){
        $id_paket=$this->input->post('id_paket');
        $data=$this->package_model->get_product_by_package($id_paket)->result();
        foreach ($data as $result) {
            $value[] = (float) $result->id_barang;
        }
        echo json_encode($value);
    }
 
    //UPDATE
    function update(){
        $id = $this->input->post('edit_id',TRUE);
        $package = $this->input->post('nama_paket',TRUE);
        $product = $this->input->post('id_barang',TRUE);
        $this->package_model->update_package($id,$package,$product);
        redirect('package');
    }
 
    // DELETE
    function delete(){
        $id = $this->input->post('delete_id',TRUE);
        $this->package_model->delete_package($id);
        redirect('package');
    }
}