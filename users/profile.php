<?php
$page_title = "Profile";
require_once '../include/config.php';

require_once './layouts/headerMain.php';

?>
<?php flash(); ?>

<div class="page-content-wrapper">
    <!-- Profile Content Wrapper-->
    <div class="profile-content-wrapper">
        <!-- Settings Option-->
        <div class="profile-settings-option"><a href="profile#"><i class="lni lni-cog"></i></a></div>
        <div class="container">
            <div class="user-meta-data d-flex align-items-center">
                <div class="user-thumbnail"><img src="../assets/img/profile/<?=user_details('acct_image')?>" alt=""></div>
                <div class="user-content">
                    <h6><?=ucwords(user_details('full_name'))?></h6>
                    <p>User</p>
                    <div class="user-meta-data d-flex align-items-center justify-content-between">
                        <?php
                        $stmt = $conn->query("SELECT * FROM blogs WHERE blog_author_id = '$user_id'");
                        $stmt->execute();

                        $count = $stmt->rowCount();
                        ?>
                        <p class="mx-1"><span class="counter"><?=$count?></span><span>Articles</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Traffic Source-->
    <div class="traffic-source-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="mb-3 newsten-title">Traffic Source</h6>
                <p class="mb-3 line-height-1">Last 7 days</p>
            </div>
            <div class="traffic-source-chart" id="trafficeSource"></div>
        </div>
    </div>
    <div class="container">
        <div class="border-top"></div>
    </div>
    <!-- My Visitors Wrapper-->
    <div class="my-visitors-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="mb-3 newsten-title">Weekly Visitors</h6>
                <p class="mb-3 line-height-1">Last 7 days</p>
            </div>
            <div class="user-total-count-chart" id="visitors-chart"></div>
        </div>
    </div>
    <div class="container">
        <div class="border-top"></div>
    </div>
    <!-- User All Article-->
    <div class="user-all-article-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="mb-3 newsten-title">My Articles</h6>
                <h6 class="mb-3 line-height-1"><?=$count?> Posts</h6>
            </div>
        </div>
        <div class="container">
            <!-- Single News Post-->

            <?php

            $stmt = $conn->query("SELECT b.title,b.featured_image,b.createdAt,b.categories,b.blog_id,c.category_name FROM blogs b left join categories c on b.categories = c.category_id WHERE b.blog_author_id = '$user_id' order by b.id DESC");
            $stmt->execute();
            
            while ($blog = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>

            <div class="single-news-post d-flex align-items-center bg-gray">
                <div class="post-thumbnail">
                    <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/post/<?=$blog['featured_image']?>" alt="">
                </div>
                <div class="post-content"><a class="post-title" href="./blog?id=<?=$blog['blog_id']?>"><?=$blog['title']?></a>
                    <div class="post-meta d-flex align-items-center"><a href="./single-category?id=<?=$blog['categories']?>"><?=$blog['category_name']?></a>
                        <a href="profile#"><?=get_time_ago(strtotime($blog['createdAt']))?></a></div>
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
