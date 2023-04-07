<div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-print"></i> <?= $title; ?>
                    <small class="float-right">Date: <?= $tanggal; ?>/<?= $bulan; ?>/<?= $tahun; ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
             

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Nomor Order</th>
                      <th>Product</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; $grand = 0; foreach ($laporan as $key => $value) { 
                        $total = $value->qty * $value->harga;
                        $grand = $grand + $total;
                        ?>
                      
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $value->order_id; ?></td>
                      <td><?= $value->nama_barang; ?></td>
                      <td>Rp. <?= number_format($value->harga, 0); ?></td>
                      <td><?= $value->qty; ?></td>
                      <td>Rp. <?= number_format($total, 0); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <h3 class="text-right">Grand Total: Rp. <?= number_format($grand, 0); ?></h3>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button class="btn btn-default" onclick="window.print();"><i class="fas fa-print"></i> Print</button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->