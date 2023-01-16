<?php
$page_title = "Login";
$page_intro = "Admin Home";
require_once './include/function.php';


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=page_title($page_title)?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./assets/plugins/iCheck/square/blue.css">

    <script src="./assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="../assets/dist/snackbar.min.css">





    <!--    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->

</head>

<?php flash(); ?>


<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>ADMIN</b> <br> <?=WEB_TITLE?></a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="email" name="email">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="admin_login">Sign In</button>
                </div><!-- /.col -->
            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->


<!-- Modal -->


<!-- jQuery 2.1.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script src="../assets/dist/snackbar.min.js" charset="utf-8"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
