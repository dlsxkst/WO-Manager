
<div class="col-md-8">
     <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->flashdata('message')){
                      echo '<div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i>';
                      echo $this->session->flashdata('message'); 
                      echo '</h5></div>';
                    } ?>
        </div>
    </div>
            <div class="card card-primary">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  
                    <div class="col-sm-4">
                     <img src="<?= base_url('assets/foto/'.$vendor->gambar); ?>" alt="" width="200px" height="200px">
                    </div>
                    <div class="col-sm-8">
                      <h5><?= $vendor->nama_vendor; ?></h5>
                      <br>
                      <p><?= $vendor->username; ?></p>
                      <p><?= $vendor->email; ?></p>
                      <p><?= $vendor->no_telp; ?></p>
                    </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-12">
                      <div class="form-group">
                        <a href="<?= base_url('vendor/edit_profile'); ?>" class="btn btn-primary btn-primary btn-block">Edit Profile</a>
                       
                    </div>
                    </div>
                   
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</div>
          <!-- /.col -->
