<?php
$page_title = "Dashboard";
$page_intro = "Admin Home";
require_once './include/function.php';

require_once './layouts/header.php';

?>
<?php flash(); ?>

<!-- Main content -->
<div class="col-xs-12">
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">

                    <h3><?=fetchDetails('blogs')?></h3>
                    <p>Total Post</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=fetchDetails('categories')?></h3>
                    <p>Total Categories</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=fetchDetails('users')?></h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <!-- Main row -->
    <div class="row">

    </div>
</section>



<?php
require_once './layouts/footer.php';
?>
