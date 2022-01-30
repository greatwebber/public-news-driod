<?php
require_once '../include/config.php';

$id = $_GET['id'];

if(!$_GET['id']){
    redirect('./home.php');
    exit();
}

$stmt = $conn->query("SELECT b.post,b.title,b.featured_image,b.createdAt,c.category_name FROM blogs b left join categories c on b.categories = c.category_id where b.categories = '$id' and b.blog_state='$user_state' order by b.id DESC ");
$stmt->execute();
$catt = $stmt->fetch(PDO::FETCH_ASSOC);
@$page_title = $catt['category_name'];
$check = $stmt->rowCount();
require_once './layouts/headerMain.php';

?>
<div class="page-content-wrapper">
    <div class="catagory-posts-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-3 pl-2 newsten-title"><?=$page_title?></h5>
                <p class="mb-3 line-height-1"><?=$check?> Posts</p>
            </div>
        </div>
        <div class="container">
            <!-- Single News Post-->
            <?php
            $stmt = $conn->query("SELECT * FROM blogs WHERE categories = '$id' and blog_state='$user_state' order by id desc");
            $stmt->execute();
            while ($singleCat = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="single-news-post d-flex align-items-center bg-gray">
                <div class="post-thumbnail">
                    <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/post/<?=$singleCat['featured_image']?>" alt="">
                </div>
                <div class="post-content"><a class="post-title" href="./blog?id=<?=$singleCat['blog_id']?>"><?=$singleCat['title']?></a>
                    <div class="post-meta d-flex align-items-center"><a href="#"><?=get_time_ago(strtotime($singleCat['createdAt']))?></a></div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>



<?php
require_once './layouts/footer.php';
?>
