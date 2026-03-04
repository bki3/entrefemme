<?php
include './config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmtet = mysqli_query($con, "SELECT * FROM `post` WHERE `category` = '$id' AND `advisor`='1'");
    $cats = mysqli_query($con, "select * from categories");
} else {
    $stmtet = mysqli_query($con, "SELECT * FROM `post` WHERE `advisor` = '1'");
    $cats = mysqli_query($con, "select * from categories");
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en-us">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Advisor | Entre Femme</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <!--<link rel="shortcut icon" type="image/x-icon" href="./assets/img/logo/cleanlogo2.png" width="100%">-->

    <link rel="icon" type="image/x-icon" href="assets/img/logo/favlogo.png" width="100%">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/ticker-style.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sidemenu.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" defer>
</head>

<style>
    .breadcrumb {
        margin-top: 10px;
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
</style>

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
    <!-- Preloader Start -->
    <?php include 'navbar.php'; ?>
    <main>
        <div class="about-details">
            <div class="container">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Entre Femme Advisor</li>
                    </ol>
                </nav>

                <div class="row mt-3">
                    <div class="col-lg-12 col-12">
                        <div class="p-5" style="background-image: url('assets/img/banner/img.png'); border-bottom: 5px solid #DF678B;">
                            <h2 class="text-center text-light">Entre Femme Advisor</h2>
                            <h5 class="text-center text-light">Do everything better</h5>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="text-center">

                            <p>Disclaimer: Commercial content is produced by Entre Femme Advisor and is independent of Entre Femme Editorial and Advertising. We and our partners may be compensated if you purchase a product or service through the links on our website.</p>
                            <div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">


                        <?php
                        if ($cats) {
                            if (mysqli_num_rows($cats) > 0) {
                                while ($cat = mysqli_fetch_assoc($cats)) {
                                    print_r('<div class="col-2 my-2">
                <center>
                <a href="?id=' . $cat['cat_name'] . '" class="' . $cat['color'] . ' p-1 text-light" style="cursor:pointer;">' . $cat['cat_name'] . '</a>
                </center>
                </div>');
                                }
                            }
                        }
                        ?>

                    </div>


                    <div class="row my-5">
                        <div class="col-lg-12">

                            <?php

                            if ($stmtet) {
                                if (mysqli_num_rows($stmtet) > 0) {

                                    while ($popular = mysqli_fetch_assoc($stmtet)) {
                                        // print_r($popular);

                                        print_r('
    
    <div class="card bg-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <a href="blog_details.php?id=' . $popular['id'] . '">
                        <img src="' . str_replace("../", "", $popular['picture']) . '" alt="no image" width="100%">
                    </a>
                </div>
                <div class="col-lg-8 col-12 p-1">
                    <a href="category.php?name=' . $popular['category'] . '">
                        <p class="m-0 p-1 bg-info d-inline text-light">' . $popular['category'] . '</p>
                    </a>
                    <p class="m-0">
                    <i class="fa fa-user mx-2"></i> ' . ucfirst($popular['username']) . '
                    <i class="fa fa-calendar mx-2"></i> ' . $popular['date'] . ' 
                    <i class="fa fa-eye mx-2"></i> ' . $popular['views'] . '
                    </p>
                    <h5><a href="blog_details.php?id=' . $popular['id'] . '">' . $popular['title'] . '</a></h5>
                    <div style="max-height: 200px; overflow:hidden; text-overflow: ellipsis;" class="text-justify">
                        <p>' . $popular['body'] . '</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

                ');
                                    }
                                } else {
                                    print_r('
     
       
    <div class="card bg-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-3 mr-1">
                    <img src="assets/img/gallery/most_recent1.png" alt="">
                </div>
                <div class="col-8">
                    <p class="m-0">23 February 2023</p>
                    <h6><a href="">Scarlett’s disappointment at latest accolade</a></h6>
                </div>
            </div>
        </div>
    </div>

                ');
                                }
                            }


                            ?>
                        </div>
                    </div>
                </div>
            </div>

    </main>



    <?php include 'footer.php'; ?>

</body>

</html>