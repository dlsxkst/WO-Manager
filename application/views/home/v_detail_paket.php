 <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?= $paket->nama_paket; ?></h3>
              <div class="col-12">
                <img src="<?= base_url('assets/gambar/'.$paket->gambar); ?>" class="product-image" alt="Product Image">
              </div>
            <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="<?= base_url('assets/gambar/'.$paket->gambar); ?>" alt="Product Image"></div>
                <?php foreach($gambar as $g) : ?>
                <div class="product-image-thumb" ><img src="<?= base_url('assets/gambarpaket/'.$g->gambar); ?>" alt="Product Image"></div>
                <?php endforeach ?>
               
              </div> 
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?= $paket->nama_paket; ?></h3>
              <p><?= $paket->nama_kategori ?> by <a href="<?= base_url('home/detail_toko/'.$paket->id_wo);  ?>"><?= $paket->nama_toko;  ?></a> </p>
               <i class="fa fa-map-marker"> <?= $paket->kab;  ?></i>
              <hr>
              <h6>Kapasitas: <?= $paket->kapasitas ?> Pax</h6>

              <hr>
             <p><?=$this->security->xss_clean($paket->deskripsi)?><br>

           

            </p>
              <hr>
             
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Rp. <?= number_format($paket->harga_paket, 0, ',', '.') ?>
                </h2>
              </div>
              <?php 
                     echo form_open('belanja/add');
                      echo form_hidden('id', $paket->id_paket);
                      echo form_hidden('qty', 1);
                      echo form_hidden('price', $paket->harga_paket);
                      echo form_hidden('name', $paket->nama_paket);
                      echo form_hidden('id_pelanggan', $this->session->userdata('id_pelanggan'));
                      echo form_hidden('id_wo', $paket->id_wo);
                      echo form_hidden('redirect_page', str_replace('index.php/',' ', current_url()));
              ?>
                <div class="mt-4">
                  <div class="row">
                   
                      <input type="number" name="qty" class="form-control" value="1" min="1" hidden="">

                <?php if ($this->session->userdata('id_pelanggan') < 1) { ?>
                  <a href="<?= base_url('auth/login_user');  ?>" onclick="alert('Silakan login terlebih dahulu');" class="btn btn-primary btn-flat"><i class="fas fa-comment fa-lg"></i> Chat</a>
                  <?php } else { ?>
                     <a href="<?= base_url('chat?to=wo&id='.$paket->id_wo); ?>" class="btn btn-primary btn-flat"><i class="fas fa-comment fa-lg"></i>
                        Chat</a>
                   <?php } ?>
                   

                    <div class="col-sm-5">
                      <button type="submit" class="btn btn-primary btn-md btn-flat swalDefaultSuccess">
                    <i class="fas fa-credit-card fa-lg mr-2"></i>
                    Add to Payment
                  </button>
                    </div>
                  </div>
                </div>
              <?php echo form_close(); ?>

              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>
         
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
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
