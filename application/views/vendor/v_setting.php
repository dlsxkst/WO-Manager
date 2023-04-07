<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Setting</h3>
		</div>

		<div class="card-body">
			
          <?php
           if ($this->session->flashdata('message')){
                      echo '<div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i>';
                      echo $this->session->flashdata('message'); 
                      echo '</h5></div>';
                    }

           echo form_open('vendor/setting');  ?>
              <div class="row">
                    <div class="col-sm-6">
	                    <div class="form-group">
	                        <label>Provinsi</label>
	                       <select name="prov" class="form-control" id="provinsi">
							<option>-- Select Provinsi --</option>
							<?php 
								foreach($provinsi as $prov)
								{
									echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
								}
							?>
						</select>
	                    </div>
	                </div>
	                <div class="col-sm-6">
	                	<div class="form-group">
	                		<label for="">Kota/Kabupaten</label>
	                	<select name="kab" class="form-control" id="kabupaten">
							<option value=''>--Select Kota/Kabupaten--</option>
						</select>
	                		<?= form_error('kab', '<div class="text-small text-danger">','</div>'); ?>
	                	</div>
	                </div>
	            </div>
	            <div class="row">
	            	<div class="col-sm-6">
	                    <div class="form-group">
	                        <label>Nama Toko</label>
	                        <input type="text" name="nama_toko" class="form-control" required="">
	                        <?= form_error('nama_toko', '<div class="text-small text-danger">','</div>'); ?>
	                    </div>
	                </div>
	                <div class="col-sm-6">
	                    <div class="form-group">
	                        <label>Nomor Telepon</label>
	                        <input type="text" name="no_telepon" class="form-control" required="" >
	                        <?= form_error('no_telepon', '<div class="text-small text-danger">','</div>'); ?>
	                    </div>
	                </div>
	            	
	            </div>
	                    <div class="form-group">
	                        <label>Alamat Toko</label>
	                        <textarea name="alamat_toko" class="form-control" required=""></textarea>
	                      
	                        <?= form_error('alamat_toko', '<div class="text-small text-danger">','</div>'); ?>
	                    </div>

	                     <div class="form-group">
	                        <label>Tambahan Biaya Per Kilometer (KM)</label>
	                        <input type="number" name="add_charge" class="form-control" required="" >
	                        <?= form_error('add_charge', '<div class="text-small text-danger">','</div>'); ?>
	                    </div>
	            <div class="form-group">
                   <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                   <a href="<?= base_url('vendor'); ?>" class="btn btn-md btn-success">Kembali</a>
                </div>
	            


          <?php echo form_close(); ?>

		</div>
	</div>
</div>

<script>
        	$(document).ready(function(){
	            $("#provinsi").change(function (){
	                var url = "<?php echo site_url('wilayah/add_ajax_kab');?>/"+$(this).val();
	                $('#kabupaten').load(url);
	                return false;
	            })
	   
	   			$("#kabupaten").change(function (){
	                var url = "<?php echo site_url('wilayah/add_ajax_kec');?>/"+$(this).val();
	                $('#kecamatan').load(url);
	                return false;
	            })
	   
	   			$("#kecamatan").change(function (){
	                var url = "<?php echo site_url('wilayah/add_ajax_des');?>/"+$(this).val();
	                $('#desa').load(url);
	                return false;
	            })
	        });
    	</script>