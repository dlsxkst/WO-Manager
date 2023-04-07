<?php
  if ($this->session->userdata('id_pelanggan') < 1) {
    redirect();
  }
  $id_pelanggan = $this->session->userdata('id_pelanggan');
  $sql_pesan = $this->db->query("SELECT * FROM `tb_pesan` WHERE id_pengirim='$id_pelanggan' OR id_penerima='$id_pelanggan'");
  if ('wo' !== $_GET['to'] AND 'vendor' !== $_GET['to']) {
    redirect();
  }
  if ('wo' == $_GET['to']) {
    $get = 'tb_wo';
    $db_get = 'id_wo';
    $nm_get = 'nama_toko';
  } else {
    $get = 'tb_vendor';
    $db_get = 'id_vendor';
    $nm_get = 'nama_vendor';
  }
  $id_get = $_GET['id'];
  $back = 'chat?to='.$_GET['to'].'&id='.$id_get;
  $enter = '
';
?>
<div class="card mb-4">
  <div class="card-body p-0">
    <div class="direct-chat-messages" style="min-height: 350px;">
      <?php foreach ($sql_pesan->result_array() as $qp) { ?>
        <?php if ($get == $qp['pengirim'] OR $get == $qp['penerima']) { ?>
          <?php if ($id_get == $qp['id_pengirim'] OR $id_get == $qp['id_penerima']) { ?>
            <?php $satu = $this->db->query("SELECT * FROM `tb_pelanggan` WHERE `id_pelanggan`='$id_pelanggan'")->row_array(); ?>
            <?php $dua = $this->db->query("SELECT * FROM `$get` WHERE `$db_get`='$id_get'")->row_array(); ?>
            <?php if ('tb_pelanggan' == $qp['pengirim']) { ?>
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right"><?= $satu['nama_pelanggan']; ?></span>
                  <span class="direct-chat-timestamp float-left"><?= date('Y-m-d H:i:s', $qp['waktu']); ?></span>
                </div>
                <img class="direct-chat-img" src="<?= base_url('assets/foto/'.$satu['foto']); ?>" alt="message user image">
                <div class="direct-chat-text"><?= str_replace($enter, '<br/>', $qp['pesan']); ?></div>
              </div>
            <?php } else { ?>
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left"><?= $dua[$nm_get]; ?></span>
                  <span class="direct-chat-timestamp float-right"><?= date('Y-m-d H:i:s', $qp['waktu']); ?></span>
                </div>
                <img class="direct-chat-img" src="<?= base_url('assets/foto/'.$dua['gambar']); ?>" alt="message user image">
                <div class="direct-chat-text"><?= str_replace($enter, '<br/>', $qp['pesan']); ?></div>
              </div>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
  <div class="card-footer">
    <form action="<?= base_url('chat/kirim'); ?>" method="post">
      <input type="hidden" name="back" value="<?= $back; ?>">
      <input type="hidden" name="id_penerima" value="<?= $id_get; ?>">
      <input type="hidden" name="penerima" value="<?= $get; ?>">
      <div class="input-group">
        <textarea type="text" name="pesan" placeholder="Ketik Pesan ..." class="form-control" style="height: 50px !important; min-height: 50px !important; max-height: 150px !important;"></textarea>
        <span class="input-group-append">
          <input type="submit" class="btn btn-primary" value="Kirim">
        </span>
      </div>
    </form>
  </div>
</div>