<?php
require_once '../include/config.php';

$page_title ="Category";
//if(!$_GET['id']){
//    redirect('./home.php');
//    exit();
//}
require_once './layouts/headerMain.php';

?>

<div class="page-content-wrapper">
    <!-- Top Catagories Wrapper-->
    <div class="top-catagories-wrapper">
        <div class="bg-shapes">
            <div class="shape1"></div>
            <div class="shape2"></div>
            <div class="shape3"></div>
            <div class="shape4"></div>
            <div class="shape5"></div>
        </div>
        <h6 class="mb-3 catagory-title">Top Catagories</h6>
        <div class="container">
            <!-- Catagory Slides-->
            <div class="catagory-slides owl-carousel">
                <!-- Catagory Card-->
                <?php
                $stmt = $conn->query("SELECT *  FROM categories order by id");
                $stmt->execute();

                while($cat = $stmt->fetch(PDO::FETCH_ASSOC)){


                ?>
                <div class="card catagory-card"><a href="./single-category?id=<?=$cat['category_id']?>"><img src="../assets/img/category/<?=$cat['category_image']?>" alt="">
                        <h6><?=ucwords($cat['category_name'])?></h6></a></div>
                <?php
                }
                ?>


            </div>
        </div>
    </div>

    <!-- All Catagory Wrapper-->
    <div class="all-catagory-wrapper">
        <div class="container">
            <h5 class="mb-3 newsten-title">All Catagory</h5>
        </div>
        <div class="container">
            <div class="row">
                <!-- Catagory Card-->
                <?php
                $stmt = $conn->query("SELECT * FROM categories order by id");
                $stmt->execute();
                
                while ($catt = $stmt->fetch(PDO::FETCH_ASSOC)){
//                    $check = $catt->rowCount();
                ?>
                <div class="col-6 col-sm-4">
                    <div class="card catagory-card mb-3"><a href="./single-category?id=<?=$catt['category_id']?>"><img src="../assets/img/category/<?=$catt['category_image']?>" alt="">
                            <h6><?=$catt['category_name'].""?></h6></a></div>
                </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>

</div>

<?php
require_once './layouts/footer.php';
?>


