<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Backup</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="<?= base_url('admin/backup_data');  ?>" title="Backup Database" class="btn btn-info"><i class="fas fa-download"></i> Klik Untuk Backup Database</a>
              </div>
            
            </div>
          </div>

<!-- <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Restore</h3>
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
                <?php echo form_open_multipart('admin/restore'); ?>
                  <div class="row">
                    <div class="col-6">
                       <div class="form-group">
                        <label>Pilih File *.sql</label>
                        <input type="file" name="datafile" title="Pilih File" class="form-control"> <br>
                      </div>
                    </div>
                    <div class="col-6">
                     <div class="form-group">
                        <label>Klik untuk Restore</label> <br>
                        <input type="submit" value="Restore Database" class="btn btn-info">
                     </div>
                    </div>
                  </div>
                <?= form_close();  ?>
              </div>
             
            </div>
            
</div> -->
          <!-- /.col -->


