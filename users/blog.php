<?php
require_once '../include/config.php';

$page_title = user_details('name')." News";


if(!$_GET['id']){
    redirect('./home.php');
    exit();
}

$id = $_GET['id'];

$stmt = $conn->query("SELECT b.title,b.post,b.blog_author,b.blog_author_id,b.categories,b.featured_image,b.createdAt,c.category_name, u.acct_image FROM blogs b left join categories c on b.categories=c.category_id left join users u on b.blog_author_id = u.id  where b.blog_id = '$id' ");
$stmt->execute();
$blog = $stmt->fetch(PDO::FETCH_ASSOC);
$categories = $blog['categories'];

if($blog['blog_author'] === "admin"){
    $blog_img = "profile-avatar.png";
}else{
    $blog_img = $blog['acct_image'];
}




require_once './layouts/headerMain.php';

?>
<?php flash(); ?>

<div class="page-content-wrapper">
    <!-- Scroll Indicator-->
    <div id="scrollIndicator"></div>
    <!-- Single Blog Thumbnail-->
    <div class="single-blog-thumbnail"><img class="w-100" src="../assets/img/post/<?=$blog['featured_image']?>" alt=""><a class="post-bookmark" href="##"><i class="lni lni-bookmark"></i></a></div>
    <!-- Single Blog Info-->
    <div class="single-blog-info">
        <div class="container">
            <div class="d-flex align-items-center">
                <!-- Post Like Wrap-->

                <!-- Post Content Wrap-->
                <div class="post-content-wrap"><a class="post-catagory d-inline-block mb-2" href="#"><?=$blog['category_name']?></a>
                    <h5 class="mb-2"><?=ucwords($blog['title'])?></h5>
                    <div class="post-meta"><a class="post-date" href="##"><?=date('d F',strtotime($blog['createdAt']))?></a><a class="post-views" href="##">9,451 Views</a></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Description-->
    <div class="blog-description">
        <div class="container">
            <?= $blog['post']?>
        </div>
    </div>

    <!-- Post Author-->
    <div class="profile-content-wrapper">
        <!-- Settings Option-->
<!--        <div class="profile-settings-option"><a href="##" data-toggle="tooltip" data-placement="left" title="Follow"><i class="lni lni-plus"></i></a></div>-->
        <div class="container">
            <!-- User Meta Data-->
            <div class="user-meta-data d-flex align-items-center">
                <!-- User Thumbnail-->
                <div class="user-thumbnail"><img src="../assets/img/profile/<?=$blog_img?>" alt=""></div>
                <!-- User Content-->
                <div class="user-content">
                    <h6><?=ucwords($blog['blog_author'])?></h6>
                    <p>Publisher</p>
                    <div class="user-meta-data d-flex align-items-center justify-content-between">
                        <p class="mx-1"><span class="counter">432</span><span>Articles</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Post-->
    <div class="related-post-wrapper">
        <div class="container">
            <h6 class="mb-3 newsten-title">Related Posts</h6>
        </div>
        <div class="container">
            <!-- Single Trending Post-->
            <?php
            $stmt3 = $conn->query("SELECT b.title, b.featured_image,b.blog_id, b.createdAt,c.category_name FROM blogs b left join categories c on b.categories = c.category_id where b.blog_id !='$id' and b.blog_state = '$user_state' and b.categories='$categories' order by b.id desc limit 3");
            $stmt3->execute();

            $checkRelatedPost = $stmt3->fetch(PDO::FETCH_ASSOC);

            if($stmt3->rowCount()>0){
            ?>
                <?php
                $stmt = $conn->query("SELECT b.title, b.featured_image,b.blog_id, b.createdAt,c.category_name FROM blogs b left join categories c on b.categories = c.category_id where b.blog_id !='$id' and b.blog_state = '$user_state' and b.categories='$categories' order by b.id desc limit 3");
                $stmt->execute();
                while ($relatedPost = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="single-trending-post d-flex">
                        <div class="post-thumbnail"><img src="../assets/img/post/<?=$relatedPost['featured_image']?>" alt=""></div>
                        <div class="post-content"><a class="post-title" href="./blog?id=<?=$relatedPost['blog_id']?>"><?=$relatedPost['title']?></a>
                                <div class="post-meta d-flex align-items-center"><a href="catagory.html"><?=$relatedPost['category_name']?></a><a href="#"><?=date('d M y',strtotime($relatedPost['createdAt']))?></a></div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <?php
                    }else{
                ?>
                <div class="single-trending-post d-flex bg-danger">
                    <p class="text-white text-center">No Related Post Yet !</p>
                </div>
                <?php
                    }
                ?>
        </div>
    </div>

    <div class="container">
        <div class="border-top"></div>
    </div>
    <!-- Blog Comments-->
</div>

<?php
require_once './layouts/footer.php';
?>