<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4">
<div class="register-box">
 
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new account</p>

      <?php
        echo validation_errors('<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-exclamation-triangle"></i>', '</h6></div>');

      if ($this->session->flashdata('message')){
        echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="icon fas fa-check"></i>';
        echo $this->session->flashdata('message'); 
        echo '</h6></div>';
        }
      echo form_open('auth/register'); ?>

        <div class="input-group mb-3">
          <input type="text" name="nama_pelanggan" value="<?= set_value('nama_pelanggan'); ?>" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" value="<?= set_value('password'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="ulangi_password" class="form-control" placeholder="Retype password" value="<?= set_value('ulangi_password'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         <div class="input-group mb-3">
         <select name="level_user" id="" class="form-control">
           <option value="">--Daftar Sebagai--</option>
           <option value="">Pelanggan</option>
           <option value="2">Wedding Organizer</option>
           <option value="3">Vendor</option>
         </select>
        </div>
        <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      <?= form_close(); ?>


      <a href="<?= base_url('auth/login_user'); ?>" class="text-center">Sudah mempunyai akun</a><br>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
 </div>
</div>
<div class="col-sm-4"></div>
</div>
</div>