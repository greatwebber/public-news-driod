<?php
require_once '../session.php';
if(!$_SESSION['login']){
    redirect('../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
    <!-- Title-->
    <title>News Ten - Blog &amp; Magazine Mobile HTML Template</title>
    <!-- Favicon-->
    <link rel="icon" href="../assets/img/core-img/favicon.ico">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<!-- Preloader-->
<div class="preloader" id="preloader">
    <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
    </div>
</div>
<!-- Header Area-->
<div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Navbar Toggler-->
        <div class="navbar--toggler" id="newstenNavbarToggler"><span></span><span></span><span></span><span></span></div>
        <!-- Logo-->
        <div class=""><p class="text-center mt-3 text-black">FPE NEWS DRIOD</p></div>
        <!-- Search Form-->
        <div class="search-form"><a href="./profile"><i class="fa fa-user"></i></a></div>
    </div>
</div>
<!-- Sidenav Black Overlay-->
<div class="sidenav-black-overlay"></div>
<!-- Side Nav Wrapper-->
<div class="sidenav-wrapper" id="sidenavWrapper">
    <!-- Time - Weather-->
    <div class="time-date-weather-wrapper text-center py-5" style="background-image: url('../assets/img/bg-img/1.jpg')">
        <div class="weather-update mb-4">
            <l class="icon lni lni-network"></l>
            <br>
            <h6 class="mb-0"><?=user_details('name')?> News</h6>
        </div>
        <div class="time-date">
            <div id="dashboardDate"></div>
            <div class="running-time d-flex justify-content-center">
                <div id="hours"></div><span>:</span>
                <div id="min"></div><span>:</span>
                <div id="sec"></div>
            </div>
        </div>
    </div>
    <!-- Sidenav Nav-->
    <ul class="sidenav-nav">
        <li><a href="live.html"><i class="lni lni-play"></i>Live<span class="red-circle ml-2 flashing-effect"></span></a></li>
        <li><a href="profile"><i class="lni lni-user"></i>My Profile</a></li>
        <li><a href="./trending"><i class="lni lni-hacker-news"></i>All Trending<span class="ml-2 badge badge-danger">HOT</span></a></li>
        <?php
        $stmt = $conn->query("SELECT * FROM categories");
        $stmt->execute();

        $check = $stmt->rowCount();
        ?>
        <li><a href="./category"><i class="lni lni-grid-alt"></i>All Category                <span class="ml-2 badge badge-warning"><?=$check?>+</span></a></li>
        <li><a href="./settings"><i class="lni lni-cog"></i>Settings</a></li>
        <li><a href="logout"><i class="lni lni-power-switch"></i>Logout</a></li>
    </ul>
    <!-- Go Back Button-->
    <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-left"></i></div>
</div>