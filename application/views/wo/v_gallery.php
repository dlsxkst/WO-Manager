
<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Gallery</h3>


                <div class="card-tools">
                  <button type="button" data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm" >
                    <i class="fas fa-plus"></i> Add Gallery</button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                 echo validation_errors('<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-exclamation-triangle"></i>', '</h6></div>');
                    if ($this->session->flashdata('message')){
                      echo '<div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i>';
                      echo $this->session->flashdata('message'); 
                      echo '</h5></div>';
                    }
                ?>
               <table class="table table-hover table-striped" id="example1">
                 <thead class="text-center">
                   <tr>
                     <th>#</th>
                     <th>Title</th>
                     <th>Gambar</th>
                     <th>Actions</th>
                   </tr>
                 </thead>

                 <tbody>
                  <?php $no=1; foreach($gallery as $k) :  ?>
                   <tr>
                     <td class="text-center"><?= $no++ ?></td>
                     <td><?= $k->title ?></td>
                      <td class="text-center"><img src="<?= base_url('assets/gallery/'.$k->gambar); ?>" alt="" width="100px"></td>
<!--                        <td class="text-center"><span class="badge bg-primary"><?= $k->total_gambar; ?></span></td> -->
                     <td class="text-center">
                      <a href="<?= base_url('am/add_gallery/'. $k->id_gallery); ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"> Add Gambar</i></a>
                       <button data-toggle="modal" data-target="#edit<?= $k ->id_gallery ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                       <button data-toggle="modal" data-target="#delete<?= $k ->id_gallery ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                     </td>
                   </tr>
                  <?php endforeach;   ?>
                 </tbody>
               </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

      <div class="modal fade" id="add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Gallery</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart('kategori/add_gallery'); ?>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                     
                </div>
                 <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi"></textarea> 
                     
                </div>
               
                      <div class="form-group">
                          <label>Gambar</label>
                          <input type="file" class="form-control" name="gambar" id="preview_gambar">
                      </div>
                 
                   <!--  <div class="form-group">
                      <img src="<?= base_url('assets/gambar/no-image.png'); ?>" id="gambar_load" alt="" width="150px">
                    </div> -->
                 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
             <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

       <?php foreach($gallery as $k) :  ?>
        <div class="modal fade" id="edit<?= $k->id_gallery ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Gallery</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
           <div class="modal-body">
              <?php echo form_open_multipart('kategori/edit_gallery/'. $k->id_gallery); ?>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $k->title;  ?>">
                     
                </div>
                 <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi"><?= $k->deskripsi;  ?></textarea> 
                      
                </div>
               
                     <div class="form-group">
                          <label>Gambar</label>
                          <input type="file" class="form-control" name="gambar" id="preview_gambar2">
                      </div>
                 
                    <div class="form-group">
                      <img src="<?= base_url('assets/gallery/'.$k->gambar); ?>" id="gambar_load2" alt="" width="150px">
                    </div>
                 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
             <?php echo form_close(); ?>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach;  ?>



<?php foreach($gallery as $k) :  ?>
        <div class="modal fade" id="delete<?= $k ->id_gallery ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $k->title; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <h6>Apakah Anda yakin akan menghapus data ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('kategori/delete_gallery/'. $k->id_gallery); ?>" class="btn btn-danger">Delete</a>
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

<script>
  function bacaGambar(input){
    if(input.files && input.files[0] ){
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#preview_gambar2').change(function() {
    bacaGambar(this);
  });
</script>
