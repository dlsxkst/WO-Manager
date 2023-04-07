

<div class="col-sm-12">
  <?php 
    if ($this->session->flashdata('pesan')){
       echo '<div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h5><i class="icon fas fa-check"></i>';
        echo $this->session->flashdata('pesan'); 
        echo '</h5></div>';
    }
    ?>
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#belum_bayar" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Masuk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#diproses" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Diproses</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#selesai" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                 <?php 
                  $id_wo = $this->session->userdata('id_wo');
                  $jml = $this->db->query("SELECT * FROM `tb_transaksi` WHERE id_wo='$id_wo'")->num_rows();
                   ?>
                   
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="belum_bayar" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                     <table class="table table-stripped">
                      <tr>
                        <th>Nomor Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Order</th>
                        <th>Tanggal Acara</th>
                        <th>Payment Type</th>
                        <th>Bank</th>
                        <th>VA Number</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                      </tr>
                      <?php foreach ($pesanan as $key => $value) { ?>
                        <tr>
                        <td><?= $value->order_id; ?></td>
                        <td><?= $value->nama_pelanggan;  ?></td>
                        <td><?= $value->transaction_time; ?></td>
                        <td><?= $value->tgl_acara;  ?></td>
                        <td><?= $value->payment_type;  ?></td>
                        <td><?= $value->bank;  ?></td>
                        <td><?= $value->va_number;  ?></td>
                        <td><b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b></td>
                        <td><?php if ($value->status_code == 201) { ?>
                            <span class="badge badge-warning">Belum Bayar</span>
                          <?php } else { ?>
                            <span class="badge badge-success">Sudah Bayar</span><br>
                            <span class="badge badge-primary">Menunggu Verifikasi</span>
                          <?php } ?></td>
                      </tr>
                       <?php } ?>
                     </table>
                  </div>
                  <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table table-stripped">
                      <tr>
                        <th>Nomor Order</th>
                        <th>Tanggal Order</th>
                        <th>Tanggal Acara</th>
                        <th>DP</th>
                        <th>Sisa</th>
                        <th>Progress</th>
                        <th width="15%" colspan="2">Edit Progress</th>
                      </tr>
                      <?php foreach ($pesanan_diproses as $key => $value) { ?>
                        <?php $cek = $this->db->query("SELECT * FROM `tb_transaksi2` WHERE id_transaksi1='$value->id'"); $get = $cek->row_array(); ?>
                        <?= form_open('am/progress');  ?>
                          <tr>
                            <input type="hidden" name="id" value="<?= $value->id; ?>">
                            <input type="hidden" name="order_id" value="<?= $value->order_id;  ?>" >
                            <input type="hidden" name="id_pelanggan" value="<?= $value->id_pelanggan;  ?>">
                            <td><?= $value->order_id; ?></td>
                            <td><?= $value->transaction_time; ?></td>
                            <td><?= $value->tgl_acara;  ?></td>
                            <td>
                              <b>Rp. <?= number_format($value->jml_bayar,0, ',','.'); ?></b>
                              <br/>
                              <?php if ($value->status_code == 200) { ?>
                                <span class="badge bg-success">Success</span>
                              <?php } else { ?>
                                <span class="badge bg-warning">Pending</span>
                              <?php } ?>
                            </td>
                            <td>
                              <b>Rp. <?= number_format($value->gross_amount-$value->jml_bayar,0, ',','.'); ?></b>
                              <br/>
                              <?php if ($cek->num_rows() > 0) { ?>
                                <?php if ($get['status_code'] == 200) { ?>
                                  <span class="badge bg-success">Success</span>
                                <?php } else { ?>
                                  <span class="badge bg-warning">Pending</span>
                                <?php } ?>
                              <?php } else { ?>
                                <span class="badge bg-danger">Unpaid</span>
                              <?php } ?>
                            </td>
                            <td class="project_progress">
                              <div class="progress progress-sm"><div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress; ?>%"></div></div>
                              <small><?= $value->progress; ?>% Complete</small>
                            </td>
                            <td><input type="number" name="progress" class="form-control" value="<?= $value->progress; ?>"></td>
                            <td><button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button></td>
                          </tr>
                        <?= form_close();  ?>
                      <?php } ?>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                     <table class="table table-stripped">
                      <tr>
                        <th>Nomor Order</th>
                        <th>Tanggal Order</th>
                        <th>Tanggal Acara</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                      </tr>
                      <?php foreach ($pesanan_selesai as $key => $value) { ?>
                        <tr>
                        <td><?= $value->order_id; ?></td>
                        <td><?= $value->transaction_time; ?></td>
                        <td><?= $value->tgl_acara;  ?></td>
                        <td><b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b></td>
                         <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%">
                              </div>
                          </div>
                          <small>
                              <?= $value->progress;  ?>% Complete
                          </small>
                      </td>
                      </tr>
                       <?php } ?>
                     </table>
                  </div> 
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>

<!-- <?php foreach ($pesanan as $key => $value) {  ?>

<div class="modal fade" id="modal-default<?= $value->id_transaksi; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><?= $value->no_order; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <table class="table">
               <tr>
                 <th>Nama Bank</th>
                 <th>:</th>
                 <td><?= $value->nama_bank; ?></td>
               </tr>
               <tr>
                 <th>Nomor Rekening</th>
                 <th>:</th>
                 <td><?= $value->no_rek; ?></td>
               </tr>
               <tr>
                 <th>Atas Nama</th>
                 <th>:</th>
                 <td><?= $value->atas_nama; ?></td>
               </tr>
               <tr>
                 <th>Total Bayar</th>
                 <th>:</th>
                 <td>Rp. <?= number_format($value->total_bayar, 0); ?></td>
               </tr>
             </table>
             <img src="<?= base_url('assets/bukti_bayar/'.$value->bukti_bayar); ?>" class="img-fluid pad" alt="">
            </div>
            <div class="modal-footer right-content">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
         
        </div>
        
      </div>
    
<?php } ?> -->

<!-- <?php foreach ($pesanan_diproses as $key => $value) {  ?>

<div class="modal fade" id="kirim<?= $value->id_transaksi; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><?= $value->no_order; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <?php echo form_open('admin/kirim/'.$value->id_transaksi); ?>
             <table class="table">
               <tr>
                 <th>Ekspedisi</th>
                 <th>:</th>
                 <th><?= $value->ekspedisi; ?></th>
               </tr>
               <tr>
                 <th>Paket</th>
                 <th>:</th>
                 <th><?= $value->paket; ?></th>
               </tr>
               <tr>
                 <th>Ongkir</th>
                 <th>:</th>
                 <th>Rp. <?= number_format($value->ongkir, 0); ?></th>
               </tr>
               <tr>
                 <th>Nomor Resi</th>
                 <th>:</th>
                 <td><input type="text" class="form-control" required="" name="no_resi" placeholder="Masukkan Nomor Resi"></td>
               </tr>
             </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            <?php echo form_close(); ?>
          </div>
        
        </div>
      
      </div>
   
<?php } ?> -->

