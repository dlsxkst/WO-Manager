 <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <h3 ><?= $gallery->title; ?></h3>
              <p><?=$this->security->xss_clean($gallery->deskripsi)?></p>
            </div>
              <div class="col-12">
                <img src="<?= base_url('assets/gallery/'.$gallery->gambar); ?>" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="<?= base_url('assets/gallery/'.$gallery->gambar); ?>" alt="Product Image"></div>
                <?php foreach($gambar as $g) : ?>
                <div class="product-image-thumb" ><img src="<?= base_url('assets/gallery/'.$g->gambar); ?>" alt="Product Image"></div>
                <?php endforeach ?>
               
              </div>
               <?php foreach($gambar as $g) : ?>
                <div class="col-12 col-sm-4 mt-3">
                <img src="<?= base_url('assets/gallery/'.$g->gambar); ?>"width="300px" height="200px">
                <p><?=$this->security->xss_clean($g->keterangan)?></p>
              </div>
             
               <?php endforeach ?>
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
