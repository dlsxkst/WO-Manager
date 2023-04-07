

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
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#dikirim" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dibayar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#selesai" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
                  </li>
                </ul>
              </div>
               
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="belum_bayar" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <table class="table table-stripped">
                      <tr>
                        <th>Nomor Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Mitra</th>
                        <!-- <th>Nama Barang</th> -->
                        <th>Tanggal Order</th>
                        <th>Tanggal Acara</th>
                        <th>Payment Type</th>
                        <th>Bank</th>
                        <th>VA Number</th>
                        <th>DP</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                      </tr>
                      <?php foreach ($pesanan as $key => $value) { ?>
                        <tr>
                        <td><?= $value->order_id; ?></td>
                        <td><?= $value->nama_pelanggan;  ?></td>
                        <td><?= $value->nama_toko;  ?></td>
                        <!-- <th><?= $value->nama_vendor;  ?></th> -->
                        <td><?= $value->transaction_time; ?></td>
                        <td><?= $value->tgl_acara;  ?></td>
                        <td><?= $value->payment_type;  ?></td>
                        <td><?= $value->bank;  ?></td>
                        <td><?= $value->va_number;  ?></td>
                         <td><b>Rp. <?= number_format($value->jml_bayar,0, ',','.'); ?></b><br>
                        <?php if ($value->status_code == 200) { ?>
                          <span class="badge bg-success">Success</span>
                        <?php } elseif ($value->status_code == 201) { ?>
                          <span class="badge bg-warning">Pending</span>
                        <?php } ?>
                        <td><b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b></td>
                        <td><?php if ($value->status_code == 201) { ?>
                            <span class="badge badge-warning">Belum Bayar</span>
                          <?php } else { ?>
                            <span class="badge badge-success">Sudah Bayar</span><br>
                            <span class="badge badge-primary">Menunggu Verifikasi</span>
                          <?php } ?></td>
                      </tr>
                       <?php } ?>
                       <?php foreach ($pesanan2 as $key => $value) { ?>
                        <tr>
                        <td><?= $value->order_id; ?></td>
                        <td><?= $value->nama_pelanggan;  ?></td>
                        <td><?= $value->nama_vendor;  ?></td>
                        <!-- <th><?= $value->nama_vendor;  ?></th> -->
                        <td><?= $value->transaction_time; ?></td>
                        <td><?= $value->tgl_acara;  ?></td>
                        <td><?= $value->payment_type;  ?></td>
                        <td><?= $value->bank;  ?></td>
                        <td><?= $value->va_number;  ?></td>
                         <td><b>Rp. <?= number_format($value->jml_bayar,0, ',','.'); ?></b><br>
                        <?php if ($value->status_code == 200) { ?>
                          <span class="badge bg-success">Success</span>
                        <?php } elseif ($value->status_code == 201) { ?>
                          <span class="badge bg-warning">Pending</span>
                        <?php } ?>
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
                        <th>Nama Pelanggan</th>
                        <th>Nama Mitra</th>
                        <th>Tanggal Acara</th>
                        <th>DP</th>
                        <th>Sisa Bayar</th>
                        <th>Progress</th>
                       
                      </tr>
                      <?php foreach ($diproses as $key => $value) { ?>
                         <?php $cek = $this->db->query("SELECT * FROM `tb_transaksi2` WHERE id_transaksi1='$value->id'"); $get = $cek->row_array(); ?>
                          <tr>
                          <td><?= $value->order_id; ?></td>
                          <td><?= $value->nama_pelanggan;  ?></td>
                          <td><?= $value->nama_toko;  ?></td>
                          <td><?= $value->tgl_acara; ?></td>
                          <td><b>Rp. <?= number_format($value->jml_bayar,0, ',','.'); ?></b></td>
                          <td>
                            <b>Rp. <?= number_format($value->gross_amount-$value->jml_bayar,0, ',','.'); ?></b>
                            <br/>
                            <?php if ($cek->num_rows() > 0) { ?>
                              <?php if ($get['status_code'] == 200) { ?>
                                <span class="badge bg-success">Paid</span>
                              <?php } else { ?>
                                <span class="badge bg-warning">Pending</span>
                              <?php } ?>
                            <?php } else { ?>
                              <span class="badge bg-danger">Unpaid</span>
                            <?php } ?>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress-sm"><div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%"></div></div>
                            <small><?= $value->progress; ?>% Complete</small>
                          </td>
                          </tr>
                      <?php } ?>
                      <?php foreach ($diproses2 as $key => $value) { ?>
                         <?php $cek = $this->db->query("SELECT * FROM `tb_transaksi2` WHERE id_transaksi1='$value->id'"); $get = $cek->row_array(); ?>
                          <tr>
                          <td><?= $value->order_id; ?></td>
                          <td><?= $value->nama_pelanggan;  ?></td>
                          <td><?= $value->nama_vendor;  ?></td>
                          <td><?= $value->tgl_acara; ?></td>
                          <td><b>Rp. <?= number_format($value->jml_bayar,0, ',','.'); ?></b></td>
                          <td>
                            <b>Rp. <?= number_format($value->gross_amount-$value->jml_bayar,0, ',','.'); ?></b>
                            <br/>
                            <?php if ($cek->num_rows() > 0) { ?>
                              <?php if ($get['status_code'] == 200) { ?>
                                <span class="badge bg-success">Paid</span>
                              <?php } else { ?>
                                <span class="badge bg-warning">Pending</span>
                              <?php } ?>
                            <?php } else { ?>
                              <span class="badge bg-danger">Unpaid</span>
                            <?php } ?>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress-sm"><div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%"></div></div>
                            <small><?= $value->progress; ?>% Complete</small>
                          </td>
                          </tr>
                      <?php } ?>
                    </table>
                  </div>
                 <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table table-stripped">
                      <tr>
                        <th>Nomor Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Mitra</th>
                        <th>Nomor Rekening</th>
                        <th>Tanggal Acara</th>
                        <th>Total Bayar</th>
                        <th>Progress</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($dikirim as $key => $value) { ?>
                         <?php $cek = $this->db->query("SELECT * FROM `tb_transaksi2` WHERE id_transaksi1='$value->id'"); $get = $cek->row_array(); ?>
                          <tr>
                          <td><?= $value->order_id; ?></td>
                          <td><?= $value->nama_pelanggan;  ?></td>
                          <td><?= $value->nama_toko;  ?></td>
                          <td><?= $value->no_rek;  ?></td>
                          <td><?= $value->tgl_acara; ?></td>
                          <td>
                            <b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress-sm"><div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%"></div></div>
                            <small><?= $value->progress; ?>% Complete</small>
                          </td>
                           <?php if ($value->progress >= 100) { ?>
                             <td><a href="<?= base_url('admin/sudah_bayar/'.$value->id_transaksi);  ?>" class="btn btn-sm btn-flat btn-primary">Sudah Dibayar</a>
                            </td>
                          <?php } else { ?>
                            <td><button class="btn btn-primary btn-flat btn-sm" disabled>Sudah Dibayar</button></td>
                          <?php } ?>
                         <!--  <td>
                            <a href="<?= base_url('admin/sudah_bayar/'.$value->id_transaksi);  ?>" class="btn btn-flat btn-primary">Sudah Dibayar</a>
                          </td> -->
                          </tr>
                      <?php } ?>
                      <?php foreach ($dikirim2 as $key => $value) { ?>
                         <?php $cek = $this->db->query("SELECT * FROM `tb_transaksi2` WHERE id_transaksi1='$value->id'"); $get = $cek->row_array(); ?>
                          <tr>
                          <td><?= $value->order_id; ?></td>
                          <td><?= $value->nama_pelanggan;  ?></td>
                          <td><?= $value->nama_vendor;  ?></td>
                          <td><?= $value->no_rek;  ?></td>
                          <td><?= $value->tgl_acara; ?></td>
                          <td>
                            <b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b>
                           
                          </td>
                          <td class="project_progress">
                            <div class="progress progress-sm"><div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%"></div></div>
                            <small><?= $value->progress; ?>% Complete</small>
                          </td>
                           <?php if ($value->progress >= 100) { ?>
                             <td><a href="<?= base_url('admin/sudah_bayar/'.$value->id_transaksi);  ?>" class="btn btn-sm btn-flat btn-primary">Sudah Dibayar</a>
                            </td>
                          <?php } else { ?>
                            <td><button class="btn btn-primary btn-flat btn-sm" disabled>Sudah Dibayar</button></td>
                          <?php } ?>
                          </tr>
                      <?php } ?>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                     <table class="table table-stripped">
                      <tr>
                        <th>Nomor Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Mitra</th>
                        <th>Tanggal Acara</th>
                        <th>Total Bayar</th>
                       <!--  <th>Progress</th> -->
                        <th>Status</th>
                      </tr>
                      <?php foreach ($selesai as $key => $value) { ?>
                        <tr>
                        <td><?= $value->order_id; ?></td>
                        <td><?= $value->nama_pelanggan;  ?></td>
                        <td><?= $value->nama_toko;  ?></td>
                        <td><?= $value->tgl_acara;  ?></td>
                        <td><b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b></td>
                        <!--  <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%">
                              </div>
                          </div>
                          <small>
                              <?= $value->progress;  ?>% Complete
                          </small>
                      </td> -->
                      <td><span class="badge bg-success">Selesai</span></td>
                      </tr>
                       <?php } ?>
                       <?php foreach ($selesai2 as $key => $value) { ?>
                        <tr>
                        <td><?= $value->order_id; ?></td>
                        <td><?= $value->nama_pelanggan;  ?></td>
                        <td><?= $value->nama_vendor;  ?></td>
                        <td><?= $value->tgl_acara;  ?></td>
                        <td><b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b></td>
                        <!--  <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress;  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%">
                              </div>
                          </div>
                          <small>
                              <?= $value->progress;  ?>% Complete
                          </small>
                      </td> -->
                      <td><span class="badge bg-success">Selesai</span></td>
                      </tr>
                       <?php } ?>
                     </table>
                  </div> 
                </div>
                  
              </div>

              <!-- /.card -->
            </div>
          </div>
      

