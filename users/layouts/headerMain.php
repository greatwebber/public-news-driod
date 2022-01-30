<?php
require_once '../session.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
    <!-- Title-->
    <title><?=page_title($page_title)?> </title>
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
        <!-- Back Button-->
        <div class="back-button"><a href="home"><i class="lni lni-chevron-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0"><?=$page_title?></h6>
        </div>
        <!-- Search Form-->
        <div class="search-form"><a href="search.html"><i class="fa fa-search"></i></a></div>
    </div>
</div>