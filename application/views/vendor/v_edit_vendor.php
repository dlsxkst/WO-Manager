<div class="col-md-8">
	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Profile</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<?php 

              	if (isset($error_upload)) {
              		echo '<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-exclamation-triangle"></i>'.$error_upload.'</h6></div>';
              	}
              	
              	echo form_open_multipart('vendor/edit_profile/');

              	?>
              <div class="row">
                <div class="col-sm-4">
                   <div class="form-group">
                        <label>Nama Vendor</label>
                        <input type="hidden" name="id_vendor" value="<?= $vendor->id_vendor; ?>">
                        <input class="form-control" name="nama_vendor" value="<?= $vendor->nama_vendor; ?>">
                        <?= form_error('nama_vendor', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                </div>
                  
                 <div class="col-sm-4">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="username" value="<?= $vendor->username; ?>">
                        <?= form_error('username', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                 </div>
                 <div class="col-sm-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" value="<?= $vendor->email; ?>">
                        <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>
                   </div>
                 </div>
              </div>
              	<div class="row">
                   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>No Telepon</label>
                        <input class="form-control" name="no_telp" value="<?= $vendor->no_telp; ?>">
                        <?= form_error('no_telp', '<div class="text-small text-danger">','</div>'); ?>
                      </div>
                    </div>

                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>No Rekening</label>
                        <input class="form-control" name="no_rek" value="<?= $vendor->no_rek; ?>">
                        <?= form_error('no_rek', '<div class="text-small text-danger">','</div>'); ?>
                      </div>
                    </div>
                    
                  </div>
                 <div class="row">
                   <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="" cols="30" rows="5"><?= $vendor->deskripsi; ?></textarea>
                        <?= form_error('deskripsi', '<div class="text-small text-danger">','</div>'); ?>
                   </div>
                 </div>
                   <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" id="" cols="30" rows="5"><?= $vendor->alamat; ?></textarea>
                        <?= form_error('alamat', '<div class="text-small text-danger">','</div>'); ?>
                   </div>
                   </div>
                   </div>
                   <div class="row">
                    <div class="col-sm-6">
	                    <div class="form-group">
	                        <label>Gambar</label>
	                        <input type="file" class="form-control" name="gambar" id="preview_gambar">
	                    </div>
	                </div>
	                <div class="col-sm-6 text-center">
	                	<div class="form-group">
	                		<img src="<?= base_url('assets/foto/'.$vendor->gambar); ?>" id="gambar_load" alt="" width="350px">
	                	</div>
	                </div>
	                </div>
                   
                     <div class="form-group">
                       <button type="submit" name="submit" value="submit" class="btn btn-primary btn-md">Simpan</button>
                      </div>

              	<?php echo form_close() ?>
              </div>
     </div>
</div>
<div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Password</h3>

                <div class="card-tools">
                  
                </div>
                
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <?php 

               
                    if ($this->session->flashdata('message')){
                      echo '<div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i>';
                      echo $this->session->flashdata('message'); 
                      echo '</h5></div>';
                    }

                      if ($this->session->flashdata('error')){
                      echo '<div class="alert alert-warning alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-exclamation-triangle"></i>';
                      echo $this->session->flashdata('error'); 
                      echo '</h5></div>';
                    }

                
                echo form_open('vendor/edit_profile/');

                ?>
               
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" name="current_password">
                            <?= form_error('current_password', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
              
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="new_password1">
                            <?= form_error('new_password1', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Repeat New Password</label>
                            <input type="password" class="form-control" name="new_password2">
                            <?= form_error('new_password2', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                    

                   <div class="form-group">
                       <button type="submit" name="changepass" value="changepass" class="btn btn-primary btn-md">Simpan</button>
                  </div>

               <?php echo form_close() ?>
             
               </div>

              </div>
              <!-- /.card-body -->
            </div>

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
