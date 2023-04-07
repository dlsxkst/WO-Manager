<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restore_model extends CI_Model {

	public function droptabel()
	{
		$cek = $this->db->query('SHOW TABLES');

		if ($cek->num_rows() > 0) {
			$query = $this->db->query('DROP TABLE tb_admin, tb_barang, tb_chat, tb_detail_paket, tb_gambar, tb_gambarpaket, tb_kategori, tb_keranjang, tb_kerjasama, tb_paket, tb_pelanggan, tb_progress, tb_rincian_transaksi, tb_transaksi, tb_vendor, tb_wo');

			return $query;
		}else{
			return true;
		}
	}


}

?>