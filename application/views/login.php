<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UNIK POS | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- SweetAlert -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/sweetalert/sweetalert.css">
  <link rel="shortcut icon" href="<?=base_url()?>assets/dist/img/UnikLogo-title.png">

</head>
<body class="hold-transition login-page accent-teal">

<div id="flash-error" data-flash="<?=$this->session->flashdata('kesalahan');?>"></div>

<div class="login-box">
  <div class="login-logo">
    <a href="<?=site_url('auth/login')?>"><b>UNIK</b> Point Of Sales</a>
  </div>
  <!-- /.login-logo -->

  <div class="card">
    <div class="card-body login-card-body">
	<!-- <p class="login-box-msg">Login untuk masuk</p> -->

      <form action="<?=site_url('auth/process')?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Nama Pengguna" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4 offset-8">
            <button type="submit" name="login" class="btn btn-block btn-primary">Masuk</button>
          </div>
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- SweetAlert -->
<script src="<?=base_url()?>assets/plugins/sweetalert/sweetalert.js"></script>

</body>
</html>

<script>
  var flash = $('#flash-error').data('flash');
  if(flash){
    swal({
      type: 'error',
      title: 'Login Gagal',
      text: flash,
    })
  }
</script>