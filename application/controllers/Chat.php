<?php

  class Chat extends CI_Controller {

    // public function __construct() {
    //   parent::__construct();
    //   $this->load->model('cart_model');
    // }

    public function index() {
      $data = array(
        'title' => 'Chat',
        'isi' => 'v_chat'
      );
      $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function kirim() {
      if (!isset($_POST['back']) OR !isset($_POST['id_penerima']) OR !isset($_POST['penerima']) OR !isset($_POST['pesan'])) {
        redirect();
      }
      $back = $_POST['back'];
      $id_pengirim = $this->session->userdata('id_pelanggan');
      $id_penerima = $_POST['id_penerima'];
      $pengirim = 'tb_pelanggan';
      $penerima = $_POST['penerima'];
      $pesan = $_POST['pesan'];
      $waktu = strtotime('now');
      $this->db->query("INSERT INTO `tb_pesan` SET id_pengirim='$id_pengirim', id_penerima='$id_penerima', pengirim='$pengirim', penerima='$penerima', pesan='$pesan', waktu='$waktu'");
      redirect($back);
    }

    public function chatting() {
      $data = array(
        'sender' => $this->input->post('sender'),
        'receiver' => $this->input->post('receiver'),
        'message' => $this->input->post('message'),
        'time' => date('Y-m-d H:i:s')
      );
      $this->db->insert('tb_chat', $data);
      redirect('home');
    }

  }

?>