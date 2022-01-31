<?php
$page_title = "Home";
require_once '../include/config.php';
require_once './layouts/header.php';

?>
<?php flash(); ?>

    <!-- News Today Wrapper-->
    <div class="news-today-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-3 pl-1 newsten-title">News Today</h5>
                <p class="mb-3 line-height-1" id="dashboardDate2"></p>
            </div>
            <!-- Hero Slides-->
            <!-- Hero Slides-->
            <div class="hero-slides owl-carousel">
                <!-- Single Hero Slide-->
                <?php
                $stmt = $conn->prepare("SELECT * FROM blogs b left join categories c on b.categories = c.category_id where b.blog_status =1 and b.blog_state = :user_state order by b.id DESC");
                $stmt->execute([
                        'user_state'=>$user_state
                ]);
                
                while($check = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="single-hero-slide" style="background-image: url('../assets/img/post/<?=$check['featured_image']?>')">
                    <!-- Background Shape-->
                    <div class="background-shape">
                        <div class="circle2"></div>
                        <div class="circle3"></div>
                    </div>
                    <div class="slide-content h-100 d-flex align-items-end">
                        <div class="container-fluid mb-3">
                            <div class="video-icon"><i class="lni lni-play"></i></div>
                            <a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                            <a class="post-catagory" href="catagory.html"><?=$check['category_name']?></a>
                            <a class="post-title d-block" href="./blog?id=<?=$check['blog_id']?>"><?=ucwords(substr($check['title'],0,50))?></a>
                            <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 lni lni-user"></i><?=ucwords($check['blog_author'])?></a>
                                <a href="./home#"><i class="mr-1 lni lni-calendar"></i><?=date('d M',strtotime($check['createdAt']))?></a><span><i class="mr-1 lni lni-bar-chart"></i>4 min read</span></div>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>

            </div>
        </div>
    </div>
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
                $stmt = $conn->query("SELECT * FROM categories order by id DESC");
                $stmt->execute();

                while ($cat = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="card catagory-card">
                    <a href="./single-category?id=<?=$cat['category_id']?>"><img src="../assets/img/category/<?=$cat['category_image']?>" alt="" >
                        <h6><?=ucwords($cat['category_name'])?></h6>
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Trending News Wrapper-->
    <div class="trending-news-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0 pl-1 newsten-title">Trending</h5><a class="btn btn-primary btn-sm" href="trending.html">View All</a>
            </div>
        </div>
        <div class="container">
            <!-- Single Trending Post-->
            <?php
            $stmt = $conn->query("SELECT * FROM blogs b right join categories c on b.categories = c.category_id  where b.featured =1 and b.blog_state = '$user_state' order by b.id DESC limit 3");
            $stmt->execute();


            ?>
                <?php
                if($stmt->rowCount() <=0){
                ?>
                    <div class="single-trending-post d-flex bg-danger">
                            <p class="text-white">No Trending Post Yet</p>
                    </div>
                    <?php
                }else{
                    ?>
                    <?php
                        while($trending = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <div class="single-trending-post d-flex">
                            <div class="post-thumbnail"><img src="../assets/img/post/<?=$trending['featured_image']?>" alt=""></div>
                            <div class="post-content"><a class="post-title" href="./blog?id=<?=$trending['blog_id']?>"><?=ucwords($trending['title'])?></a>
                                <div class="post-meta d-flex align-items-center"><a href="./single-category?id=<?=$trending['category_id']?>"><?=$trending['category_name']?></a><a href="./home#"><?=date('d M y',strtotime($trending['createdAt']))?></a></div>
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
    <!-- Editorial Choice News Wrapper-->
    <div class="editorial-choice-news-wrapper">
        <!-- Background Shapes-->
        <div class="bg-shape1"><img src="img/core-img/edito.png" alt=""></div>
        <div class="bg-shape2" style="background-image: url('img/core-img/edito2.png')"></div>
        <div class="container">
            <div class="editorial-choice-title text-center mb-4"><i class="lni lni-protection"></i>
                <h6 class="newsten-title">Editorial Choice</h6>
            </div>
        </div>
        <div class="container">
            <!-- Editorial Choice News Slide-->
            <div class="editorial-choice-news-slide owl-carousel">
                <!-- Single Slide-->
                <div class="single-editorial-slide d-flex"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                    <div class="post-thumbnail">
                        <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/bg-img/9.jpg" alt="">
                    </div>
                    <div class="post-content"><a class="post-catagory" href="catagory.html">Sports</a><a class="post-title d-block" href="single.html">Basketball is becoming popular young people</a>
                        <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 fa fa-user-o"></i>Nazrul</a><a href="./home#"><i class="mr-1 fa fa-clock-o"></i>30 March</a></div>
                    </div>
                </div>
                <!-- Single Slide-->
                <div class="single-editorial-slide d-flex"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                    <div class="post-thumbnail"><img src="../assets/img/bg-img/14.jpg" alt=""></div>
                    <div class="post-content"><a class="post-catagory" href="catagory.html">Environment</a><a class="post-title d-block" href="single.html">We are responsible for environment pollution</a>
                        <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 fa fa-user-o"></i>Nazrul</a><a href="./home#"><i class="mr-1 fa fa-clock-o"></i>16 March</a></div>
                    </div>
                </div>
                <!-- Single Slide-->
                <div class="single-editorial-slide d-flex"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                    <div class="post-thumbnail">
                        <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/bg-img/15.jpg" alt="">
                    </div>
                    <div class="post-content"><a class="post-catagory" href="catagory.html">Cooking</a><a class="post-title d-block" href="single.html">How to make a crunchy toast biscuit in home</a>
                        <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 fa fa-user-o"></i>Nazrul</a><a href="./home#"><i class="mr-1 fa fa-clock-o"></i>24 March</a></div>
                    </div>
                </div>
                <!-- Single Slide-->
                <div class="single-editorial-slide d-flex"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                    <div class="post-thumbnail"><img src="../assets/img/bg-img/10.jpg" alt=""></div>
                    <div class="post-content"><a class="post-catagory" href="catagory.html">World</a><a class="post-title d-block" href="single.html">World most top building is situated in New York city</a>
                        <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 fa fa-user-o"></i>Nazrul</a><a href="./home#"><i class="mr-1 fa fa-clock-o"></i>22 March</a></div>
                    </div>
                </div>
                <!-- Single Slide-->
                <div class="single-editorial-slide d-flex"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                    <div class="post-thumbnail">
                        <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/bg-img/13.jpg" alt="">
                    </div>
                    <div class="post-content"><a class="post-catagory" href="catagory.html">People</a><a class="post-title d-block" href="single.html">Massive riots in the city to establish rule of law</a>
                        <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 fa fa-user-o"></i>Nazrul</a><a href="./home#"><i class="mr-1 fa fa-clock-o"></i>17 March</a></div>
                    </div>
                </div>
                <!-- Single Slide-->
                <div class="single-editorial-slide d-flex"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                    <div class="post-thumbnail"><img src="../assets/img/bg-img/6.jpg" alt=""></div>
                    <div class="post-content"><a class="post-catagory" href="catagory.html">Gadgets</a><a class="post-title d-block" href="single.html">International Robot Olympiad was held in March 2020</a>
                        <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 fa fa-user-o"></i>Nazrul</a><a href="./home#"><i class="mr-1 fa fa-clock-o"></i>15 March</a></div>
                    </div>
                </div>
                <!-- Single Slide-->
                <div class="single-editorial-slide d-flex"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                    <div class="post-thumbnail"><img src="../assets/img/bg-img/7.jpg" alt=""></div>
                    <div class="post-content"><a class="post-catagory" href="catagory.html">Health</a><a class="post-title d-block" href="single.html">Loses over 30kg on keto diet and one meal a day</a>
                        <div class="post-meta d-flex align-items-center"><a href="./home#"><i class="mr-1 fa fa-user-o"></i>Nazrul</a><a href="./home#"><i class="mr-1 fa fa-clock-o"></i>19 March</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- For You News Wrapper-->
    <div class="for-you-news-wrapper">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0 pl-1 newsten-title">For You</h5><a class="btn btn-primary btn-sm" href="./home#">View All</a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Single Recommended Post-->
                <?php
                $stmt = $conn->prepare("SELECT * FROM blogs b left join categories c on b.categories = c.category_id where b.blog_status =1 and b.blog_state = :user_state order by b.id DESC");
                $stmt->execute([
                    'user_state'=>$user_state
                ]);

                while($check = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="col-6 col-md-4">
                    <div class="single-recommended-post mt-3"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                        <div class="post-thumbnail"><img src="../assets/img/post/<?=$check['featured_image']?>" alt=""></div>
                        <div class="post-content"><a class="post-catagory" href="./single-category?id=<?=$check['categories']?>"><?=$check['category_name']?></a><a class="post-title" href="./blog?id=<?=$check['blog_id']?>"><?=ucwords(substr($check['title'],0,20))?>...</a></div>
                    </div>
                </div>

                <?php
                }
                ?>

            </div>
        </div>
    </div>
    <!-- Tabs News Wrapper-->
    <div class="tabs-news-wrapper bg-gray">
        <div class="container">
            <nav>
                <!-- Nav Tabs-->
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-newest-tab" href="./home.php#nav-newest" data-toggle="tab" role="tab" aria-controls="nav-newest" aria-selected="true">Newest</a>
                    <a class="nav-item nav-link disabled" id="nav-popular-tab" href="./home.php#nav-popular" data-toggle="tab" role="tab" aria-controls="nav-popular" aria-selected="false">News In</a>
                    <a class="nav-item nav-link disabled" id="nav-featured-tab" href="./home.php#nav-featured" data-toggle="tab" role="tab" aria-controls="nav-featured" aria-selected="false"><?=user_details('name')?></a></div>
            </nav>
            <!-- Tabs Content-->
            <div class="tab-content" id="nav-tabContent">
                <!-- Single Tab Pane-->
                <div class="tab-pane fade show active" id="nav-newest" role="tabpanel" aria-labelledby="nav-newest-tab">
                    <!-- Single News Post-->
                    <?php
                    $stmt = $conn->prepare("SELECT b.title,b.createdAt,b.featured_image,b.blog_id FROM blogs b where b.blog_status =1 and b.blog_state = :user_state order by b.id DESC");
                    $stmt->execute([
                        'user_state'=>$user_state
                    ]);

                    while($check = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail">
                            <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/post/<?=$check['featured_image']?>" alt="">
                        </div>
                        <div class="post-content"><a class="post-title" href="./blog?id=<?=$check['blog_id']?>"><?=$check['title']?></a>
                            <div class="post-meta d-flex align-items-center"><a href="./home#"><?=get_time_ago(strtotime($check['createdAt']))?></a></div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Popular Tags-->
    <div class="popular-tags-wrapper">

    </div>
</div>

<?php
require_once './layouts/footer.php';
?>
