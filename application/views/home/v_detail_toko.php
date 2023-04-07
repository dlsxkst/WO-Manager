 <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?= $toko->nama_toko; ?></h3>
              <div class="col-12">
                <img src="<?= base_url('assets/foto/'.$toko->gambar); ?>"  width="300px" height="300px">
              </div>
            
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?= $toko->nama_toko; ?></h3>
              <h6><i class="fas fa-map-marker"></i> <?= $toko->alamat; ?></h6>
              <h6><i class="fas fa-envelope"></i> <?= $toko->email; ?></h6>
              <h6><i class="fas fa-phone"></i> <?= $toko->no_telp ?></h6>
              <h6></h6>

              <hr>
              <p><?=$this->security->xss_clean($toko->deskripsi)?></p>
              <hr>

            </div>
          </div>
         
        </div>
        <!-- /.card-body -->
      </div>
       <div class="card card-solid">
         <div class="card-header">
            <h3 class="card-title"><b>Gallery</b></h3>
          </div>
        <div class="card-body">
         <div class="row">
           <?php foreach ($gallery as $key => $value) : ?>
           <div class="col-sm-2">
            
               <a href="<?php echo base_url('home/detail_gallery/'.$value->id_gallery) ?>"><img src="<?= base_url('assets/gallery/'.$value->gambar); ?>"  width="100px" height="100px"></a><br>
               <a href="<?php echo base_url('home/detail_gallery/'.$value->id_gallery) ?>"><?= $value->title; ?></a>
             
           </div>
           <?php endforeach; ?>
         </div>
        </div>
        
      </div>
      <!-- /.card -->
      <div class="card card-solid">
         <div class="card-header">
            <h3 class="card-title"><b>Vendor</b></h3>
          </div>
        <div class="card-body">
         <div class="row">
           <?php foreach ($vendor as $key => $value) : ?>
           <div class="col-sm-2">
            
               <a href="<?php echo base_url('home/detail_vendor/'.$value->id_vendor) ?>"><img src="<?= base_url('assets/foto/'.$value->gambar); ?>"  width="100px" height="100px"></a><br>
               <a href="<?php echo base_url('home/detail_vendor/'.$value->id_vendor) ?>"><?= $value->nama_vendor; ?></a>
             
           </div>
           <?php endforeach; ?>
         </div>
        </div>
        
      </div>
       <div class="card card-solid">
         <div class="card-header">
            <h3 class="card-title"><b>Produk</b></h3>
          </div>
        <div class="card-body">
           
          <div class="row">
             <?php foreach ($paket as $key => $value) : ?>
           <div class="col-sm-2">
               <a href="<?php echo base_url('home/detail_paket/'.$value->id_paket) ?>" target="_blank"><img src="<?= base_url('assets/gambar/'.$value->gambar); ?>"  width="100px" height="100px"></a><br>
               <a href="<?php echo base_url('home/detail_paket/'.$value->id_paket) ?>"><?= $value->nama_paket; ?></a>
             
           </div>
           <?php endforeach; ?>
          <?php foreach ($barang as $key => $value) : ?>
           <div class="col-sm-2">
               <a href="<?php echo base_url('home/detail_barang/'.$value->id_barang) ?>"><img src="<?= base_url('assets/gambar/'.$value->gambar); ?>"  width="100px" height="100px"></a><br>
               <a href="<?php echo base_url('home/detail_barang/'.$value->id_barang) ?>"><?= $value->nama_barang; ?></a>
             
           </div>
           <?php endforeach; ?>
           
         </div>
        </div>
        
      </div>
</div>

<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Barang berhasil ditambahkan ke keranjang.'
      })
    });
   });
</script>
