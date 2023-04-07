
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="container">
  <!-- /.login-logo -->
  <div class="col-md-12 mt-2">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url(); ?>" class="h1"><b>WO-</b>MANAGER</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new Vendor</p>

      <?php 
      
      if ($this->session->flashdata('error')){
      echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-ban"></i>';
      echo $this->session->flashdata('error'); 
      echo '</h6></div>';
    }

    if ($this->session->flashdata('message')){
      echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h6><i class="icon fas fa-check"></i>';
      echo $this->session->flashdata('message'); 
      echo '</h6></div>';
    }
                  ?>
     <?= form_open('auth/register_vendor'); ?>

                 <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Vendor</label>
                        <input type="text" class="form-control" name="nama_vendor" value="<?= set_value('nama_pelanggan'); ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp"  placeholder="Nomor Telepon" value="<?= set_value('no_telp'); ?>">
                        <?= form_error('no_telp', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" class="form-control" name="no_rek"  placeholder="Nomor Rekening" value="<?= set_value('no_rek'); ?>">
                        <?= form_error('no_rek', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                        <?= form_error('username', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"  value="<?= set_value('email'); ?>">
                      </div>
                    </div>
                     <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" value="<?= set_value('password'); ?>">
                      </div>
                    </div>
                  </div>
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
                      <!-- text input -->
                      <div class="form-group">
                        <label>Kota Anda</label>
                        <!-- value="<?= set_value('add_charge'); ?>" -->
                        <input list="add_charge" type="text" class="form-control" name="add_charge" placeholder="Pilih Kota" autocomplete="none" required>
                        <?php if ($this->session->flashdata('kota')) { ?><p class="text-small text-danger"><?= $this->session->flashdata('kota'); ?></p><?php } ?>
                        <?php $hasil = json_decode(file_get_contents('assets/json/kota.json'), true); ?>
                        <datalist id="add_charge">
                          <?php foreach ($hasil as $kota) { ?>
                            <option value="<?= $kota['city']; ?>"><?= $kota['admin_name'].', '.$kota['country']; ?></option>
                          <?php } ?>
                        </datalist>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Biaya Tambahan/KM (isi angka saja, ex: 10000)</label>
                        <input type="number" class="form-control" name="jumlah" autocomplete="none" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat Lengkap"><?= set_value('alamat'); ?></textarea>
                        <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi Vendor</label>
                        <textarea class="form-control" rows="3" name="deskripsi" placeholder="Deskripsi Toko"><?= set_value('deskripsi'); ?></textarea>
                        <?= form_error('deskripsi', '<div class="text-small text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>

                 <div class="row">
                   <div class="col-sm-12">
                      <div class="form-group">
                      <label for="">Jenis Vendor</label>
                      <select name="id_kategori" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      </select>
                      </div>
                   </div>
                 </div>
                 
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="level_user"  value="<?= set_value('level_user'); ?>">
                      </div>
                    </div>
                
                  </div>

                  <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          <!-- /.col -->
         
      <?= form_close(); ?>

     </div>
   </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url(); ?>template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>template/dist/js/adminlte.min.js"></script>
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

</body>
</html>
