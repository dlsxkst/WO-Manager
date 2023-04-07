<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data User</h3>


                <div class="card-tools">
                  <button type="button" data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm" >
                    <i class="fas fa-plus"></i> Add User</button>
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
                ?>
               <table class="table table-hover table-striped" id="example1">
                 <thead class="text-center">
                   <tr>
                     <th>#</th>
                     <th>Nama User</th>
                     <th>Email</th>
                     <th>Alamat</th>
                     <th>Actions</th>
                   </tr>
                 </thead>

                 <tbody>
                  <?php $no=1; foreach($vendor as $u) :  ?>
                   <tr>
                     <td class="text-center"><?= $no++ ?></td>
                     <td><?= $u->nama_vendor ?></td>
                     <td class="text-center"><?= $u->email ?></td>
                     <td class="text-center"><?= $u->alamat; ?>
                     </td>
                     <td class="text-center">
                       <button data-toggle="modal" data-target="#edit<?= $u ->id_vendor ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button data-toggle="modal" data-target="#delete<?= $u ->id_vendor ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                     </td>
                   </tr>
                  <?php endforeach;   ?>
                 </tbody>
               </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

      <div class="modal fade" id="add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Vendor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open('uservendor/add'); ?>

                <div class="form-group">
                    <label>Nama Vendor</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required="">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username" required="">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" required="">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" required="">
                </div>

                <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" cols="5" rows="5"></textarea>
                </div>

                <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" cols="5" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" required="">
                </div>

                 <div class="form-group">
                    <label>Nomor Rekening</label>
                    <input type="text" class="form-control" id="no_rek" name="no_rek" required="">
                </div>

                <div class="form-group">
                    <label>Level User</label>
                    <select name="level_user" class="form-control">
                      <option value="3" selected="">Vendor</option>
                    </select>
                </div>

                <div class="form-group">
                      <label for="">Jenis Vendor</label>
                      <select name="id_kategori" id="id_kategori" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      <option value="Lainnya">Lainnya</option>
                      </select>
                </div>
              
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
             <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<?php foreach($vendor as $u) :  ?>
        <div class="modal fade" id="edit<?= $u ->id_vendor ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Vendor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open('uservendor/edit/' . $u ->id_vendor); ?>

               <div class="form-group">
                    <label>Nama Vendor</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?= $u->nama_vendor; ?>">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $u->username; ?>">
                </div>


                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $u->email; ?>">
                </div>

                <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" cols="5" rows="5"><?= $u->alamat; ?></textarea>
                </div>

                 <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" cols="5" rows="5"><?= $u->deskripsi; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $u->no_telp; ?>">
                </div>

                 <div class="form-group">
                    <label>Nomor Rekening</label>
                    <input type="text" class="form-control" id="no_rek" name="no_rek" value="<?= $u->no_rek; ?>">
                </div>

                <div class="form-group">
                    <label>Level User</label>
                    <select name="level_user" class="form-control">
                      <option value="3" selected="">Vendor</option>
                    </select>
                </div>

                <div class="form-group">
                      <label for="">Jenis Vendor</label>
                      <select name="id_kategori" id="id_kategori" class="form-control">
                        <option value="<?= $u->id_kategori; ?>"><?= $u->id_kategori; ?></option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      <option value="Lainnya">Lainnya</option>
                      </select>
                </div>
               
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
             <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach;  ?>


<?php foreach($vendor as $u) :  ?>
        <div class="modal fade" id="delete<?= $u ->id_vendor ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $u->nama_vendor; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <h6>Apakah Anda yakin akan menghapus data ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('uservendor/delete/'. $u->id_vendor); ?>" class="btn btn-danger">Delete</a>
            </div>
             
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach;  ?>

<script>
  function cek_id_kategori(obj){
    var value = obj.value;
    if(value == "Lainnya"){
      $("#kategori").style.display="block";
    }
  }
</script>