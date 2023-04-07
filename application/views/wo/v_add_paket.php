<div class="col-md-12">
   <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Paket Pernikahan</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
               <?php echo form_open_multipart('am/add_paket'); ?>
              <div class="row">
                   <?php foreach ($product->result() as $row) :?>
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group">
                          <input type="checkbox" name="id_barang[]" value="<?= $row->id_barang; ?>">
                          <input type="hidden" name="id_vendor[]" value="<?= $row->id_vendor; ?>">
                          <label><?= $row->nama_barang ?>/<?= $row->nama_vendor ?>/Rp. <?= number_format($row->harga) ?></label>
                      </div>
                    </div>
                     <?php endforeach; ?>
                  </div>
                 <div class="row">
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="hidden" name="id_wo" value="<?php echo $this->session->userdata('id_wo') ?>">
                        <input class="form-control" name="nama_paket">
                      </div>
                    </div>
                      <div class="col-sm-4">
                      <div class="form-group">
                        <label>Harga Paket</label>
                        <input class="form-control" name="harga_paket" required="">
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Kapasitas</label>
                        <input class="form-control" name="kapasitas" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                      <label for="">Kategori</label>
                      <select name="id_kategori" id="" class="form-control" required="">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="summernote" cols="30" rows="5" required=""></textarea>
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
                      <img src="<?= base_url('assets/gambar/no-image.png'); ?>" id="gambar_load" alt="" width="350px">
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