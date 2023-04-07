<?php if (empty($_GET['to'])) { ?>
  <div class="col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
      <div class="card-body">
         <?php 
        $id_wo = $this->session->userdata('id_wo');
        $jml = $this->db->query("SELECT * FROM `tb_pesan` WHERE id_penerima='$id_wo'")->num_rows();
         ?>
         <?php if ($jml == 0) {
           echo "Belum ada Pesan Masuk.";
         } ?>
        <ul class="contacts-list">
          <?php
            $id_wo = $this->session->userdata('id_wo');
            $sql_pelanggan = $this->db->query("SELECT * FROM `tb_pelanggan`");
            foreach ($sql_pelanggan->result_array() as $qp) {
              $jumpes = $this->db->query("SELECT * FROM `tb_pesan` WHERE id_pengirim='".$qp['id_pelanggan']."' AND id_penerima='$id_wo' AND pengirim='tb_pelanggan'")->num_rows();
          ?>
           <?php if ($jumpes > 0) { ?>
            <li>
              <a href="<?= base_url('am/chat_pelanggan?to=pelanggan&id='.$qp['id_pelanggan']); ?>">
                <img class="contacts-list-img" src="<?= base_url('assets/foto/'.$qp['foto']); ?>">
                <div class="contacts-list-info">
                  <span class="contacts-list-name text-primary mt-2"><?= $qp['nama_pelanggan']; ?><small class="contacts-list-date float-right badge badge-danger"><?= $jumpes; ?></small></span>
                </div>
              </a>
            </li>
            <?php } ?>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
  
<?php } else { ?>
  <?php
    $id_wo = $this->session->userdata('id_wo');
    $sql_pesan = $this->db->query("SELECT * FROM `tb_pesan` WHERE id_pengirim='$id_wo' OR id_penerima='$id_wo'");
    if (!empty($_GET['to']) AND 'pelanggan' !== $_GET['to']) {
      redirect();
    } else {
      $get = 'tb_pelanggan';
      $db_get = 'id_pelanggan';
      $nm_get = 'nama_pelanggan';
    }
    $id_get = $_GET['id'];
    $back = 'am/chat_pelanggan?to='.$_GET['to'].'&id='.$id_get;
    $enter = '
';
  ?>
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body p-0">
        <div class="direct-chat-messages" style="min-height: 350px;">
          <?php foreach ($sql_pesan->result_array() as $qp) { ?>
            <?php if ($get == $qp['pengirim'] OR $get == $qp['penerima']) { ?>
              <?php if ($id_get == $qp['id_pengirim'] OR $id_get == $qp['id_penerima']) { ?>
                <?php $satu = $this->db->query("SELECT * FROM `tb_wo` WHERE `id_wo`='$id_wo'")->row_array(); ?>
                <?php $dua = $this->db->query("SELECT * FROM `$get` WHERE `$db_get`='$id_get'")->row_array(); ?>
                <?php if ('tb_wo' == $qp['pengirim']) { ?>
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right"><?= $satu['nama_toko']; ?></span>
                      <span class="direct-chat-timestamp float-left"><?= date('Y-m-d H:i:s', $qp['waktu']); ?></span>
                    </div>
                    <img class="direct-chat-img" src="<?= base_url('assets/foto/'.$satu['gambar']); ?>" alt="message user image">
                    <div class="direct-chat-text"><?= str_replace($enter, '<br/>', $qp['pesan']); ?></div>
                  </div>
                <?php } else { ?>
                  <?php if ('tb_pelanggan' == $qp['pengirim'] AND 'tb_wo' == $qp['penerima']) { ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left"><?= $dua[$nm_get]; ?></span>
                        <span class="direct-chat-timestamp float-right"><?= date('Y-m-d H:i:s', $qp['waktu']); ?></span>
                      </div>
                      <img class="direct-chat-img" src="<?= base_url('assets/foto/'.$dua['foto']); ?>" alt="message user image">
                      <div class="direct-chat-text"><?= str_replace($enter, '<br/>', $qp['pesan']); ?></div>
                    </div>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
      <div class="card-footer">
        <form action="<?= base_url('am/kirim_pesan'); ?>" method="post">
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
  </div>
<?php } ?>

 