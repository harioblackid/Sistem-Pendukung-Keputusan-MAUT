<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $module->name; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="assets/animate.css">
    <link rel="stylesheet" href="assets/font.css">

    <!-- jQuery 3 -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
    <script src="assets/form.js"></script>
    <script src="assets/fileinput.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
                $('#form').on('submit', function(e) {
                    e.preventDefault();
                    $(this).ajaxSubmit({
                        target: "#infoMessage",
                        success: function() {}
                    })
                })
            });
    </script>
    
    <style type="text/css">
    .login-page{
      background: #34495e;
    }
    .login-box-body{
      background: #ecf0f1;
      height: auto;
    }
    .login-logo{
      margin-bottom: 10PX;
    }
    .footer{
      text-align: center;
      margin-top: 20px;
      color: white;
    }
    .btn-success{
      background: #16a085;
    }
    .btn-danger {
      background: #c0392b;
    }
    </style>
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Login <b><?= $module->name; ?></b> System</p>
    <div id="infoMessage"></div>
    <form action='<?= "$base_url/ceklogin.php"?>' method="post" id="form">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" autofocus="">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
                <button type="submit" class="btn btn-success btn-block btn-flat">Masuk</button>
            </div>
            <!-- /.col -->
        </div>

    </form>
    
    </div>
    <!-- /.login-box-body -->
    <div class="footer">
        Copyright © <?=date('Y') ?> <?=$module->author ?> <br>All rights reserved.
    </div>
</div>
<!-- /.login-box -->

<script type="text/javascript">
    $(document).ready(function () {
      $('[data-mask]').inputmask();
            $('#form').on('submit', function(e) {
                e.preventDefault();
                $(this).ajaxSubmit({
                    target: "#infoMessage",
                    success: function() {}
                })
            })
        });
</script>
    <!-- ./wrapper -->
</body>
</html>