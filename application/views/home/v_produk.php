<div class="card card-solid">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">Cari Produk</h2>
            <?= form_open('home/search'); ?>
                <div class="row">
                    <div class="col-md-10 offset-md-1">

                        
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" name="keyword" placeholder="Type your keywords here">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?= form_close(); ?>
            <?= form_open('home/pencarian/');  ?>
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Kota</label>
                                      <input list="kota" type="text" class="form-control" name="kota" autocomplete="none" placeholder="Pilih Kota" required>
                                     <datalist id="kota">
                                      <?php foreach ($kota as $k) { ?>
                                        <option value="<?= $k->nama; ?>"><?= $k->nama; ?></option>
                                      <?php } ?>
                                    </datalist>
                                  <!--   <select class="form-control" name="kota" style="width: 100%;" required="">
                                        <option value="">-- Pilih Kota --</option>
                                        <?php 
                                              foreach($kota as $prov)
                                              {
                                                echo '<option value="'.$prov->nama.'">'.$prov->nama.'</option>';
                                              }
                                            ?>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Kategori:</label>
                                    <select class=" form-control" name="kategori" style="width: 100%;" required="">
                                        <option value="">--Pilih Kategori--</option>
                                        <?php foreach($kategori as $k) : ?>
                                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                             <div class="col-3">
                                <div class="form-group">
                                    <label>Harga From:</label>
                                    <select class=" form-control" name="harga_from" style="width: 100%;" required="">
                                        <option value="">--Pilih Harga--</option>
                                        <option value="1000000">Rp. 1.000.000</option>
                                        <option value="2500000">Rp. 2.500.000</option>
                                        <option value="5000000">Rp. 5.000.000</option>
                                        <option value="7500000">Rp. 7.500.000</option>
                                        <option value="10000000">Rp. 10.000.000</option>
                                        <option value="15000000">Rp. 15.000.000</option>
                                        <option value="20000000">Rp. 20.000.000</option>
                                        <option value="25000000">Rp. 25.000.000</option>
                                        <option value="50000000">Rp. 50.000.000</option>
                                        <option value="75000000">Rp. 75.000.000</option>
                                        <option value="100000000">Rp. 100.000.000</option>
                                        <option value="150000000">Rp. 150.000.000</option>
                                        <option value="200000000">Rp. 200.000.000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Kapasitas From:</label>
                                    <select class=" form-control" name="kapasitas_from" style="width: 100%;" required="">
                                        <option value="">--Pilih Kapasitas--</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                       <option value="200">200</option>
                                       <option value="300">300</option>
                                       <option value="400">400</option>
                                       <option value="500">500</option>
                                       <option value="600">600</option>
                                       <option value="700">700</option>
                                       <option value="800">800</option>
                                       <option value="900">900</option>
                                       <option value="1000">1000</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-1">
                               
                                    <div class="form-group">
                                      <label style="visibility: hidden;">search</label>
                                      <input type="submit" class="btn btn-default form-control" value="Cari">
                                    </div>
                                
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label style="visibility: hidden;">Sort Order:</label>
                                    <input type="hidden" name="">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label style="visibility: hidden;">Kategori:</label>
                                   <input type="hidden" name="">
                                </div>
                            </div>
                             <div class="col-3">
                                <div class="form-group">
                                    <label>To:</label>
                                    <select class=" form-control" name="harga_to" style="width: 100%;" required="">
                                        <option value="">--Pilih Harga--</option>
                                      <option value="1000000">Rp. 1.000.000</option>
                                        <option value="2500000">Rp. 2.500.000</option>
                                        <option value="5000000">Rp. 5.000.000</option>
                                        <option value="7500000">Rp. 7.500.000</option>
                                        <option value="10000000">Rp. 10.000.000</option>
                                        <option value="15000000">Rp. 15.000.000</option>
                                        <option value="20000000">Rp. 20.000.000</option>
                                        <option value="25000000">Rp. 25.000.000</option>
                                        <option value="50000000">Rp. 50.000.000</option>
                                        <option value="75000000">Rp. 75.000.000</option>
                                        <option value="100000000">Rp. 100.000.000</option>
                                        <option value="150000000">Rp. 150.000.000</option>
                                        <option value="200000000">Rp. 200.000.000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>To:</label>
                                    <select class=" form-control" name="kapasitas_to" style="width: 100%;" required="">
                                        <option value="">--Pilih Kapasitas--</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                       <option value="200">200</option>
                                       <option value="300">300</option>
                                       <option value="400">400</option>
                                       <option value="500">500</option>
                                       <option value="600">600</option>
                                       <option value="700">700</option>
                                       <option value="800">800</option>
                                       <option value="900">900</option>
                                       <option value="1000">1000</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-1">
                               
                                    <div class="form-group">
                                      <label style="visibility: hidden;">search</label>
                                      <input type="hidden" class="btn btn-default form-control">
                                    </div>
                                
                            </div>
                        </div>
                        <?= form_close();  ?>
               </div>
          </div>
        </div>
    </section>


            
              <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                  <?php foreach ($barang as $b) : ?>
                   <div class="col-sm-4 d-flex align-items-stretch">
                     <?php 
                      echo form_open('belanja/add');
                      echo form_hidden('id', $b->id_barang);
                      echo form_hidden('qty', 1);
                      echo form_hidden('price', $b->harga);
                      echo form_hidden('name', $b->nama_barang);
                      echo form_hidden('redirect_page', str_replace('index.php/',' ', current_url()));
                     ?>
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0 text-center">
                        <h2 class="lead"><b><?= $b->nama_barang; ?></b></h2>
                        <p class="text-muted text-sm"><b>Kategori: </b> <?= $b->nama_kategori; ?> </p>
                        <i class="fa fa-map-marker"> <?= $b->kab;  ?></i>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12 text-center">
                            <img src="<?= base_url('assets/gambar/'.$b->gambar); ?>" class="img-flat" width="300px" height="200px" >
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="text-left">
                              <h4><span class="badge bg-primary">Rp. <?= number_format($b->harga, 0, ',', '.') ?></span></h4>
                            </div>
                          </div>
                        
                        
                          <div class="col-sm-6">
                            <div class="text-right">
                            <a href="<?= base_url('home/detail_barang/'. $b->id_barang); ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-eye"> </i>
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                              <i class="fas fa-shopping-cart"></i> Add
                            </button>
                          </div>
                          </div>
                  </div>
                </div>
              </div>
              <?php echo form_close(); ?>
            </div>
          <?php endforeach; ?>
           <?php foreach ($paket as $b) : ?>
                   <div class="col-sm-4 d-flex align-items-stretch">
                     <?php 
                      echo form_open('belanja/add');
                      echo form_hidden('id', $b->id_paket);
                      echo form_hidden('qty', 1);
                      echo form_hidden('price', $b->harga_paket);
                      echo form_hidden('name', $b->nama_paket);
                      echo form_hidden('redirect_page', str_replace('index.php/',' ', current_url()));
                     ?>
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0 text-center">
                        <h2 class="lead"><b><?= $b->nama_paket; ?></b></h2>
                        <p class="text-muted text-sm"><b>Kategori: </b> <?= $b->nama_kategori; ?> </p>
                        <i class="fa fa-map-marker"> <?= $b->kab;  ?></i>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-12 text-center">
                            <img src="<?= base_url('assets/gambar/'.$b->gambar); ?>" class="img-flat" width="300px" height="200px" >
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="text-left">
                              <h4><span class="badge bg-primary">Rp. <?= number_format($b->harga_paket, 0, ',', '.') ?></span></h4>
                            </div>
                          </div>
                        
                        
                          <div class="col-sm-6">
                            <div class="text-right">
                            <a href="<?= base_url('home/detail_paket/'. $b->id_paket); ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-eye"> </i>
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                              <i class="fas fa-shopping-cart"></i> Add
                            </button>
                          </div>
                          </div>
                  </div>
                </div>
              </div>
              <?php echo form_close(); ?>
            </div>
          <?php endforeach; ?>
         
      </div>
    </div>
</div>
</div>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Barang berhasil ditambahkan ke keranjang.'
      })
    });
   });
</script>
<script>
    $(function () {
      $('.select2').select2()
    });
</script>