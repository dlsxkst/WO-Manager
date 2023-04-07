
<div class="col-md-8">
     <div class="row">
        <div class="col-md-8">
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
                     <img src="<?= base_url('assets/foto/'.$wo->gambar); ?>" alt="" width="200px" height="200px">
                    </div>
                    <div class="col-sm-8">
                      <h5><?= $wo->nama_toko; ?></h5>
                      <br>
                      <p>Username: <?= $wo->username; ?></p>
                      <p>Email: <?= $wo->email; ?></p>
                      <p>Nomor Telepon: <?= $wo->no_telp; ?></p>
                      <small class="right">Joined Since <?= $wo->added_time;  ?></small><br>
                    </div>
                    
                    <div class="col-sm-12">
                      <div class="form-group">
                        <a href="<?= base_url('am/edit_profile'); ?>" class="btn btn-primary btn-primary btn-block mt-2">Edit Profile</a>
                        </select> 
                      </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</div>
          <!-- /.col -->
