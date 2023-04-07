<div class="col-md-12">
	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<?php 

              	if (isset($error_upload)) {
              		echo '<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-exclamation-triangle"></i>'.$error_upload.'</h6></div>';
              	}
              	
              	echo form_open_multipart('barang/edit/'. $barang->id_barang);

              	?>
              	<div class="row">
                 <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input class="form-control" name="nama_barang" value="<?= $barang->nama_barang; ?>">
                        <?= form_error('nama_barang', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                 </div> 
                  <div class="col-sm-6">
                      <label for="">Kategori</label>
                      <select name="id_kategori" id="" class="form-control">
                        <option value="<?= $barang->id_kategori; ?>"><?= $barang->nama_kategori; ?></option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      </select>
                       <?= form_error('id_kategori', '<div class="text-small text-danger">', '</div>'); ?>
                    </div>
                </div>
              	<div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Harga Barang</label>
                        <input class="form-control" name="harga" value="<?= $barang->harga; ?>">
                        <?= form_error('harga', '<div class="text-small text-danger">','</div>'); ?>
                      </div>
                    </div>
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Kapasitas</label>
                        <input class="form-control" name="kapasitas" value="<?= $barang->kapasitas; ?>">
                        <?= form_error('kapasitas', '<div class="text-small text-danger">','</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="summernote" cols="30" rows="5"><?= $barang->deskripsi; ?></textarea>
                        <?= form_error('deskripsi', '<div class="text-small text-danger">','</div>'); ?>
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
	                		<img src="<?= base_url('assets/gambar/'.$barang->gambar); ?>" id="gambar_load" alt="" width="350px">
	                	</div>
	                </div>
	                </div>
                   
                     <div class="form-group">
                       <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                       <a href="<?= base_url('barang'); ?>" class="btn btn-md btn-success">Kembali</a>
                      </div>

              	<?php echo form_close() ?>
              </div>
     </div>
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
