<!-- Main content -->

            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-shopping-bag"></i> WOManager
                    <small class="float-right">Date: <?= date('d-m-Y'); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Total Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>

                      <?php 
                            foreach ($this->cart->contents() as $items) {
                              $toko = $this->m_home->detail_toko($items['id']);
                      ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?php echo $items['name']; ?></td>
                      <td >Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
                      <td >Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <form id="payment-form" method="post" action="<?=site_url()?>/snap/finish">
              <input type="hidden" name="result_type" id="result-type" value="">
              <input type="hidden" name="result_data" id="result-data" value="">
              <input type="hidden" name="total" id="total" value="<?= $this->cart->total();  ?>">
              <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?= $this->session->userdata('id_pelanggan');  ?>">
              <div class="row">
                <!-- accepted payments column -->
               <div class="col-sm-8 invoice-col">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input name="nama_pelanggan" id="nama_pelanggan" class="form-control">
                          <?= form_error('nama_pelanggan', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Tanggal Acara</label>
                       <input type="date" name="tgl_acara" id="tgl_acara" class="form-control">
                      <?= form_error('tgl_acara', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Nomor Telepon</label>
                     <input type="text" name="no_telp" id="no_telp" class="form-control">
                      <?= form_error('no_telp', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Email</label>
                     <input type="email" name="email" id="email" class="form-control">
                      <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                   <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <textarea class="form-control" name="alamat" id="alamat"></textarea>
                      <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>

              </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                 
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total Bayar:</th>
                        <th>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></th>
                      </tr>
                     
                     <!--  <tr>
                        <th>Total Bayar:</th>
                        <th><label for="" id="total_bayar"></label></th>
                      </tr> -->
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
               <?php $i = 1;
              foreach ($this->cart->contents() as $items) {
                echo form_hidden('qty'.$i++, $items['qty']);

              } ?>

              <div class="row no-print">
                <div class="col-12">
                  <a href="<?= base_url('belanja'); ?>"   class="btn btn-default"><i class="fas fa-backward"></i> Back to Cart</a>
                  <button id="pay-button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  
                </div>
              </div>
             </form>
            </div>
          </div>



<script type="text/javascript">
  
    $('#pay-button').click(function (event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled");

    var nama_pelanggan = $("#nama_pelanggan").val();
    var tgl_acara = $("#tgl_acara").val();
    var no_telp = $("#no_telp").val();
    var email = $("#email").val();
    var alamat = $("#alamat").val();
    var total = $("#total").val();
    var id_pelanggan = $("#id_pelanggan").val();

    $.ajax({
      type: 'POST',
      url: '<?=site_url()?>snap/token',
      data: {
        nama_pelanggan: nama_pelanggan,
        tgl_acara: tgl_acara,
        no_telp: no_telp,
        email: email,
        alamat: alamat,
        total: total,
        id_pelanggan: id_pelanggan
       },
      cache: false,

      success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });

  </script>