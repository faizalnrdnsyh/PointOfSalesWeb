<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Point Of Sales - <?=ucfirst($this->uri->segment(1))?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/sweetalert/sweetalert.css">
  <link rel="shortcut icon" href="<?=base_url()?>assets/dist/img/UnikLogo-title.png">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed accent-teal <?=$this->uri->segment(1) == 'penjualan' ? 'sidebar-collapse' : null ?>">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php if($this->fungsi->user_login()->level == 1) { ?>
    <nav class="main-header navbar navbar-expand navbar-dark ">
  <?php } else {?>
    <nav class="main-header navbar navbar-expand navbar-light navbar-teal">
  <?php } ?>
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- User Dropdown Menu -->
		<li class="dropdown user user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
				<span class="hidden-xs"><?=ucfirst($this->fungsi->user_login()->nama_pengguna)?></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<li class="user-header bg-teal">
					<img src="<?=base_url()?>assets/dist/img/user-profile2.jpg" class="img-circle elevation-2" alt="User Image">
					<p><?=ucfirst($this->fungsi->user_login()->nama)?>
						<small><?=$this->fungsi->user_login()->alamat?></small>
					</p>
				</li>
				<li class="user-footer">
					<div>
						<a href="<?=site_url('profil/'.$this->session->userdata('userid'))?>" class="btn btn-default float-left">Profil</a>
					</div>
					<div>
						<a href="<?=site_url('auth/logout')?>" id="btn-logout" class="btn btn-danger float-right">Keluar</a>
					</div>
				</li>
			</ul>
		</li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="<?=site_url('dashboard')?>" class="brand-link navbar-teal">
      <img src="<?=base_url()?>assets/dist/img/UnikPosLogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-bold">Point</span>
      <span class="brand-text font-weight-light">Of Sales</span>
    </a>

  <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>assets/dist/img/user-profile2.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?=site_url('profil/'.$this->session->userdata('userid'))?>" class="d-block"><?=$this->fungsi->user_login()->nama?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?=site_url('dashboard')?>" class="nav-link 
              <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : ''?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if($this->fungsi->user_login()->level == 1) { ?>
           <li class="nav-item">
            <a href="<?=site_url('pemasok')?>" class="nav-link 
              <?=$this->uri->segment(1) == 'pemasok' ? 'active' : ''?>">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Pemasok
              </p>
            </a>
          </li>
          <?php } ?>
           <li class="nav-item">
            <a href="<?=site_url('pelanggan')?>" class="nav-link 
              <?=$this->uri->segment(1) == 'pelanggan' ? 'active' : ''?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pelanggan
              </p>
            </a>
          </li>
          <?php if($this->fungsi->user_login()->level == 1) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?=$this->uri->segment(1) == 'kategori' ||
            $this->uri->segment(1) == 'satuan' ||
            $this->uri->segment(1) == 'barang' ? 'active' : ''?>">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Produk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('kategori')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'kategori' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('satuan')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'satuan' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Satuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('barang')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'barang' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?=$this->uri->segment(1) == 'penjualan' ||
            $this->uri->segment(1) == 'stok' ? 'active' : ''?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('penjualan')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'penjualan' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('stok/masuk')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'masuk' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('stok/keluar')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'stok' && $this->uri->segment(2) == 'keluar' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok Keluar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?=$this->uri->segment(1) == 'laporan' ? 'active' : ''?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('laporan/penjualan')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'penjualan' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('laporan/stok')?>" class="nav-link 
                  <?=$this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'stok' ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok</p>
                </a>
              </li>
            </ul>
          </li>
          </li>
          <?php if($this->fungsi->user_login()->level == 1) { ?>
           <li class="nav-item">
            <a href="<?=site_url('pengguna')?>" class="nav-link  <?=$this->uri->segment(1) == 'pengguna' ? 'active' : ''?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
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

<!-- jQuery -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php echo $contents ?>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2021</strong> by <strong><a href="">faizalnrdnsyh</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url()?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<!-- SweetAlert -->
<script src="<?=base_url()?>assets/plugins/sweetalert/sweetalert.js"></script>


<script>
   // SweetAlert2
  var flash = $('#flash').data('flash');
  if(flash){
    swal({
      type: 'success',
      title: flash,
      showConfirmButton: false,
      timer: 2000
    })
  }
  var flash = $('#flash-warning').data('flash');
  if(flash){
    swal({
      type: 'warning',
      title: flash,
    })
  }
  var flash = $('#flash-error').data('flash');
  if(flash){
    swal({
      type: 'error',
      title: flash,
    })
  }

  $(document).on('click','#btn-hapus',function(e){
    e.preventDefault()
    var href = $(this).attr('href')
    swal({
      title: "Anda yakin menghapus data ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, hapus!",
      cancelButtonText: "Tidak",
      closeOnConfirm: false,
    },
    function(isConfirm) {
      if (isConfirm) {
        window.location = href
      }
    });
  })

  $(document).on('click','#btn-logout, #btn-profil',function(e){
    e.preventDefault()
    var href = $(this).attr('href')
    swal({
      title: "Anda yakin ingin keluar?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Keluar",
      cancelButtonText: "Tidak",
      closeOnConfirm: false,
    },
    function(isConfirm) {
      if (isConfirm) {
        window.location = href
      }
    });
  })

  // DataTables
  $(document).ready(function() {
    $('#table1').DataTable({
      "responsive": true,
      "autoWidth": false,
      "columnDefs": [
        {
          "targets":[-1],
          "orderable": false
        }
      ]
    });
  });
</script>

</body>
</html>

