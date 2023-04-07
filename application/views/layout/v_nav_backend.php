<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin'); ?>" class="brand-link text-center">
      <i class="fa fa-building"></i><span class="brand-text font-weight-light"> WO-MANAGER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if ($this->session->userdata('level_user') == 1) { ?>
          <img src="<?= base_url('assets/foto/'.$this->session->userdata('gambar')); ?>" class="img-circle elevation-2">
          <?php } elseif ($this->session->userdata('level_user') == 2) { ?>
           <img src="<?= base_url('assets/foto/'.$this->session->userdata('gambar')); ?>" class="img-circle elevation-2">
           <?php } elseif ($this->session->userdata('level_user') == 3) { ?>
          <img src="<?= base_url('assets/foto/'.$this->session->userdata('gambar')); ?>" class="img-circle elevation-2">
         <?php } ?>
        </div>
        <div class="info">
          <?php if ($this->session->userdata('level_user') == 1) { ?>
           <a href="#" class="d-block"><?= $this->session->userdata('nama_user'); ?></a>
          <?php } elseif ($this->session->userdata('level_user') == 2) { ?>
           <a href="#" class="d-block"><?= $this->session->userdata('nama_toko'); ?></a>
           <?php } elseif ($this->session->userdata('level_user') == 3) { ?>
           <a href="#" class="d-block"><?= $this->session->userdata('nama_vendor'); ?></a>
         <?php } ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

       
          <?php if ($this->session->userdata('level_user') == 1) { ?>
             <li class="nav-item">
            <a href="<?= base_url('admin'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'admin' and $this->uri->segment(2)== "") echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('kategori'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'kategori') echo 'active'; ?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/transaksi'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'transaksi' and $this->uri->segment(2)== "admin") echo 'active'; ?>">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('admin/backup'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'backup' and $this->uri->segment(2)== "admin") echo 'active'; ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Backup Data
              </p>
            </a>
          </li>

          
           <li class="nav-item">
            <a href="<?= base_url('user'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'user') echo 'active'; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('auth/logout_admin'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          
           <?php } elseif ($this->session->userdata('level_user') == 2) { ?>
             <li class="nav-item">
            <a href="<?= base_url('am'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'am' and $this->uri->segment(2)== "") echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('am/paket'); ?>" class="nav-link  <?php if($this->uri->segment(1) == 'paket' and $this->uri->segment(2)== "am") echo 'active'; ?>">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Paket
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('gambarpaket'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'gambarpaket') echo 'active'; ?>">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Gambar Paket
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('am/chat_pelanggan'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'chat_pelanggan' and $this->uri->segment(1) == 'am') echo 'active'; ?>">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Chat Pelanggan
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('am/chat_vendor'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'chat_vendor' and $this->uri->segment(1) == 'am') echo 'active'; ?>">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Chat Vendor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('am/pesanan_masuk'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'pesanan_masuk' and $this->uri->segment(1) == 'am') echo 'active'; ?>">
              <i class="nav-icon fas fa-download"></i>
              <p>
                Pesanan Masuk
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?= base_url('am/gallery'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'gallery' and $this->uri->segment(1) == 'am') echo 'active'; ?>">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('laporan'); ?>" class="nav-link  <?php if($this->uri->segment(1) == 'laporan') echo 'active'; ?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('am/kerjasama'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'kerjasama' and $this->uri->segment(1) == 'am') echo 'active'; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Kerjasama
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('am/profile'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'profile' and $this->uri->segment(2)== "am") echo 'active'; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('auth/logout_wo'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <?php } elseif ($this->session->userdata('level_user') == 3) { ?>
             <li class="nav-item">
            <a href="<?= base_url('vendor'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'admin' and $this->uri->segment(2)== "") echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?= base_url('barang'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'barang') echo 'active'; ?>">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Produk
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('gambarbarang'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'gambarbarang') echo 'active'; ?>">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Gambar Produk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('vendor/chat_pelanggan'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'chat_pelanggan' and $this->uri->segment(1) == 'vendor') echo 'active'; ?>">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Chat Pelanggan
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('vendor/chat_wo'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'chat_wo' and $this->uri->segment(1) == 'vendor') echo 'active'; ?>">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Chat WO
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('vendor/pesanan_masuk'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'pesanan_masuk' and $this->uri->segment(1) == 'vendor') echo 'active'; ?>">
              <i class="nav-icon fas fa-download"></i>
              <p>
                Pesanan Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('vendor/gallery'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'gallery' and $this->uri->segment(1) == 'vendor') echo 'active'; ?>">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?= base_url('vendor/kerjasama'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'kerjasama' and $this->uri->segment(1) == 'vendor') echo 'active'; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Kerjasama
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('laporan/laporan_vendor'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'laporan_vendor' and $this->uri->segment(1) == 'laporan') echo 'active'; ?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
           <!-- <li class="nav-item">
            <a href="<?= base_url('vendor/setting'); ?>" class="nav-link  <?php if($this->uri->segment(2) == 'setting' and $this->uri->segment(1) == 'vendor') echo 'active'; ?>">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Setting
              </p>
            </a>
          </li> -->
           <li class="nav-item">
            <a href="<?= base_url('vendor/profile'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'profile' and $this->uri->segment(2)== "vendor") echo 'active'; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('auth/logout_vendor'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

          <?php } ?>
           

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
       
