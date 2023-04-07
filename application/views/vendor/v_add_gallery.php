<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Gambar: <?= $gallery->title; ?></h3>

                <div class="card-tools">
                  
                </div>
                
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <?php 

                if (isset($error_upload)) {
                  echo '<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-exclamation-triangle"></i>'.$error_upload.'</h6></div>';
                }
                    if ($this->session->flashdata('message')){
                      echo '<div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i>';
                      echo $this->session->flashdata('message'); 
                      echo '</h5></div>';
                    }

                
                echo form_open_multipart('vendor/add_gallery/'.$gallery->id_gallery)

                ?>
               

                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Keterangan gambar</label>
                            <input class="form-control" name="keterangan" value="<?= set_value('keterangan'); ?>">
                            <?= form_error('keterangan', '<div class="text-small text-danger">', '</div>'); ?>
                     </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                          <label>Gambar</label>
                          <input type="file" class="form-control" name="gambar" required="" id="preview_gambar">
                      </div>
                    </div>
                    <div class="col-sm-4 text-center">
                      <div class="form-group">
                        <img src="<?= base_url('assets/gambar/no-image.png'); ?>" id="gambar_load" alt="" width="150px">
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                       <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                       <a href="<?= base_url('vendor/gallery'); ?>" class="btn btn-md btn-success">Kembali</a>
                  </div>

               <?php echo form_close() ?>

               <hr>
               <div class="row">
                <?php foreach($gambar as $g) : ?>
                  <div class="col-sm-3 text-center">
                        <div class="form-group">
                          <img src="<?= base_url('assets/gallery/'.$g->gambar); ?>" id="gambar_load" alt="" width="250px" height="200px">
                        </div>
                        <label for="">Ket: <?= $g->keterangan; ?></label>
                        <button data-toggle="modal" data-target="#delete<?= $g ->id_gambar ?>" class="btn btn-sm btn-danger btn-block"><i class="fas fa-trash"> Delete</i></button>
                      </div>
                   <?php endforeach ?>
                </div>
           
               
               </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       

 <?php foreach($gambar as $k) :  ?>
        <div class="modal fade" id="delete<?= $k ->id_gambar ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $k->keterangan; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
               <div class="form-group text-center">
                          <img src="<?= base_url('assets/gallery/'.$k->gambar); ?>" id="gambar_load" alt="" width="200px" height="150px">
              </div>
              <h6>Apakah Anda yakin akan menghapus gambar ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('vendor/delete_gambar/'.$k->id_gallery .'/'. $k->id_gambar); ?>" class="btn btn-danger">Delete</a>
            </div>
             
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach;  ?>




<script>
  function bacaGambar(input){
    if(input.files && input.files[0] ){
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#preview_gambar').change(function() {
    bacaGambar(this);
  });
</script>

