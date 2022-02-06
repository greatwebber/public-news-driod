<?php
require_once './include/config.php';

if(@!$_SESSION['login']){
    redirect('./login.php');
}else{
    redirect('./users/home.php');
}

