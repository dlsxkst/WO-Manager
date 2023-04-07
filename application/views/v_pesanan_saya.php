<head>
  <script type="text/javascript"
          src="https://app.sandbox.midtrans.com/snap/snap.js"
          data-client-key="SB-Mid-client-2AF2wPbuOOIupuf7"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<div class="row">

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
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#belum_bayar" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Order</a>
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
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="belum_bayar" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                     <table class="table table-stripped">
                     	<tr>
                     		<th>Nomor Order</th>
                     		<th>Tanggal Order</th>
                     		<th>Tanggal Acara</th>
                        <th>Payment Type</th>
                        <th>VA Number</th>
                        <th>DP</th>
                     		<th>Total</th>
                     		<th>Action</th>
                     	</tr>
                     	<?php foreach ($belum_bayar as $key => $value) { ?>
                       	<tr>
                     		<td><?= $value->order_id; ?></td>
                     		<td><?= $value->transaction_time; ?></td>
                     		<td><?= $value->tgl_acara;  ?></td>
                        <td><?= $value->payment_type;  ?></td>
                        <td><?= $value->va_number;  ?></td>
                        <td><b>Rp. <?= number_format($value->jml_bayar,0, ',','.'); ?></b><br>
                        <?php if ($value->status_code == 200) { ?>
                          <span class="badge bg-success">Success</span>
                        <?php } elseif ($value->status_code == 201) { ?>
                          <span class="badge bg-warning">Pending</span>
                        <?php } ?>
                     		<td><b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b><br>
                     		</td>
                     		<td>
                     			<?php if ($value->status_code == 201) { ?>
                     				<a href="<?= $value->pdf_url;  ?>" target="_blank" class="btn btn-success btn-sm">Download Cara Pembayaran</a>
                     			<?php } ?>
                     			
                     		</td>
                     	</tr>
                       <?php } ?>
                     </table>
                  </div>
                  <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                     <table class="table table-stripped">
                     	<tr>
                     		<th>Nomor Order</th>
                        <th>Nama Pelanggan</th>
                     		<th>Tanggal Acara</th>
                        <th>DP</th>
                     		<th>Sisa Bayar</th>
                        <th>Progress</th>
                     		<th>Aksi</th>
                     	</tr>
                     	<?php foreach ($diproses as $key => $value) { ?>
                        <?php $cek = $this->db->query("SELECT * FROM `tb_transaksi2` WHERE id_transaksi1='$value->id'"); $get = $cek->row_array(); ?>
                       	<tr>
                       		<td><?= $value->order_id; ?></td>
                          <td><?= $value->nama_pelanggan;  ?></td>
                       		<td><?= $value->tgl_acara; ?></td>
                          <td><b>Rp. <?= number_format($value->jml_bayar,0, ',','.'); ?></b></td>
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
                            <div class="progress progress-sm"><div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?= $value->progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value->progress;  ?>%"></div></div>
                            <small><?= $value->progress; ?>% Complete</small>
                          </td>
                          <?php if (50 <= $value->progress) { ?>
                            <?php if ($cek->num_rows() > 0 AND $get['status_code'] == 200) { ?>
                              <td><b>Sudah Dibayar</b></td>
                            <?php } else { ?>
                              <td>
                                <form id="payment-form<?= $value->id; ?>" method="post" action="<?=site_url()?>snap/finish2">
                                  <input type="hidden" name="id_transaksi1" id="id_transaksi1<?= $value->id; ?>" value="<?= $value->id; ?>">
                                  <input type="hidden" name="result_type" id="result-type<?= $value->id; ?>" value="">
                                  <input type="hidden" name="result_data" id="result-data<?= $value->id; ?>" value="">
                                  <input type="hidden" name="total" id="total<?= $value->id; ?>" value="<?= $value->gross_amount; ?>">
                                  <input type="hidden" name="jml_bayar" id="jml_bayar<?= $value->id; ?>" value="<?= $value->jml_bayar; ?>">
                                  <input type="hidden" name="id_pelanggan" id="id_pelanggan<?= $value->id; ?>" value="<?= $value->id_pelanggan; ?>">
                                  <input type="hidden" name="nama_pelanggan" id="nama_pelanggan<?= $value->id; ?>" value="<?= $value->nama_pelanggan; ?>">
                                  <input type="hidden" name="tgl_acara" id="tgl_acara<?= $value->id; ?>" value="<?= $value->tgl_acara; ?>">
                                  <input type="hidden" name="no_telp" id="no_telp<?= $value->id; ?>" value="<?= $value->no_telp; ?>">
                                  <input type="hidden" name="email" id="email<?= $value->id; ?>" value="<?= $value->email; ?>">
                                  <input type="hidden" name="alamat" id="alamat<?= $value->id; ?>" value="<?= $value->alamat; ?>">
                                  <input type="hidden" name="qty" id="qty<?= $value->id; ?>" value="1">
                                  <button id="pay-button<?= $value->id; ?>" class="btn btn-sm btn-success">Bayar Sisa</button>
                                </form>
                              </td>
                            <?php } ?>
                          <?php } else { ?>
                            <td><button class="btn btn-success btn-sm" disabled>Bayar Sisa</button></td>
                          <?php } ?>
                       	</tr>
                        <script type="text/javascript">
                          $('#pay-button<?= $value->id; ?>').click(function (event) {
                            event.preventDefault();
                            // $(this).attr("disabled", "disabled");
                            var nama_pelanggan = $("#nama_pelanggan<?= $value->id; ?>").val();
                            var tgl_acara = $("#tgl_acara<?= $value->id; ?>").val();
                            var no_telp = $("#no_telp<?= $value->id; ?>").val();
                            var email = $("#email<?= $value->id; ?>").val();
                            var alamat = $("#alamat<?= $value->id; ?>").val();
                            var total = $("#total<?= $value->id; ?>").val();
                            var qty = $("#qty<?= $value->id; ?>").val();
                            var id_vendor = $("#id_vendor<?= $value->id; ?>").val();
                            var id_wo = $("#id_wo<?= $value->id; ?>").val();
                            var pra_jml_bayar = $("#jml_bayar<?= $value->id; ?>").val();
                            var jml_bayar = total-pra_jml_bayar;
                            var id_pelanggan = $("#id_pelanggan<?= $value->id; ?>").val();
                            $.ajax({
                              type: 'POST',
                              url: '<?=site_url()?>snap/token2',
                              data: {
                                nama_pelanggan: nama_pelanggan,
                                tgl_acara: tgl_acara,
                                no_telp: no_telp,
                                email: email,
                                alamat: alamat,
                                total: total,
                                qty: qty,
                                id_vendor: id_vendor,
                                id_wo: id_wo,
                                jml_bayar: jml_bayar,
                                id_pelanggan: id_pelanggan
                              },
                              cache: false,
                              success: function(data) {
                                //location = data;
                                console.log('token = '+data);
                                var resultType = document.getElementById('result-type<?= $value->id; ?>');
                                var resultData = document.getElementById('result-data<?= $value->id; ?>');
                                function changeResult(type,data){
                                  $("#result-type<?= $value->id; ?>").val(type);
                                  $("#result-data<?= $value->id; ?>").val(JSON.stringify(data));
                                  //resultType.innerHTML = type;
                                  //resultData.innerHTML = JSON.stringify(data);
                                }
                                snap.pay(data, {
                                  onSuccess: function(result){
                                    changeResult('success', result);
                                    console.log(result.status_message);
                                    console.log(result);
                                    $("#payment-form<?= $value->id; ?>").submit();
                                  },
                                  onPending: function(result){
                                    changeResult('pending', result);
                                    console.log(result.status_message);
                                    $("#payment-form<?= $value->id; ?>").submit();
                                  },
                                  onError: function(result){
                                    changeResult('error', result);
                                    console.log(result.status_message);
                                    $("#payment-form<?= $value->id; ?>").submit();
                                  }
                                });
                              }
                            });
                          });
                        </script>
                      <?php } ?>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                      <table class="table table-stripped">
                     	<tr>
                     		<th>Nomor Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Acara</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                     	</tr>
                     	<?php foreach ($selesai as $key => $value) { ?>
                       	<tr>
                     		<td><?= $value->order_id; ?></td>
                        <td><?= $value->nama_pelanggan;  ?></td>
                        <td><?= $value->tgl_acara; ?></td>
                        <td><b>Rp. <?= number_format($value->gross_amount,0, ',','.'); ?></b>
                        </td>
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
            </div>
          </div>
        </div>

</div>

<?php foreach ($diproses as $key => $value) {  ?>

<div class="modal fade" id="diproses<?= $value->id_transaksi;  ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Tanggal Pertemuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--The calendar -->
                <div id="calendar" ></div>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <a href="<?= base_url('pesanan_saya/diterima/'.$value->id_transaksi); ?>" class="btn btn-primary">Ya</a>
            </div>
          </div>
         
        </div>
       
      </div>
    
<?php } ?>