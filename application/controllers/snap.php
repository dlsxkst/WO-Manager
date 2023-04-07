<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-GTJfY_JXAENAQBRGNtH00B73', 'production' => false);
		$this->load->library('midtrans/midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
	}

	public function index()
	{
		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
		// $this->pelanggan_login->proteksi_halaman();
		$data = array(
			'title'		   => 'Checkout' ,
			'id'			  => $this->m_transaksi->get_id(),
			'provinsi' => $get_prov->result(),
			'isi'			 => 'midtrans/checkout_snap',
			 );
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function cek_ziyadah() {
		$hasil = json_decode(file_get_contents('assets/json/kota.json'), true);
        $cek_kota = array();
        foreach ($hasil as $kota) {
        	array_push($cek_kota, $kota['city']);
        }
        $dp = $this->input->post('dp');
        $total = $this->input->post('total');
        $sisa = $this->input->post('sisa');
	    if (in_array($this->input->post('add_charge'), $cek_kota)) {
	    	foreach ($hasil as $dapatkan) {
            	if ($this->input->post('add_charge') == $dapatkan['city']) {
            		$latlong = $dapatkan['lat'].'==='.$dapatkan['lng'];
            	}
            }
            $tb = $this->input->post('tb');
            $to = $this->input->post('to');
            $get2 = $this->db->get_where($this->input->post('tb'), [$this->input->post('to') => $this->input->post($this->input->post('to'))])->row_array();
            $hmm1 = explode('===', $latlong);
            $latitude1 = $hmm1[0];
            $longitude1 = $hmm1[1];
            $hmm2 = explode('===', $get2['add_charge']);
            $latitude2 = $hmm2[0];
            $longitude2 = $hmm2[1];
            function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
			    $theta = $longitude1 - $longitude2; 
			    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
			    $distance = acos($distance); 
			    $distance = rad2deg($distance); 
			    $distance = $distance * 60 * 1.1515; 
			    switch($unit) { 
			      case 'miles': 
			        break; 
			      case 'kilometers' : 
			        $distance = $distance * 1.609344; 
			    } 
			    return (round($distance,2)); 
			  }
			$jarak = ceil(getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, 'kilometers'));
			$jumlah_tambahan = $get2['jumlah'];
			$tambahan = $jumlah_tambahan*$jarak;
			echo '<tr><th style="width: 50%;">Down Payment (DP):</th><th class="text-right">Rp. '.number_format($dp).'</th><tr/><tr><th style="width: 50%;">Additional Charge:</th><th class="text-right">Rp. '.number_format($tambahan).'</th></tr><tr><th style="width: 50%;">Total:</th><th class="text-right">Rp. '.number_format($total+$tambahan).'</th><tr/><tr><th style="width: 50%;">Sisa:</th><th class="text-right">Rp. '.number_format($sisa+$tambahan).'</th></tr>';
		} else {
			echo '<tr><th style="width: 50%;">Down Payment (DP):</th><th class="text-right">Rp. '.number_format($dp).'</th><tr/><tr><th style="width: 50%;">Total:</th><th class="text-right">Rp. '.number_format($total).'</th><tr/><tr><th style="width: 50%;">Sisa:</th><th class="text-right">Rp. '.number_format($sisa).'</th><tr/>';
		}
	}

	public function token()
	{
		$this->form_validation->set_rules('nama_pelanggan', 'full name', 'required');
		$this->form_validation->set_rules('tgl_acara', 'tanggal acara', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');

		$hasil = json_decode(file_get_contents('assets/json/kota.json'), true);
        $cek_kota = array();
        foreach ($hasil as $kota) {
        	array_push($cek_kota, $kota['city']);
        }
	    if (in_array($this->input->post('add_charge'), $cek_kota)) {
			if($this->form_validation->run() == true) {
			$nama_pelanggan = $this->input->post('nama_pelanggan');
			$tgl_acara = $this->input->post('tgl_acara');
			$no_telp = $this->input->post('no_telp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$total = $this->input->post('total');
			$jml_bayar = $this->input->post('jml_bayar');
			$qty = $this->input->post('qty');
			
			$transaction_details = array(
			  'order_id' => rand(),
			  'gross_amount' =>$jml_bayar, // no decimal allowed for creditcard
			);

			// Optional
			$item1_details = array(
			  'id' => 'a1',
			  'price' => $jml_bayar,
			  'quantity' => $qty,
			  'name' => 'Pembayaran WOManager '. $nama_pelanggan 
			);

			// Optional
			// $item2_details = array(
			//   'id' => 'a2',
			//   'price' => 20000,
			//   'quantity' => 2,
			//   'name' => "Orange"
			// );

			// Optional
			$item_details = array ($item1_details);

			// Optional
			// $billing_address = array(
			//   'first_name'	=> $nama_pelanggan,
			//   'last_name'	 => "Litani",
			//   'address'	   => "Mangga 20",
			//   'city'		  => "Jakarta",
			//   'postal_code'   => "16602",
			//   'phone'		 => "081122334455",
			//   'country_code'  => 'IDN'
			// );

			// Optional
			// $shipping_address = array(
			//   'first_name'	=> "Obet",
			//   'last_name'	 => "Supriadi",
			//   'address'	   => "Manggis 90",
			//   'city'		  => "Jakarta",
			//   'postal_code'   => "16601",
			//   'phone'		 => "08113366345",
			//   'country_code'  => 'IDN'
			// );

			// Optional
			$customer_details = array(
			  'first_name'	=>$nama_pelanggan,
			  // 'last_name'	 => "Litani",
			  'email'		 => $email,
			  'phone'		 => $no_telp,
			  'address'  => $alamat,
			  // 'shipping_address' => $shipping_address
			);

			// Data yang akan dikirim untuk request redirect_url.
			$credit_card['secure'] = true;
			//ser save_card true to enable oneclick or 2click
			//$credit_card['save_card'] = true;

			$time = time();
			$custom_expiry = array(
				'start_time' => date("Y-m-d H:i:s O",$time),
				'unit' => 'day', 
				'duration'  => 7
			);
			
			$transaction_data = array(
				'transaction_details'=> $transaction_details,
				'item_details'	   => $item_details,
				'customer_details'   => $customer_details,
				'credit_card'		=> $credit_card,
				'expiry'			 => $custom_expiry
			);

			error_log(json_encode($transaction_data));
			$snapToken = $this->midtrans->getSnapToken($transaction_data);
			error_log($snapToken);
			echo $snapToken;
		}
		}
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);
		// echo 'RESULT <br><pre>';
		// var_dump($result);
		// echo '</pre>' ;
		$hasil = json_decode(file_get_contents('assets/json/kota.json'), true);
        $cek_kota = array();
        foreach ($hasil as $kota) {
        	array_push($cek_kota, $kota['city']);
        }
	    // if (!in_array($this->input->post('add_charge'), $cek_kota)) {
	    	// redirect
	    // }
	    	foreach ($hasil as $dapatkan) {
            	if ($this->input->post('add_charge') == $dapatkan['city']) {
            		$latlong = $dapatkan['lat'].'==='.$dapatkan['lng'];
            	}
            }
            $tb = $this->input->post('tb');
            $to = $this->input->post('to');
            $get2 = $this->db->get_where($this->input->post('tb'), [$this->input->post('to') => $this->input->post($this->input->post('to'))])->row_array();
            $hmm1 = explode('===', $latlong);
            $latitude1 = $hmm1[0];
            $longitude1 = $hmm1[1];
            $hmm2 = explode('===', $get2['add_charge']);
            $latitude2 = $hmm2[0];
            $longitude2 = $hmm2[1];
            function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
			    $theta = $longitude1 - $longitude2; 
			    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
			    $distance = acos($distance); 
			    $distance = rad2deg($distance); 
			    $distance = $distance * 60 * 1.1515; 
			    switch($unit) { 
			      case 'miles': 
			        break; 
			      case 'kilometers' : 
			        $distance = $distance * 1.609344; 
			    } 
			    return (round($distance,2)); 
			  }
			$jarak = ceil(getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, 'kilometers'));
			$jumlah_tambahan = $get2['jumlah'];
			$tambahan = $jumlah_tambahan*$jarak;
		$keranjang = $this->m_transaksi->keranjang();
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$tgl_acara = $this->input->post('tgl_acara');
		$no_telp = $this->input->post('no_telp');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$total = $this->input->post('total')+$tambahan;
		$jml_bayar = $this->input->post('jml_bayar');
		$id_pelanggan = $this->input->post('id_pelanggan');
		$id_vendor = $this->input->post('id_vendor');
		$id_wo = $this->input->post('id_wo');
		$data = [
			'order_id' => $result['order_id'],
			'id_pelanggan' => $id_pelanggan,
			'id_vendor' => $id_vendor,
			'id_wo' => $id_wo,
			'nama_pelanggan' => $nama_pelanggan,
			'tgl_acara' => $tgl_acara,
			'no_telp' => $no_telp,
			'email' => $email,
			'alamat' => $alamat,
			'jml_bayar' => $jml_bayar,
			'gross_amount' => $total,
			'payment_type' => $result['payment_type'],
			'bank' => $result['va_numbers'][0]['bank'],
			'va_number' => $result['va_numbers'][0]['va_number'],
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code'],
			'transaction_time' => $result['transaction_time'],
			'transaction_id' => $result['transaction_id'],
			'transaction_status' => $result['transaction_status'],
		];

		$simpan = $this->db->insert('tb_transaksi', $data);
		$data2 = [
			'order_id' => $result['order_id'],
			'id_pelanggan' => $id_pelanggan,
			'progress' => 0
		];
		$this->db->insert('tb_progress', $data2);
		$i = 1;
			foreach ($keranjang as $items) {
				if ($items->id_barang != '') {
					$data_rinci = array(
					'order_id' =>  $result['order_id'],
					'id_barang' => $items->id_barang,
					'qty' => $this->input->post('qty'.$i++),
				);
				
				}else{
					$data_rinci = array(
					'order_id' =>  $result['order_id'],
					'id_barang' => $items->id_paket,
					'qty' => $this->input->post('qty'.$i++),
				);
				}
				$this->db->insert('tb_rincian_transaksi', $data_rinci);
			}


			$this->session->set_flashdata('pesan', 'Pesanan Berhasil Diproses!!');
			$this->m_transaksi->delete_cart($data_rinci);
			redirect('pesanan_saya');


	}
	public function token2()
	{
		$this->form_validation->set_rules('nama_pelanggan', 'full name', 'required');
		$this->form_validation->set_rules('tgl_acara', 'tanggal acara', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');

			if($this->form_validation->run() == true) {
			$nama_pelanggan = $this->input->post('nama_pelanggan');
			$tgl_acara = $this->input->post('tgl_acara');
			$no_telp = $this->input->post('no_telp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$total = $this->input->post('total');
			$jml_bayar = $this->input->post('jml_bayar');
			$qty = $this->input->post('qty');
			
			$transaction_details = array(
			  'order_id' => rand(),
			  'gross_amount' =>$jml_bayar, // no decimal allowed for creditcard
			);

			// Optional
			$item1_details = array(
			  'id' => 'a1',
			  'price' => $jml_bayar,
			  'quantity' => $qty,
			  'name' => 'Pembayaran WOManager '. $nama_pelanggan 
			);

			// Optional
			// $item2_details = array(
			//   'id' => 'a2',
			//   'price' => 20000,
			//   'quantity' => 2,
			//   'name' => "Orange"
			// );

			// Optional
			$item_details = array ($item1_details);

			// Optional
			// $billing_address = array(
			//   'first_name'	=> $nama_pelanggan,
			//   'last_name'	 => "Litani",
			//   'address'	   => "Mangga 20",
			//   'city'		  => "Jakarta",
			//   'postal_code'   => "16602",
			//   'phone'		 => "081122334455",
			//   'country_code'  => 'IDN'
			// );

			// Optional
			// $shipping_address = array(
			//   'first_name'	=> "Obet",
			//   'last_name'	 => "Supriadi",
			//   'address'	   => "Manggis 90",
			//   'city'		  => "Jakarta",
			//   'postal_code'   => "16601",
			//   'phone'		 => "08113366345",
			//   'country_code'  => 'IDN'
			// );

			// Optional
			$customer_details = array(
			  'first_name'	=>$nama_pelanggan,
			  // 'last_name'	 => "Litani",
			  'email'		 => $email,
			  'phone'		 => $no_telp,
			  'address'  => $alamat,
			  // 'shipping_address' => $shipping_address
			);

			// Data yang akan dikirim untuk request redirect_url.
			$credit_card['secure'] = true;
			//ser save_card true to enable oneclick or 2click
			//$credit_card['save_card'] = true;

			$time = time();
			$custom_expiry = array(
				'start_time' => date("Y-m-d H:i:s O",$time),
				'unit' => 'day', 
				'duration'  => 7
			);
			
			$transaction_data = array(
				'transaction_details'=> $transaction_details,
				'item_details'	   => $item_details,
				'customer_details'   => $customer_details,
				'credit_card'		=> $credit_card,
				'expiry'			 => $custom_expiry
			);

			error_log(json_encode($transaction_data));
			$snapToken = $this->midtrans->getSnapToken($transaction_data);
			error_log($snapToken);
			echo $snapToken;
		}
	}

	public function finish2() {
		$result = json_decode($this->input->post('result_data'), true);
		$keranjang = $this->m_transaksi->keranjang();
		$id_transaksi1 = $this->input->post('id_transaksi1');
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$tgl_acara = $this->input->post('tgl_acara');
		$no_telp = $this->input->post('no_telp');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$total = $this->input->post('total');
		$jml_bayar = $this->input->post('jml_bayar');
		$id_pelanggan = $this->input->post('id_pelanggan');
		$id_vendor = $this->input->post('id_vendor');
		$id_wo = $this->input->post('id_wo');
		$data = [
			'order_id' => $result['order_id'],
			'id_transaksi1' => $id_transaksi1,
			'id_pelanggan' => $id_pelanggan,
			'id_vendor' => $id_vendor,
			'id_wo' => $id_wo,
			'nama_pelanggan' => $nama_pelanggan,
			'tgl_acara' => $tgl_acara,
			'no_telp' => $no_telp,
			'email' => $email,
			'alamat' => $alamat,
			'jml_bayar' => $jml_bayar,
			'gross_amount' => $total,
			'payment_type' => $result['payment_type'],
			'bank' => $result['va_numbers'][0]['bank'],
			'va_number' => $result['va_numbers'][0]['va_number'],
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code'],
			'transaction_time' => $result['transaction_time'],
			'transaction_id' => $result['transaction_id'],
			'transaction_status' => $result['transaction_status'],
			
		];

		$simpan = $this->db->insert('tb_transaksi2', $data);
		$i = 1;
		foreach ($keranjang as $items) {
			if ($items->id_barang != '') {
				$data_rinci = array(
				'order_id' =>  $result['order_id'],
				'id_barang' => $items->id_barang,
				'qty' => $this->input->post('qty'.$i++),
			);
			
			}else{
				$data_rinci = array(
				'order_id' =>  $result['order_id'],
				'id_barang' => $items->id_paket,
				'qty' => $this->input->post('qty'.$i++),
			);
			}
			$this->db->insert('tb_rincian_transaksi2', $data_rinci);
		}
		$this->session->set_flashdata('pesan', 'Pembayaran Berhasil Diproses!!');
		redirect('pesanan_saya');
	}

}