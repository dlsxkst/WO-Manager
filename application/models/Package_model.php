<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Package_model extends CI_Model{
     
    // GET ALL PRODUCT
    function get_products(){
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_vendor', 'tb_vendor.id_vendor=tb_barang.id_vendor');
        $this->db->join('tb_kerjasama', 'tb_kerjasama.id_vendor=tb_barang.id_vendor');
        $this->db->where('id_wo', $this->session->userdata('id_wo'));
        $query = $this->db->get();
        return $query;
    }
 
    //GET PRODUCT BY PACKAGE ID
    function get_product_by_package($id_paket){
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_detail_paket', 'detail_product_id=id_barang');
        $this->db->join('tb_paket', 'id_paket=detail_package_id');
        $this->db->join('tb_vendor', 'tb_vendor.id_vendor=tb_barang.id_vendor', 'left');
        $this->db->where('id_paket',$id_paket);
        $query = $this->db->get()->result();
        return $query;
    }
 
    //READ
    function get_packages(){
        $this->db->select('tb_paket.*,COUNT(id_barang) AS item_product');
        $this->db->from('tb_paket');
        $this->db->join('tb_detail_paket', 'id_paket=detail_package_id');
        $this->db->join('tb_barang', 'detail_product_id=id_barang');
        $this->db->where('tb_paket.is_active = 1');
        $this->db->where('id_wo', $this->session->userdata('id_wo'));
        $this->db->group_by('tb_paket.id_paket');
        $query = $this->db->get();
        return $query;
    }

     function get_paket(){
        $this->db->select('tb_paket.*');
        $this->db->from('tb_paket');
        $this->db->join('tb_detail_paket', 'id_paket=detail_package_id');
        $this->db->where('tb_paket.is_active = 1');
        $this->db->where('tb_detail_paket.detail_product_id', null);
        $this->db->where('id_wo', $this->session->userdata('id_wo'));
        $this->db->group_by('tb_paket.id_paket');
        $query = $this->db->get();
        return $query;
    }
 
    // CREATE
    function create_package($package,$harga,$id_barang,$id_wo,$id_kategori,$deskripsi,$id_vendor){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            date_default_timezone_set("Asia/Bangkok");
            $data  = array(
                'nama_paket' => $package,
                'harga_paket' => $harga,
                'id_wo' => $id_wo,
                'id_kategori' => $id_kategori,
                'is_active' => 1,
                'deskripsi' => $deskripsi,
               
            );
            $this->db->insert('tb_paket', $data);
            //GET ID PACKAGE
            $package_id = $this->db->insert_id();
            $result = array();
                foreach($id_barang AS $key => $val){
                     $result[] = array(
                      'detail_package_id'   => $package_id,
                      'detail_product_id'   => $_POST['id_barang'][$key],
                      'id_vendor'           => $_POST['id_vendor'][$key],
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('tb_detail_paket', $result);
        $this->db->trans_complete();
    }
 
     
    // UPDATE
    function update_package($id,$package,$product){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
            $data  = array(
                'nama_paket' => $package
            );
            $this->db->where('id_paket',$id);
            $this->db->update('tb_paket', $data);
             
            //DELETE DETAIL PACKAGE
            $this->db->delete('tb_detail_paket', array('detail_package_id' => $id));
 
            $result = array();
                foreach($id_barang AS $key => $val){
                     $result[] = array(
                      'detail_package_id'   => $id,
                      'detail_product_id'   => $_POST['id_barang'][$key],
                      'id_vendor'           => $_POST['id_vendor'][$key],
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('tb_detail_paket', $result);
        $this->db->trans_complete();
    }
 
    // DELETE
    function delete_package($id){
        $this->db->trans_start();
            $this->db->delete('detail', array('detail_package_id' => $id));
            $this->db->delete('package', array('package_id' => $id));
        $this->db->trans_complete();
    }
     
}