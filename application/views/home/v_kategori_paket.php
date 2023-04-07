<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/wo-2.jpg" width="800px" height="250px" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/wo-1.jpg"  width="800px" height="250px" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/wo-3.jpg"  width="800px" height="250px"  alt="Third slide">
                    </div>
                     <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/wo-6.jpg"  width="800px" height="250px" alt="Sixth slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>


            <div class="card card-solid">
			        <div class="card-body pb-0">
			          <div class="row d-flex align-items-stretch">
                  <?php foreach ($paket as $b) : ?>
			          	 <div class="col-sm-4 d-flex align-items-stretch">
                     <?php 
                      echo form_open('belanja/add');
                      echo form_hidden('id', $b->id_paket);
                      echo form_hidden('qty', 1);
                      echo form_hidden('price', $b->harga_paket);
                      echo form_hidden('name', $b->nama_paket);
                      echo form_hidden('redirect_page', str_replace('index.php/',' ', current_url()));
                     ?>
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0 text-center">
                        <h2 class="lead"><b><?= $b->nama_paket; ?></b></h2>
                        <p class="text-muted text-sm"><b>Kategori: </b> <?= $b->nama_kategori; ?> </p>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12 text-center">
                            <img src="<?= base_url('assets/gambar/'.$b->gambar); ?>" height="200px" width="300px" >
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="text-left">
                              <h4><span class="badge bg-primary">Rp. <?= number_format($b->harga_paket, 0, ',', '.') ?></span></h4>
                            </div>
                          </div>
                        
                        
                          <div class="col-sm-6">
                            <div class="text-right">
                            <a href="<?= base_url('home/detail_paket/'. $b->id_paket); ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-eye"> </i>
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                              <i class="fas fa-shopping-cart"></i> Add
                            </button>
                          </div>
                          </div>
                  </div>
                </div>
              </div>
              <?php echo form_close(); ?>
            </div>
          <?php endforeach; ?>
			</div>
		</div>
</div>

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