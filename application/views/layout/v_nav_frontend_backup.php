<!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="<?= base_url(); ?>" class="navbar-brand">
       <i class="fas fa-store"></i>
        <span class="brand-text font-weight-light"><b>WO-MANAGER</b></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?= base_url(); ?>" class="nav-link">Home</a>
          </li>

          <?php $kategori = $this->m_home->get_all_data_kategori(); ?>

           <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kategori</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <?php foreach($kategori as $k) : ?>
              <li><a href="<?= base_url('home/kategori/'.$k->id_kategori); ?>" class="dropdown-item"><?= $k->nama_kategori; ?> </a></li>
              <?php endforeach; ?>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('home/produk'); ?>" class="nav-link">Produk</a>
          </li>

             <li class="nav-item">
            <a href="<?= base_url('home/toko'); ?>" class="nav-link">Toko</a>
          </li>

        </ul>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <?php
            $id_pelanggan = $this->session->userdata('id_pelanggan');
            $jumlah_pesan = $this->db->query("SELECT * FROM `tb_pesan` WHERE id_penerima='$id_pelanggan'")->num_rows();
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-comments"></i>
              <span class="badge badge-danger navbar-badge"><?= $jumlah_pesan; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <ul class="contacts-list bg-info">
                <?php
                  $daftar_wo = $this->db->query("SELECT * FROM `tb_wo` WHERE is_active=1");
                  foreach ($daftar_wo->result_array() as $dw) {
                    $id_wo = $dw['id_wo'];
                    $get_pesan = $this->db->query("SELECT * FROM `tb_pesan` WHERE id_pengirim='$id_pelanggan' AND id_penerima='$id_wo' ORDER BY id DESC");
                    if ($get_pesan->row_array() > 0) {
                      $row_pesan = $get_pesan->row_array();
                ?>
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="<?= base_url('assets/foto/'.$dw['gambar']); ?>" alt="User Avatar">
                          <div class="contacts-list-info">
                            <span class="contacts-list-name"><?= $dw['nama_toko']; ?><small class="contacts-list-date float-right"><?= $row_pesan['waktu']; ?></small></span>
                            <span class="contacts-list-msg"><?= $row_pesan['pesan']; ?></span>
                          </div>
                        </a>
                      </li>
                <?php
                    }
                  }
                ?>
              </ul>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('chat'); ?>" class="dropdown-item dropdown-footer">View All Chat</a>
            </div>

        <?php 
        $keranjang = $this->m_transaksi->keranjang();
        $jml_item = 0;
        $total =  0;
        foreach ($keranjang as $key => $value) {
          $jml_item = $jml_item + $value->qty;
        } ?>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-danger navbar-badge"><?= $jml_item; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php if (empty($keranjang)) { ?>
              <a href="#" class="dropdown-item">
                <p>Cart empty.</p>
              </a>
            <?php }else{ 
              foreach ($keranjang as $key => $value) { 
              $barang = $this->m_home->detail_barang($value->id_barang);
              $paket = $this->m_home->detail_paket($value->id_barang);
              $subtotal = $value->qty * $value->price;
              $total = $total + $subtotal;
              
            ?>

            <a href="#" class="dropdown-item">

              <div class="media">
              <!--   <img src="<?= base_url('assets/gambar/'.$barang->gambar); ?>" alt="User Avatar" class="img-size-50 mr-3"> -->
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?= $value->name; ?>
                  </h3>
                  <p class="text-sm"><?= $value->qty; ?> x Rp. <?= number_format($value->price, 0, ',', '.'); ?> </p>
                  <p class="text-sm text-muted"><i class="fa fa-calculator"></i> Rp. <?= number_format($subtotal); ?></p>
                </div>
              </div>
              
            </a>
            <div class="dropdown-divider"></div>
            <?php } ?>

              <div class="dropdown-divider"></div>
             <a href="#" class="dropdown-item">

              <div class="media">
                <div class="media-body">
                 <tr>
                   <td colspan="2"></td>
                   <td class="right"><strong>Total: </strong></td>
                   <td class="right">Rp. <?= number_format($total); ?></td>
                 </tr>
                </div>
              </div>
              
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('belanja'); ?>" class="dropdown-item dropdown-footer">View Cart</a>
            <a href="<?= base_url('midtrans/snap'); ?>" class="dropdown-item dropdown-footer">Check-out</a>
          
            <?php }?>

            </div>
        </li>

          

         <div class="ml-3 mr-2 font-weight-light" style="font-size: 150%">|</div>

         <li class="nav-item">
          <?php if ($this->session->userdata('id_pelanggan') == '') { ?>
             <a href="<?= base_url('auth/login'); ?>"  class="nav-link">
             <img src="<?= base_url(); ?>assets/foto/default.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">
             <span class="brand-text font-weight-light">Login/Register</span>
          </a>
          <?php } else { ?>
           <a href="#" data-toggle="dropdown" class="nav-link">
             <img src="<?= base_url('assets/foto/'.$this->session->userdata('foto')); ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
             <span class="brand-text font-weight-light"><?= $this->session->userdata('nama_pelanggan'); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('pelanggan/akun'); ?>" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Akun Saya
            </a>
            <div class="dropdown-divider"></div>
             <a href="<?= base_url('pelanggan/changepass'); ?>" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Ganti Password
            </a>
             <div class="dropdown-divider"></div>
            <a href="<?= base_url('pesanan_saya'); ?>" class="dropdown-item">
              <i class="fas fa-shopping-cart mr-2"></i>Pesanan Saya
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
          </div>
          <?php } ?>
        </li>
        
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> <?= $title; ?> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">WO Manager</a></li>
              <li class="breadcrumb-item"><a href="#"><?= $title; ?></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">

