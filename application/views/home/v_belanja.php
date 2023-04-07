 <div class="card card-solid">
	<div class="card-body pb-0">
		<div class="row">
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
			</div>
			<div class="col-sm-12">	


			<table class="table" cellpadding="6" cellspacing="1" style="width:100%" >

			<tr>

			        <th>Nama Produk</th>
			        <th>Harga</th>
			        <th >Sub-Total</th>
			        <th >Action</th>
			</tr>

			<?php 
			$total = 0;
			foreach ($keranjang as $items) {
				$subtotal = $items->qty * $items->price;
				$total = $total + $subtotal;
			 ?>

			        <tr>
			                <td><?php echo $items->name; ?></td>
			                <td >Rp. <?php echo number_format($items->price); ?></td>
			                <td >Rp. <?php echo number_format($subtotal); ?></td>
			                <td >
			                	<a href="<?= base_url('belanja/delete/'.$items->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
			                </td>
			        </tr>
			 <?php } ?>
		

			<tr>
			        <td class="right"><strong>Total</strong></td>
			        <td></td>
			        <td class="right"><strong>Rp. <?php echo number_format($total); ?></strong></td>
			        <td></td>

			</tr>

			</table>
			
			<a href="<?= base_url('belanja/clear/')?>" class="btn btn-danger btn-flat"><i class="fa fa-recycle"> Clear Cart</i></a>

			
			<a href="<?= base_url('snap'); ?>" class="btn btn-success btn-flat"><i class="fa fa-check-square"> Check-out</i></a>
				

			<br><br>

				</div>
				
			</div>
		</div>
	</div>
</div>