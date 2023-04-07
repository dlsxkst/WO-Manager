

<div class="col-sm-12">
  <?php 
    if ($this->session->flashdata('pesan')){
       echo '<div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h5><i class="icon fas fa-check"></i>';
        echo $this->session->flashdata('pesan'); 
        echo '</h5></div>';
    }
    ?>
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#belum_bayar" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Daftar WO</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#daftarvendor" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Daftar Vendor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#diproses" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Verifikasi WO</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#dikirim" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Verifikasi Vendor</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="belum_bayar" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                   <table class="table table-hover table-striped" id="example2">
                      <tr>
                        <th>#</th>
                        <th>Nama WO</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      <?php $i = 1; foreach ($user as $key => $value) { ?>
                        <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $value->nama_toko; ?></td>
                        <td><?= $value->username; ?></td>
                        <td><?= $value->email ?></td>
                        <td>
                          <?php if ($value->is_active == 1){ ?>
                           <span class="badge bg-success">Aktif</span>
                           <?php } elseif ($value->is_active == 0) { ?>
                            <span class="badge bg-danger">Non Aktif</span>
                           <?php } ?>
                        </td>
                         <td>
                          <?php if ($value->is_active == 1) { ?>
                             <button data-toggle="modal" data-target="#edit<?= $value ->id_wo ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <button data-toggle="modal" data-target="#delete<?= $value ->id_wo ?>" class="btn btn-danger btn-sm">Non-Aktif</button>
                          <?php } else { ?>
                            <button data-toggle="modal" data-target="#aktif<?= $value ->id_wo ?>" class="btn btn-primary btn-sm">Aktifkan</button>
                          <?php } ?>
                         </td>
                       
                      </tr>
                       <?php } ?>
                     </table>
                  </div>
                   <div class="tab-pane fade show" id="daftarvendor" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table table-hover table-striped" id="example2">
                      <tr>
                        <th>#</th>
                        <th>Nama Vendor</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      <?php $i = 1; foreach ($vendor as $key => $value) { ?>
                        <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $value->nama_vendor; ?></td>
                        <td><?= $value->username; ?></td>
                        <td><?= $value->email ?></td>
                         <td>
                          <?php if ($value->is_active == 1){ ?>
                           <span class="badge bg-success">Aktif</span>
                           <?php } elseif ($value->is_active == 0) { ?>
                            <span class="badge bg-danger">Non Aktif</span>
                           <?php } ?>
                        </td>
                         <td>
                          <?php if ($value->is_active == 1) { ?>
                             <button data-toggle="modal" data-target="#editvendor<?= $value ->id_vendor ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <button data-toggle="modal" data-target="#deletevendor<?= $value ->id_vendor ?>" class="btn btn-danger btn-sm">Non-Aktif</button>
                          <?php } else { ?>
                            <button data-toggle="modal" data-target="#aktifvendor<?= $value ->id_vendor ?>" class="btn btn-primary btn-sm">Aktifkan</button>
                          <?php } ?>
                         </td>
                      </tr>
                       <?php } ?>
                     </table>
                  </div>
                  <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table table-hover table-striped" id="example2">
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Nomor Rekening</th>
                        <th>Action</th>
                      </tr>
                      <?php $i = 1; foreach ($belum_verif_wo as $key => $value) { ?>
                        <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $value->nama_toko; ?></td>
                        <td><?= $value->email; ?></td>
                        <td><?= $value->no_telp; ?></td>
                        <td><?= $value->no_rek; ?></td>
                         <td>
                          
                            <a href="<?= base_url('user/verif/'.$value->id_wo); ?>" class="btn btn-primary btn-sm btn-flat">Verifikasi</a>
                        
                        </td>
                      </tr>
                       <?php } ?>
                     </table>
                  </div>
                   <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                     <table class="table table-hover table-striped" id="example2">
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Nomor Rekening</th>
                        <th>Action</th>
                      </tr>
                      <?php $i = 1; foreach ($belum_verif as $key => $value) { ?>
                        <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $value->nama_vendor; ?></td>
                        <td><?= $value->email; ?></td>
                        <td><?= $value->no_telp; ?></td>
                        <td><?= $value->no_rek; ?></td>
                         <td>
                         
                            <a href="<?= base_url('user/verif_vendor/'.$value->id_vendor); ?>" class="btn btn-primary btn-sm btn-flat">Verifikasi</a>
                    
                        </td>
                      </tr>
                       <?php } ?>
                     </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
 
      <?php foreach($user as $u) :  ?>


        <div class="modal fade" id="edit<?= $u ->id_wo ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open('user/edit/' . $u ->id_wo); ?>

                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" required="" value="<?= $u ->nama_toko ?>">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username" required="" value="<?= $u ->username ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" required="" value="<?= $u ->email ?>">
                </div>

                <div class="form-group">
                    <label>Level User</label>
                    <select name="level_user" class="form-control">
                      <option value="2">Wedding Organizer</option>
                      <option value="3">Vendor</option>
                    </select>
                </div>
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
             <?php echo form_close(); ?>
          </div>

        </div>
    
      </div>
<?php endforeach;  ?>


<?php foreach($user as $u) :  ?>
        <div class="modal fade" id="delete<?= $u ->id_wo ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $u->nama_toko; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <h6>Apakah Anda yakin akan menonaktifkan akun ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('user/delete/'. $u->id_wo); ?>" class="btn btn-danger">Non-Aktif</a>
            </div>
             
          </div>
          
        </div>
        
      </div>
      
<?php endforeach;  ?>

<?php foreach($user as $u) :  ?>
        <div class="modal fade" id="aktif<?= $u ->id_wo ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Aktifkan <?= $u->nama_toko; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <h6>Apakah Anda yakin akan mengaktifkan akun ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('user/aktif/'. $u->id_wo); ?>" class="btn btn-primary">Aktif</a>
            </div>
             
          </div>
          
        </div>
        
      </div>
      
<?php endforeach;  ?>

 <?php  foreach($vendor as $u) :  ?>


        <div class="modal fade" id="editvendor<?= $u ->id_vendor ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Vendor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open('user/edit_vendor/' . $u ->id_vendor); ?>

                <div class="form-group">
                    <label>Nama Vendor</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required="" value="<?= $u ->nama_vendor ?>">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username" required="" value="<?= $u ->username ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" required="" value="<?= $u ->email ?>">
                </div>

                <div class="form-group">
                    <label>Jenis Vendor</label>
                    <select name="id_kategori" class="form-control">
                      <option value="<?= $u->id_kategori; ?>"><?= $u->id_kategori; ?></option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
             <?php echo form_close(); ?>
          </div>

        </div>
    
      </div>
<?php endforeach;  ?>


<?php foreach($vendor as $u) :  ?>
        <div class="modal fade" id="deletevendor<?= $u ->id_vendor ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $u->nama_vendor; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <h6>Apakah Anda yakin akan menonaktifkan akun ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('user/delete_vendor/'. $u->id_vendor); ?>" class="btn btn-danger">Non-aktif</a>
            </div>
             
          </div>
          
        </div>
        
      </div>
      
<?php endforeach;  ?>

<?php foreach($vendor as $u) :  ?>
        <div class="modal fade" id="aktifvendor<?= $u ->id_vendor ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Aktifkan <?= $u->nama_vendor; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <h6>Apakah Anda yakin akan mengaktifkan akun ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('user/aktif_vendor/'. $u->id_vendor); ?>" class="btn btn-primary">Aktif</a>
            </div>
             
          </div>
          
        </div>
        
      </div>
      
<?php endforeach;  ?>

