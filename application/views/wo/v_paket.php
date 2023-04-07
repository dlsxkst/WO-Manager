
<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Paket</h3>
                <div class="card-tools">
                 <a href="<?= base_url('am/add_paket'); ?>" class="btn btn-primary btn-sm" >
                    <i class="fas fa-plus"></i> Add Paket</a>
                 </button><br/>   
                </div>
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
                ?>
               <table class="table table-hover table-striped" id="example1">
                 <thead class="text-center">
                   <tr>
                     <th>#</th>
                     <th>Nama Paket</th>
                     <th>Harga</th>
                     <th>Kapasitas</th>
                     <th>Item Product</th>
                     <th>Gambar</th>
                     <th>Actions</th>
                   </tr>
                 </thead>

                 <tbody>
                  <?php $no = 1; ?>
                  <?php foreach($paket->result() as $k) :  ?>
                   <tr>
                     <td class="text-center"><?= $no++ ?></td>
                     <td><?= $k->nama_paket ?></td>
                     <td>Rp. <?= number_format($k->harga_paket, 0, ",",".") ?></td>
                     <td><?= $k->kapasitas;  ?> Pax</td>
                     <td><?php echo $k->item_product.' Items';?></td>
                     <td class="text-center"><img src="<?= base_url('assets/gambar/'.$k->gambar); ?>" alt="" width="150px"></td>
                     <td class="text-center">
                       <a href="<?= base_url('am/edit/'.$k->id_paket); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                       <button data-toggle="modal" data-target="#delete<?= $k->id_paket ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                     </td>
                   </tr>
                  <?php endforeach;   ?>
                   <?php foreach($package->result() as $k) :  ?>
                   <tr>
                     <td class="text-center"><?= $no++ ?></td>
                     <td><?= $k->nama_paket ?></td>
                     <td>Rp. <?= number_format($k->harga_paket, 0, ",",".") ?></td>
                     <td><?= $k->kapasitas;  ?> Pax</td>
                     <td>0 Items</td>
                     <td class="text-center"><img src="<?= base_url('assets/gambar/'.$k->gambar); ?>" alt="" width="150px"></td>
                     <td class="text-center">
                       <a href="<?= base_url('am/edit/'.$k->id_paket); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                      <!--  <a href="<?= base_url('am/delete/'. $k->id_paket); ?>" class="btn btn-danger btn-sm" onclick="confirm('Apakah Anda yakin akan menghapus data ini?');"><i class="fas fa-trash"></i></a> -->
                       <button data-toggle="modal" data-target="#delete<?= $k->id_paket ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button> 
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

      <?php foreach($paket->result() as $k) :  ?>
        <div class="modal fade" id="delete<?= $k->id_paket ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $k->nama_paket; ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <h6>Apakah Anda yakin akan menghapus data ini?</h6>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('am/delete/'. $k->id_paket); ?>" class="btn btn-danger">Delete</a>
            </div>
             
          </div>
        </div>
     
      </div>
<?php endforeach;  ?>

