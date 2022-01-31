<?php

require_once '../include/config.php';

$page_title ="All Post";
//if(!$_GET['id']){
//    redirect('./home.php');
//    exit();
//}
require_once './layouts/headerMain.php';

?>

<div class="page-content-wrapper">


    <!-- Single Trending Post-->
    <?php
    $stmt = $conn->query("SELECT b.title,b.featured_image,b.createdAt,b.blog_id,c.category_name,c.category_id FROM blogs b right join categories c on b.categories = c.category_id  where b.blog_status =1 and b.blog_state = '$user_state' order by b.id DESC limit 9");
    $stmt->execute();

    $count = $stmt->rowCount();


    if ($count === 1){
        $sCount = $count." Post";
    }else{
        $sCount = $count." Posts";
    }

    ?>

    <!-- Trending News Wrapper-->
    <div class="trending-news-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-3 newsten-title">All Post</h5>
                <p class="mb-3 line-height-1"><?=$sCount?></p>
            </div>
        </div>
        <div class="container">

            <?php
            if($stmt->rowCount() <=0){
                ?>
                <div class="single-trending-post d-flex bg-danger">
                    <p class="text-white">No Post Yet</p>
                </div>
                <?php
            }else{
                ?>
                <?php
                while($trending = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>

                    <div class="single-trending-post d-flex">
                        <div class="post-thumbnail"><img src="../assets/img/post/<?=$trending['featured_image']?>" alt=""></div>
                        <div class="post-content"><a class="post-title" href="./blog?id=<?=$trending['blog_id']?>"><?=$trending['title']?></a>
                            <div class="post-meta d-flex align-items-center"><a href="./single-category?id=<?=$trending['category_id']?>"><?=$trending['category_name']?></a><a href="trending.html#"><?=get_time_ago(strtotime($trending['createdAt']))?></a></div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
        </div>
    </div>
</div>



<?php
require_once './layouts/footer.php';
?>



