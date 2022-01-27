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
                $stmt = $conn->query('SELECT * FROM blogs b left join categories c on b.categories = c.category_id where b.blog_status =1 order by blog_id DESC');
                $stmt->execute();
                
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
                            <a class="post-title d-block" href="single.html"><?=ucwords(substr($check['post'],0,50))?></a>
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
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/8.jpg" alt="">
                        <h6>Politics</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/3.jpg" alt="">
                        <h6>Fashion</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/6.jpg" alt="">
                        <h6>Tech</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/15.jpg" alt="">
                        <h6>Lifestyle</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/9.jpg" alt="">
                        <h6>Sports</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/10.jpg" alt="">
                        <h6>World</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/14.jpg" alt="">
                        <h6>Environment</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/13.jpg" alt="">
                        <h6>People</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/12.jpg" alt="">
                        <h6>Gadgets</h6></a></div>
                <!-- Catagory Card-->
                <div class="card catagory-card"><a href="catagory.html"><img src="../assets/img/bg-img/7.jpg" alt="">
                        <h6>Health</h6></a></div>
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
            <div class="single-trending-post d-flex">
                <div class="post-thumbnail"><img src="../assets/img/bg-img/11.jpg" alt=""></div>
                <div class="post-content"><a class="post-title" href="single.html">Swimming is a good exercise for the body</a>
                    <div class="post-meta d-flex align-items-center"><a href="catagory.html">Sports</a><a href="./home#">02 Jun 20</a></div>
                </div>
            </div>
            <!-- Single Trending Post-->
            <div class="single-trending-post d-flex">
                <div class="post-thumbnail">
                    <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/bg-img/16.jpg" alt="">
                </div>
                <div class="post-content"><a class="post-title" href="single.html">The drone is banned in BD without permission</a>
                    <div class="post-meta d-flex align-items-center"><a href="catagory.html">Tech</a><a href="./home#">03 Jun 20</a></div>
                </div>
            </div>
            <!-- Single Trending Post-->
            <div class="single-trending-post d-flex">
                <div class="post-thumbnail"><img src="../assets/img/bg-img/17.jpg" alt=""></div>
                <div class="post-content"><a class="post-title" href="single.html">Some tips for taking care of the body this summer</a>
                    <div class="post-meta d-flex align-items-center"><a href="catagory.html">Fashion</a><a href="./home#">04 Jun 20</a></div>
                </div>
            </div>
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
                <div class="col-6 col-md-4">
                    <div class="single-recommended-post mt-3"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/18.jpg" alt=""></div>
                        <div class="post-content"><a class="post-catagory" href="catagory.html">Health</a><a class="post-title" href="single.html">Lemon is useful to lose weight</a></div>
                    </div>
                </div>
                <!-- Single Recommended Post-->
                <div class="col-6 col-md-4">
                    <div class="single-recommended-post mt-3"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/19.jpg" alt=""></div>
                        <div class="post-content"><a class="post-catagory" href="catagory.html">World</a><a class="post-title" href="single.html">World is getting warm rapidly</a></div>
                    </div>
                </div>
                <!-- Single Recommended Post-->
                <div class="col-6 col-md-4">
                    <div class="single-recommended-post mt-3"><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/9.jpg" alt=""></div>
                        <div class="post-content"><a class="post-catagory" href="catagory.html">Sports</a><a class="post-title" href="single.html">WBL was held in June 2020</a></div>
                    </div>
                </div>
                <!-- Single Recommended Post-->
                <div class="col-6 col-md-4">
                    <div class="single-recommended-post mt-3">
                        <div class="video-icon"><i class="lni lni-play"></i></div><a class="bookmark-post" href="./home#"><i class="lni lni-bookmark"></i></a>
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/15.jpg" alt=""></div>
                        <div class="post-content"><a class="post-catagory" href="catagory.html">Lifestyle</a><a class="post-title" href="single.html">Make yummy toast in home</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabs News Wrapper-->
    <div class="tabs-news-wrapper bg-gray">
        <div class="container">
            <nav>
                <!-- Nav Tabs-->
                <div class="nav nav-tabs" id="nav-tab" role="tablist"><a class="nav-item nav-link" id="nav-newest-tab" href="./home#nav-newest" data-toggle="tab" role="tab" aria-controls="nav-newest" aria-selected="true">Newest</a><a class="nav-item nav-link active" id="nav-popular-tab" href="./home#nav-popular" data-toggle="tab" role="tab" aria-controls="nav-popular" aria-selected="false">Popular</a><a class="nav-item nav-link" id="nav-featured-tab" href="./home#nav-featured" data-toggle="tab" role="tab" aria-controls="nav-featured" aria-selected="false">Featured</a></div>
            </nav>
            <!-- Tabs Content-->
            <div class="tab-content" id="nav-tabContent">
                <!-- Single Tab Pane-->
                <div class="tab-pane fade" id="nav-newest" role="tabpanel" aria-labelledby="nav-newest-tab">
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail">
                            <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/bg-img/20.jpg" alt="">
                        </div>
                        <div class="post-content"><a class="post-title" href="single.html">Morning walking &amp; running is good for health</a>
                            <div class="post-meta d-flex align-items-center"><a href="./home#">9 min ago</a></div>
                        </div>
                    </div>
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/21.jpg" alt=""></div>
                        <div class="post-content"><a class="post-title" href="single.html">BD celebrate independence day in 26 march</a>
                            <div class="post-meta d-flex align-items-center"><a href="./home#">33 min ago</a></div>
                        </div>
                    </div>
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/22.jpg" alt=""></div>
                        <div class="post-content"><a class="post-title" href="single.html">Skating nowadays very popular sports in sea area</a>
                            <div class="post-meta d-flex align-items-center"><a href="./home#">57 min ago</a></div>
                        </div>
                    </div>
                </div>
                <!-- Single Tab Pane-->
                <div class="tab-pane fade show active" id="nav-popular" role="tabpanel" aria-labelledby="nav-popular-tab">
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/23.jpg" alt=""></div>
                        <div class="post-content"><a class="post-title" href="single.html">The ship of the desert reducing rapidly in the world</a>
                            <div class="post-meta d-flex align-items-center"><a href="catagory.html">Camel</a><a href="./home#">2 Comments</a></div>
                        </div>
                    </div>
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail">
                            <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/bg-img/24.jpg" alt="">
                        </div>
                        <div class="post-content"><a class="post-title" href="single.html">Why you will eat apple & banana every day</a>
                            <div class="post-meta d-flex align-items-center"><a href="catagory.html">Habits</a><a href="./home#">8 Comments</a></div>
                        </div>
                    </div>
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/25.jpg" alt=""></div>
                        <div class="post-content"><a class="post-title" href="single.html">Satellite now producing more waste on the planet</a>
                            <div class="post-meta d-flex align-items-center"><a href="catagory.html">Planet</a><a href="./home#">6 Comments</a></div>
                        </div>
                    </div>
                </div>
                <!-- Single Tab Pane-->
                <div class="tab-pane fade" id="nav-featured" role="tabpanel" aria-labelledby="nav-featured-tab">
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/26.jpg" alt=""></div>
                        <div class="post-content"><a class="post-title" href="single.html">Balcony gardening is a new trend of big cities</a>
                            <div class="post-meta d-flex align-items-center"><a href="profile-for-viewer.html">Mayaj</a><a href="./home#">9 min read</a></div>
                        </div>
                    </div>
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail">
                            <div class="video-icon"><i class="lni lni-play"></i></div><img src="../assets/img/bg-img/27.jpg" alt="">
                        </div>
                        <div class="post-content"><a class="post-title" href="single.html">The world is becoming polluted very fast and lives are being destroyed</a>
                            <div class="post-meta d-flex align-items-center"><a href="profile-for-viewer.html">Nazrul</a><a href="./home#">27 min read</a></div>
                        </div>
                    </div>
                    <!-- Single News Post-->
                    <div class="single-news-post d-flex align-items-center">
                        <div class="post-thumbnail"><img src="../assets/img/bg-img/28.jpg" alt=""></div>
                        <div class="post-content"><a class="post-title" href="single.html">Sea is polluted in a terrible way by human garbage</a>
                            <div class="post-meta d-flex align-items-center"><a href="profile-for-viewer.html">Suha</a><a href="./home#">59 min read</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popular Tags-->
    <div class="popular-tags-wrapper">
        <div class="container">
            <h5 class="mb-3 pl-2 newsten-title">Popular Tags</h5>
        </div>
        <div class="container">
            <!-- Popular Tags List-->
            <div class="popular-tags-list"><a class="btn btn-primary btn-sm m-1" href="./home#">#Politics</a><a class="btn btn-success btn-sm m-1" href="./home#">#Fashion</a><a class="btn btn-warning btn-sm m-1" href="./home#">#Tech</a><a class="btn btn-danger btn-sm m-1" href="./home#">#Lifestyle</a><a class="btn btn-info btn-sm m-1" href="./home#">#Sports</a><a class="btn btn-success btn-sm m-1" href="./home#">#World</a><a class="btn btn-warning btn-sm m-1" href="./home#">#Environment</a><a class="btn btn-danger btn-sm m-1" href="./home#">#People</a><a class="btn btn-info btn-sm m-1" href="./home#">#Gadgets</a><a class="btn btn-success btn-sm m-1" href="./home#">#Health</a><a class="btn btn-primary btn-sm m-1" href="./home#">#Wildlife</a></div>
        </div>
    </div>
</div>

<?php
require_once './layouts/footer.php';
?>
