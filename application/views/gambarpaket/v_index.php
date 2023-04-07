<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Gambar Paket</h3>


                
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
                     <th>Nama Paket</th>
                     <th>Cover</th>
                     <th>Jumlah</th>
                     <th>Actions</th>
                   </tr>
                 </thead>

                 <tbody>
                  <?php $no =1; foreach ($gambarpaket as $gb) : ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td><?= $gb->nama_paket; ?></td>
                      <td class="text-center"><img src="<?= base_url('assets/gambar/'.$gb->gambar); ?>" alt="" width="100px"></td>
                      <td class="text-center"><span class="badge bg-primary"><?= $gb->total_gambar; ?></span></td>
                      <td class="text-center">
                        <a href="<?= base_url('gambarpaket/add/'. $gb->id_paket); ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"> Add Gambar</i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                 </tbody>
               </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>