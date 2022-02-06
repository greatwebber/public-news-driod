<?php
$page_title = "Home";
require_once './include/config.php';


//exit();
require_once './layouts/header.php';

?>

<?php flash(); ?>

<!-- Login Text-->
<div class="login-text text-center"><img class="login-img" src="./assets/img/bg-img/12.png" alt="">
    <h3 class="mb-0">Welcome Back!</h3>
    <!-- Shapes-->
    <div class="bg-shapes">
        <div class="shape1"></div>
        <div class="shape2"></div>
        <div class="shape3"></div>
        <div class="shape4"></div>
        <div class="shape5"></div>
        <div class="shape6"></div>
        <div class="shape7"></div>
        <div class="shape8"></div>
    </div>
</div>
<!-- Register Form-->
<div class="register-form mt-5 px-3">
    <form  method="post">
        <div class="form-group text-left mb-4">
            <label for="Email"><i class="lni lni-user"></i></label>
            <input class="form-control" id="username" type="email" name="acct_email" placeholder="Email">
        </div>
        <div class="form-group text-left mb-4">
            <label for="password"><i class="lni lni-lock"></i></label>
            <input class="form-control" id="password" type="password" name="password" placeholder="Password">
        </div>
        <button class="btn btn-primary btn-lg w-100" name="loginSubmit">Login</button>
    </form>
</div>
<!-- Login Meta-->
<div class="login-meta-data text-center"><a class="forgot-password d-block mt-3 mb-1" href="forget-password.html">Forgot Password?</a>

    <p class="mb-0">Didn't have an account?<a class="ml-2" href="./register">Register</a></p>
</div>
</div>
</div>


<?php
require_once './layouts/footer.php';
?>
