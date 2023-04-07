<div class="card card-solid">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">Cari Toko</h2>
            <?= form_open('home/search_toko'); ?>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                      
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" name="keyword" placeholder="Type your keywords here">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?= form_close(); ?>
        </div>
    </section>
            

              <div class="card-body pb-0">
                <div class="row">
                  <?php foreach ($cari as $b) : ?>
                   <div class="col-sm-4">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0 text-center">
                        <h2 class="lead"><b><?= $b->nama_toko; ?></b></h2>
                        <p class="text-muted text-sm"><?= $b->alamat; ?> </p>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12 text-center">
                            <img src="<?= base_url('assets/foto/'.$b->gambar); ?>"width="300px" height="200px">
                          </div>
                        </div>

                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="text-left">
                            
                            </div>
                          </div>
                        
                        
                          <div class="col-sm-6">
                            <div class="text-right">
                            <a href="<?= base_url('home/detail_toko/'. $b->id_wo); ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-eye">  Detail </i>
                            </a>
                           
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
<script>
    $(function () {
      $('.select2').select2()
    });
</script>