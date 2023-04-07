<div class="row">
  <div class="col-md-3"></div>
   
  <div class="col-md-6">
      <?php 

                    if ($this->session->flashdata('message')){
                      echo '<div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i>';
                      echo $this->session->flashdata('message'); 
                      echo '</h5></div>';
                    }

           

                ?>
		<div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?= base_url('assets/foto/'.$pelanggan->foto); ?>"
                       alt="User profile picture">
                </div>
                <br>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Nama</b> <a class="float-right"><?php echo $pelanggan->nama_pelanggan; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?php echo $pelanggan->email; ?></a>
                  </li>
                </ul>

                <a href="<?= base_url('pelanggan/edit'); ?>" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-3"></div>
    </div>
</div>