<?php
session_start();
include './config/config.php';

if (isset($_GET['name'])) {

    $cat = $_GET['name'];
    $stmt = mysqli_query($con, "SELECT * FROM `post` WHERE `category` = '$cat' ORDER BY `id` DESC");

    if ($stmt) {
        if (mysqli_num_rows($stmt) > 0) {
            $query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '$cat'"));
            $query['visits'] += 1;
            $visits = $query['visits'];
            $c = mysqli_query($con, "UPDATE `categories` SET `visits` = '$visits' WHERE `cat_name` = '$cat'");
        }
    }

    $c_query = mysqli_query($con, "SELECT * FROM `categories`");
} else {
    echo "<script>window.location.href = './blog.php'; </script>";
}

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo ucfirst($_GET['name']); ?> - Entre Femme </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/logo/cleanlogo.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/ticker-style.css">
    <link rel="stylesheet" href="./assets/css/flaticon.css">
    <link rel="stylesheet" href="./assets/css/slicknav.css">
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <link rel="stylesheet" href="./assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./assets/css/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/slick.css">
    <link rel="stylesheet" href="./assets/css/nice-select.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/sidemenu.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" defer>


    <style>
        .blog_details {
            font-family: "Roboto Condensed" !important;
            font-weight: 400;
        }

        .blog_details p {
            font-size: 21px !important;
            color: #222222 !important;
            text-align: justify;
            font-family: "Times" !important;
        }

        .single-post h1 {
            font-weight: 800;
        }

        #line {
            font-family: sans-serif;
            color: #228B22;
            text-align: center;
            font-size: 30px;
            position: relative;
        }

        #line:before {
            content: "";
            display: block;
            width: 35%;
            height: 5px;
            background: #191970;
            left: 0;
            top: 50%;
            position: absolute;
            z-index: 0;

        }

        #line:after {
            content: "";
            display: block;
            width: 35%;
            height: 5px;
            background: #191970;
            right: 0;
            top: 50%;
            position: absolute;
            z-index: 0;
        }

        .weekly2-single .title {
            font-size: 24px;
            font-family: "Roboto Condensed", sans-serif;
            font-weight: 700;

        }

        .weekly2-caption {
            line-height: 31px;
        }

        .breadcrumb .breadcrumb-item a {
            color: #000;
        }

        
      
    .breadcrumb .breadcrumb-item.active {
        background-color: transparent !important;
        color: #DF678B;
    }

    .breadcrumb {
        background-color: transparent !important;
        padding: 0rem 1rem;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: '>';
        font-family: cursive;
    }

    .slicknav_menu .slicknav_icon{
        top: 0px;
    }

        @media only screen and (max-width:320px) {
            #line:before {
                content: "";
                display: block;
                width: 18%;
                height: 5px;
                background: #191970;
                left: 0;
                top: 50%;
                position: absolute;
                z-index: 0;

            }

            #line:after {
                content: "";
                display: block;
                width: 18%;
                height: 5px;
                background: #191970;
                right: 0;
                top: 50%;
                position: absolute;
                z-index: 0;
            }


        }

        @media only screen and (min-width: 321px) and (max-width:375px) {
            #line:before {
                content: "";
                display: block;
                width: 20%;
                height: 5px;
                background: #191970;
                left: 0;
                top: 50%;
                position: absolute;
                z-index: 0;

            }

            #line:after {
                content: "";
                display: block;
                width: 20%;
                height: 5px;
                background: #191970;
                right: 0;
                top: 50%;
                position: absolute;
                z-index: 0;
            }


        }

        @media only screen and (min-width: 376px) and (max-width:425px) {
            #line:before {
                content: "";
                display: block;
                width: 25%;
                height: 5px;
                background: #191970;
                left: 0;
                top: 50%;
                position: absolute;
                z-index: 0;

            }

            #line:after {
                content: "";
                display: block;
                width: 25%;
                height: 5px;
                background: #191970;
                right: 0;
                top: 50%;
                position: absolute;
                z-index: 0;
            }


        }
    </style>

    <?php echo $adsense; ?>

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="./assets/img/logo/cleanlogo2.png" alt="" width="100%">
                </div>
            </div>
        </div>
    </div>



    <?php include 'navbar.php'; ?>

    <!--================Blog Area =================-->
    <section class="blog_area my-5">

        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($cat); ?></li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-center" id="line">
                                    <span class="text-light p-1 px-5" style="background-color: #DF678B;"><?php echo ucfirst($cat); ?></span>
                                </h4>
                                <p class="text-center"><?php
                                                        $gquery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '$cat'"));
                                                        print_r($gquery['slogan']);

                                                        ?></p>
                            </div>
                            <?php



                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }


                            $no_of_records_per_page = 36;
                            $offset = ($pageno - 1) * $no_of_records_per_page;


                            $total_pages_sql = "SELECT COUNT(*) FROM post WHERE `category` = '$cat'";
                            $result = mysqli_query($con, $total_pages_sql);
                            $total_rows = mysqli_fetch_array($result)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);

                            $sql = "SELECT * FROM `post` WHERE `category` = '$cat' LIMIT $offset, $no_of_records_per_page";
                            $stmt2 = mysqli_query($con, $sql);

                            $show = 1;




                            if ($stmt2) {
                                if (mysqli_num_rows($stmt2) > 0) {
                                    while ($row = mysqli_fetch_assoc($stmt2)) {

                                        $count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `comment` WHERE `post_id` = '" . $row['id'] . "'"));

                                        $day = explode(' ', $row['date']);

                                        $color2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '" . $row['category'] . "'"));
                                        print_r('
    
        <div class="col-lg-12 mt-5">
        
            <div class="weekly2-single">
            
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    
                        <div class="weekly2-img">
                            <a href="blog_details.php?id=' . $row['id'] . '">
                            <img src="' . str_replace("../", "", $row['picture']) . '" alt="" width="100%" height="auto">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">     
                        <div class="weekly2-caption mt-2">
                            <a href="category.php?name=' . strtolower($row['category']) . '">
                                <span class="' . $color2['color'] . ' py-2 rounded">' . $row['category'] . '</span>
                            </a>
                            <h5 class="mt-2 title"><a href="blog_details.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h5>
                            <p>
                            <b>Post by: </b>' . ucfirst($row['username']) . ' <br><b>Posted on:</b> ' . $row['date'] . '</p>
                        </div>
                    </div>
                </div>
                
            </div>    
        </div>
                ');
                                    }
                                } else {
                                    $show = 0;



                                    print_r("<div class='container ml-4'><h4> No Articles Found - " . ucfirst($cat) . " </h4></div>");
                                }


                                $stmtr = mysqli_query($con, "select * from `post` where `category` != '" . ucfirst($cat) . "' order by `views` desc limit 6 ");
                                if ($stmtr) {
                                    if (mysqli_num_rows($stmtr) > 0) {
                                        print_r('<div class="col-lg-12 mt-5"><h2>Related Topics</h2></div>');
                                        while ($rowr = mysqli_fetch_assoc($stmtr)) {

                                            $color = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '" . $rowr['category'] . "'"));

                                            print_r(' 
            <div class="col-lg-6 mt-5">
                <div class="weekly2-single">
                    <div class="weekly2-img">
                        <a href="blog_details.php?id=' . $rowr['id'] . '">
                        <img src="' . str_replace("../", "", $rowr['picture']) . '" alt="" width="100%" height="240vh">
                        </a>
                    </div>
                    <div class="weekly2-caption mt-2">
                        <a href="category.php?name=' . strtolower($rowr['category']) . '">
                            <span class="' . $color['color'] . ' py-2 rounded">' . $rowr['category'] . '</span>
                        </a>
                        <h5 class="mt-2"><a href="blog_details.php?id=' . $rowr['id'] . '">' . $rowr['title'] . '</a></h5>
                        <p>' . $rowr['date'] . '</p>
                    </div>
                </div> 
            </div>
            ');
                                        }
                                    }
                                }
                            } else {
                                echo mysqli_error($con);
                            }

                            ?>

                            <ul class="pagination" id="paginat">

                                <li class="page-item <?php if ($pageno <= $total_pages) {
                                                            echo 'disabled';
                                                        } ?> ">
                                    <a class="page-link" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?name=' . $_GET['name']; ?>&pageno=1">First</a>
                                </li>

                                <li class="page-item <?php if ($pageno <= $total_pages) {
                                                            echo 'disabled';
                                                        } ?>">
                                    <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                    echo '#';
                                                                } else {
                                                                    "&pageno=" . ($pageno - 1);
                                                                } ?>">Prev</a>
                                </li>

                                <li class="page-item <?php if ($pageno <= $total_pages) {
                                                            echo 'disabled';
                                                        } ?>">
                                    <a class="page-link" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?name=' . $_GET['name'];
                                                                if ($pageno >= $total_pages) {
                                                                    echo '#';
                                                                } else {
                                                                    echo "&pageno=" . ($pageno + 1);
                                                                } ?>">Next</a>
                                </li>

                                <li class="page-item <?php if ($pageno <= $total_pages) {
                                                            echo 'disabled';
                                                        } ?>">
                                    <a class="page-link " href="<?php echo $_SERVER['SCRIPT_NAME'] . '?name=' . $_GET['name']; ?>&pageno=<?php echo $total_pages; ?>">Last</a>
                                </li>

                            </ul>

                            <?php

                            if ($total_pages < 2) {

                                echo "<script>document.getElementById('paginat').style.display = 'none';</script>";
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="search.php">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input name="name" type="text" class="form-control" placeholder='Search Keyword' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h1 class="widget_title pb-1 mb-1"><b>Category</b></h1>
                            <ul class="list cat-list">
                                <?php
                                $c_query = mysqli_query($con, "SELECT * FROM `categories` WHERE `menu` = '1' AND `id` != '1'");
                                if ($c_query) {
                                    if (mysqli_num_rows($c_query) > 0) {

                                        while ($cats = mysqli_fetch_assoc($c_query)) {
                                            $co = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `post` WHERE `category` = '" . $cats['cat_name'] . "'"));

                                            print_r('
                        <li>
                           <a href="category.php?name=' . strtolower($cats['cat_name']) . '" class="d-flex">
                              <p><i class="fa fa-angle-double-right"></i> <b>' . $cats['cat_name'] . '</b></p>&nbsp;
                              <p>| <small>' . $co . ' posts</small></p>
                           </a>
                        </li>
                    ');
                                        }
                                    }
                                }

                                ?>

                            </ul>
                        </aside>


                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>



                            <?php

                            $rec = mysqli_query($con, "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 4");
                            if ($rec) {
                                if (mysqli_num_rows($rec) > 0) {
                                    while ($recent = mysqli_fetch_assoc($rec)) {

                                        $color2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '" . $recent['category'] . "'"));
                                        // $stm = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name`")        
                                        print_r('
                <div class="media post_item">
                      <a href="blog_details.php?id=' . $recent['id'] . '">
                      <img src="' . str_replace("../", "", $recent['picture']) . '" alt="' . $recent['title'] . '" width="100vw" height="100vw">
                      </a>
                <div class="media-body">
                    <a href="category.php?name=' . strtolower($recent['category']) . '">
                        <p class="' . $color2['color'] . '">' . $recent['category'] . '</p>
                    </a>
                    <a href="blog_details.php?id=' . $recent['id'] . '">
                        <h3>' . $recent['title'] . '</h3>
                    </a>
                    <p>' . $recent['date'] . '</p>
                </div>
                </div>
                
                ');
                                    }
                                }
                            }

                            ?>

                        </aside>


                        <!--<aside class="single_sidebar_widget newsletter_widget">-->
                        <!--    <h4 class="widget_title">Newsletter</h4>-->

                        <!--    <form action="#">-->
                        <!--        <div class="form-group">-->
                        <!--            <input type="email" class="form-control" onfocus="this.placeholder = ''"-->
                        <!--                onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>-->
                        <!--        </div>-->
                        <!--        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"-->
                        <!--            type="submit">Subscribe</button>-->
                        <!--    </form>-->
                        <!--</aside>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <?php include './footer.php'; ?>

    <!-- Search model Begin -->
    <div class="search-model-box">
        <div class="d-flex align-items-center h-100 justify-content-center">
            <div class="search-close-btn">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Searching key.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>