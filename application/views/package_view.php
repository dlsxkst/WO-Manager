<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Paket</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewModal"><i class="fas fa-plus"></i> Add Paket</a></button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
  
        
        <table class="table table-hover table-striped" id="example1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Package Name</th>
                    <th>Harga</th>
                    <th>Item Product</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count=0;
                    foreach ($package->result() as $row) :
                        $count++;
                ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $row->nama_paket;?></td>
                    <td>Rp. <?= number_format($row->harga_paket);  ?></td>
                    <td><?php echo $row->item_product.' Items';?></td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm update-record" data-id_paket="<?php echo $row->id_paket;?>" data-nama_paket="<?php echo $row->nama_paket;?>">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm delete-record" data-id_paket="<?php echo $row->id_paket;?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
             
        </table>
      </div>
    </div>
  </div>
 
    <!-- Modal Add New Package-->
    <form action="<?php echo site_url('package/create');?>" method="post">
        <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Product</label>
                    <div class="col-sm-10">
                        <select class="bootstrap-select" name="product[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($product->result() as $row) :?>
                                <option value="<?php echo $row->id_barang;?>"><?php echo $row->nama_barang;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
              <!--    <div class="row">
                   <?php foreach ($product->result() as $row) :?>
                    <div class="col-sm-6">
                    
                      <div class="form-group">
                          <input type="checkbox" name="id_barang[]" value="<?= $row->id_barang; ?>">
                          <input type="hidden" name="id_vendor[]" value="<?= $row->id_vendor; ?>">
                          <label><?= $row->nama_barang ?>/<?= $row->nama_vendor ?>/Rp. <?= number_format($row->harga) ?></label>
                      </div>
                    </div>
                     <?php endforeach; ?>
                  </div> -->
                 <div class="row">
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="hidden" name="id_wo" value="<?php echo $this->session->userdata('id_wo') ?>">
                        <input class="form-control" name="nama_paket">
                      </div>
                    </div>
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Harga Paket</label>
                        <input class="form-control" name="harga_paket">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                      <label for="">Kategori</label>
                      <select name="id_kategori" id="" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="editor" cols="30" rows="5"></textarea>
                        </div>
                     </div>
                   </div>
              
 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Save</button>
              </div>
            </div>
          </div>
        </div>
    </form>
 
    <!-- Modal Update Package-->
    <form action="<?php echo site_url('package/update');?>" method="post">
        <div class="modal fade" id="UpdateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
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
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="hidden" name="id_wo" value="<?php echo $this->session->userdata('id_wo') ?>">
                        <input class="form-control" name="nama_paket">
                      </div>
                    </div>
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Harga Paket</label>
                        <input class="form-control" name="harga_paket">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                      <label for="">Kategori</label>
                      <select name="id_kategori" id="" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="editor" cols="30" rows="5"></textarea>
                        </div>
                     </div>
                   </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="edit_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
              </div>
            </div>
          </div>
        </div>
    </form>
 
 
    <!-- Modal Delete Package-->
    <form action="<?php echo site_url('package/delete');?>" method="post">
        <div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
                <h4>Are you sure to delete this package?</h4>
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="delete_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success btn-sm">Yes</button>
              </div>
            </div>
          </div>
        </div>
    </form>
 
  
   <script type="text/javascript">
        $(document).ready(function(){
            $('.bootstrap-select').selectpicker();
 
            //GET UPDATE
            $('.update-record').on('click',function(){
                var id_paket = $(this).data('id_paket');
                var nama_paket = $(this).data('nama_paket');
                $(".strings").val('');
                $('#UpdateModal').modal('show');
                $('[name="edit_id"]').val(id_paket);
                $('[name="package_edit"]').val(nama_paket);
                //AJAX REQUEST TO GET SELECTED PRODUCT
                $.ajax({
                    url: "<?php echo site_url('package/get_product_by_package');?>",
                    method: "POST",
                    data :{id_paket:id_paket},
                    cache:false,
                    success : function(data){
                        var item=data;
                        var val1=item.replace("[","");
                        var val2=val1.replace("]","");
                        var values=val2;
                        $.each(values.split(","), function(i,e){
                            $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings").selectpicker('refresh');
 
                        });
                    }
                     
                });
                return false;
            });
 
            //GET CONFIRM DELETE
            $('.delete-record').on('click',function(){
                var package_id = $(this).data('package_id');
                $('#DeleteModal').modal('show');
                $('[name="delete_id"]').val(package_id);
            });
 
        });
    </script>
</body>
</html>