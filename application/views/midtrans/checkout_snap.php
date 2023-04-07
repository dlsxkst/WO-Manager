
  <head>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-2AF2wPbuOOIupuf7"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </head>
      <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-shopping-bag"></i> WOManager
                    <small class="float-right">Date: <?= date('d-m-Y'); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>

                      <?php 
                      $total = 0;
                      $keranjang = $this->m_transaksi->keranjang();
                            foreach ($keranjang as $items) {
                              $toko = $this->m_home->detail_toko($items->id);
                              $subtotal = $items->qty * $items->price;
                              $total = $total + $subtotal;
                              $dp = 0.2 * $total;
                              
                      ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?php echo $items->name; ?></td>
                      <td >Rp. <?php echo number_format($items->price); ?></td>
                      <td class="text-right" >Rp. <?php echo number_format($subtotal); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
    
            <form id="payment-form" method="post" action="<?=site_url()?>snap/finish">
              <input type="hidden" name="result_type" id="result-type" value=""></div>
              <input type="hidden" name="result_data" id="result-data" value=""></div>
              <input type="hidden" name="total" id="total" value="<?= $total;  ?>">
              <input type="hidden" name="jml_bayar" id="jml_bayar" value="<?= $dp; ?>">
              <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?= $this->session->userdata('id_pelanggan');  ?>">
              <?php foreach ($keranjang as $key => $value) { ?>
                <?php if ($value->id_vendor != ''): ?>
                  <input type="hidden" name="id_vendor" id="id_vendor" value="<?= $value->id_vendor;  ?>">
                  <input type="hidden" id="tb" name="tb" value="tb_vendor">
                  <input type="hidden" id="to" name="to" value="id_vendor">
                <?php elseif ($value->id_wo != '') : ?>
                   <input type="hidden" name="id_wo" id="id_wo" value="<?= $value->id_wo;  ?>">
                  <input type="hidden" id="tb" name="tb" value="tb_wo">
                  <input type="hidden" id="to" name="to" value="id_wo">
                <?php endif ?>
                
              <?php } ?>
              
              <div class="row">
                <!-- accepted payments column -->
               <div class="col-sm-8 invoice-col">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input name="nama_pelanggan" id="nama_pelanggan" class="form-control" required="">
                          <?= form_error('nama_pelanggan', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Tanggal Acara</label>
                       <input type="date" name="tgl_acara" id="tgl_acara" class="form-control" required="">
                      <?= form_error('tgl_acara', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Nomor Telepon</label>
                     <input type="text" name="no_telp" id="no_telp" class="form-control" required="">
                      <?= form_error('no_telp', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Email</label>
                     <input type="email" name="email" id="email" class="form-control" required="">
                      <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>
               
                 

                    <div class="col-sm-12">
                      
                      <div class="form-group">
                        <label>Kota Anda</label>
                        <!-- value="<?= set_value('add_charge'); ?>" -->
                        <input list="add_charge" type="text" class="form-control" id="add_charge_input" name="add_charge" autocomplete="none" onchange="cek_ziyadah()" onkeyup="cek_ziyadah()" required>
                        <?php if ($this->session->flashdata('kota')) { ?><p class="text-small text-danger"><?= $this->session->flashdata('kota'); ?></p><?php } ?>
                        <?php $hasil = json_decode(file_get_contents('assets/json/kota.json'), true); ?>
                        <datalist id="add_charge">
                          <?php foreach ($hasil as $kota) { ?>
                            <option value="<?= $kota['city']; ?>"><?= $kota['admin_name'].', '.$kota['country']; ?></option>
                          <?php } ?>
                        </datalist>
                      </div>
                    </div>
           
                   <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <textarea class="form-control" name="alamat" id="alamat" required=""></textarea>
                      <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                  </div>

              </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                 
                  <div class="table-responsive">
                    <table id="ziyadah" class="table">
                      <tr>
                        <th style="width:50%">Down Payment (DP):</th>
                        <th class="text-right">Rp. <?php echo number_format($dp); ?></th>
                      </tr>
                     
                      <tr>
                        <th style="width:50%">Total Bayar:</th>
                        <th class="text-right">Rp. <?php echo number_format($total); ?></th>
                      </tr>
                      <tr>
                        <th style="width:50%">Sisa:</th>
                        <th class="text-right">Rp. <?php echo number_format($total - $dp); ?></th>
                      </tr>
                      
                    </table>
                  </div>
                </div>
                 <?php $i = 1;
              foreach ($keranjang as $items) { ?>
             
                <input type="hidden" name="qty<?= $i++; ?>" id="qty" value="<?= $items->qty;  ?>">
                
              <?php } ?>
                <!-- /.col -->
              </div>
               <button id="pay-button" class="btn btn-sm btn-primary">Bayar DP</button>
        </form>

   
    <script type="text/javascript">
  
      function cek_ziyadah() {
        $.post('<?= site_url('snap/cek_ziyadah'); ?>', {
          add_charge: $('#add_charge_input').val(),
          id_vendor: $('#id_vendor').val(),
          id_wo: $('#id_wo').val(),
          dp: '<?= $dp; ?>',
          total: '<?= $total; ?>',
          sisa: '<?= $total - $dp; ?>',
          tb: $('#tb').val(),
          to: $('#to').val()
        },
        function(data, status) {
          $('#ziyadah').html(data);
        });
      }

    $('#pay-button').click(function (event) {
      event.preventDefault();
      // $(this).attr("disabled", "disabled");
    var nama_pelanggan = $("#nama_pelanggan").val();
    var add_charge = $("#add_charge_input").val();
    var tb = $("#tb").val();
    var to = $("#to").val();
    var tgl_acara = $("#tgl_acara").val();
    var no_telp = $("#no_telp").val();
    var email = $("#email").val();
    var alamat = $("#alamat").val();
    var total = $("#total").val();
    var qty = $("#qty").val();
    var id_vendor = $("#id_vendor").val();
    var id_wo = $("#id_wo").val();
    var jml_bayar = $("#jml_bayar").val();
    var id_pelanggan = $("#id_pelanggan").val();
    $.ajax({
      type: 'POST',
      url: '<?=site_url()?>snap/token',
      data: {
        nama_pelanggan: nama_pelanggan,
        add_charge: add_charge,
        tb: tb,
        to: to,
        tgl_acara: tgl_acara,
        no_telp: no_telp,
        email: email,
        alamat: alamat,
        total: total,
        qty: qty,
        id_vendor:id_vendor,
        id_wo:id_wo,
        jml_bayar:jml_bayar,
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

  <script>
          $(document).ready(function(){
              $("#provinsi").change(function (){
                  var url = "<?php echo site_url('wilayah/add_ajax_kab');?>/"+$(this).val();
                  $('#kabupaten').load(url);
                  return false;
              })
     
          $("#kabupaten").change(function (){
                  var url = "<?php echo site_url('wilayah/add_ajax_kec');?>/"+$(this).val();
                  $('#kecamatan').load(url);
                  return false;
              })
     
          $("#kecamatan").change(function (){
                  var url = "<?php echo site_url('wilayah/add_ajax_des');?>/"+$(this).val();
                  $('#desa').load(url);
                  return false;
              })
          });
      </script>

