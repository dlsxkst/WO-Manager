<div class="col-md-12">
	 <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Paket Pernikahan</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <?php 

                if (isset($error_upload)) {
                  echo '<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-exclamation-triangle"></i>'.$error_upload.'</h6></div>';
                }
                
                echo form_open_multipart('am/edit/'. $paket->id_paket);

                ?>
                  <div class="row">
                    <?php foreach ($paket2 as $key => $value) : ?>
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group">
                        <?php if ($value->detail_product_id == '' || $value->detail_product_id == 'NULL' ) { ?>
                           <input type="checkbox" name="id_barang[]" value="<?= $value->id_barang; ?>">
                           <input type="hidden" name="id_vendor[]" value="<?= $value->id_vendor; ?>">
                        <?php } else { ?>
                          <input type="checkbox" name="id_barang[]" value="<?= $value->id_barang; ?>" checked>
                          <input type="hidden" name="id_vendor[]" value="<?= $value->id_vendor; ?>">
                        <?php } ?>
                          
                          <label><?= $value->nama_barang ?>/<?= $value->nama_vendor ?>/Rp. <?= number_format($value->harga) ?></label>
                      </div>
                    </div>
                     <?php endforeach; ?>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nama Paket</label>
                         <input type="hidden" name="id_paket" value="<?= $paket->id_paket; ?>">
                        <input type="hidden" name="id_wo" value="<?php echo $paket->id_wo; ?>">
                        <input class="form-control" name="nama_paket" value="<?= $paket->nama_paket; ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Harga Paket</label>
                        <input class="form-control" name="harga_paket" value="<?= $paket->harga_paket; ?>">
                      </div>
                    </div>
                       <div class="col-sm-4">
                      <div class="form-group">
                        <label>Kapasitas</label>
                        <input class="form-control" name="kapasitas" value="<?= $paket->kapasitas; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                      <label for="">Kategori</label>
                      <select name="id_kategori" id="" class="form-control">
                        <option value="<?= $paket->id_kategori; ?>"><?= $paket->id_kategori; ?></option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="summernote" cols="30" rows="5"><?= $paket->deskripsi; ?></textarea>
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
                      <img src="<?= base_url('assets/gambar/'.$paket->gambar); ?>" id="gambar_load" alt="" width="350px">
                    </div>
                  </div>
                  </div>
                    <div class="form-group">
                       <button type="submit" name="submit" value="submit" class="btn btn-primary btn-md">Simpan</button>
                       <a href="<?= base_url('am/paket'); ?>" class="btn btn-md btn-success">Kembali</a>
                      </div>
                  
                <?php echo form_close() ?>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</div>


<script>
  tinymce.init({
    selector: '#editor',
    height: '500px',
    menubar: false,
    statusbar: false
  });
</script>
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