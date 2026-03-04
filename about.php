<?php 
include 'config/config.php';

$sql = mysqli_query($con, "SELECT * FROM `aboutusblog`");
if($sql){
    if(mysqli_num_rows($sql) > 0){
        $component = array();
        while($data = mysqli_fetch_assoc($sql)){
            array_push($component, $data);
        }
    }
}


?>
<!doctype html>
<html class="no-js" lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>About | Entre  Femme</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <!--<link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favlogo.png" width="100%">-->
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
     .breadcrumb{
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
<?php include 'navbar.php';?>
<main>
    <div class="about-details">
        <div class="container">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
            <div class="row mt-3">
                <div class="col-lg-12 col-12">
                    <div class="p-5" style="background-image: url('assets/img/banner/img.png'); border-bottom: 5px solid #DF678B;">
                        <h2 class="text-center text-light">About Us</h2>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="about-details-cap mb-50">
                        <h4>Our Mission</h4>
                        <?php echo $component[0]['description'];?>
                        
                    </div>
                    <div class="about-details-cap mb-50">
                        <h4>Our Vision</h4>
                        <?php echo $component[1]['description'];?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .support-caption h1,h2,h3,h4,h5,h6{
            color: white;
        }
    </style>
    <!--? About Area Start-->
    <div class="mb-50 support-company-area pt-100 pb-100 section-bg fix" data-background="assets/img/gallery/section_bg02.jpg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="support-location-img">
                        <img src="assets/img/gallery/about.png" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="right-caption">
                        <!-- Section Tittle -->
                        <div class="section-tittles section-tittles2 ">
                            <span>more about us</span>
                        </div>
                        <div class="support-caption pr-3">
                            <?php echo $component[2]['description'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area End-->
    
    <!-- Team Start -->
    <!--<div class="team-area section-padding30">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="cl-xl-7 col-lg-8 col-md-10">-->
                    <!-- Section Tittle -->
    <!--                <div class="section-tittles mb-70">-->
    <!--                    <span>Our Professional members </span>-->
    <!--                    <h2>Our Team Mambers</h2>-->
    <!--                </div> -->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
                <!-- single Tem -->
    <!--            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">-->
    <!--                <div class="single-team mb-30">-->
    <!--                    <div class="team-img">-->
    <!--                        <img src="assets/img/gallery/team2.png" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="team-caption">-->
    <!--                        <h3><a href="#">Ethan Welch</a></h3>-->
    <!--                        <span>UX Designer</span>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">-->
    <!--                <div class="single-team mb-30">-->
    <!--                    <div class="team-img">-->
    <!--                        <img src="assets/img/gallery/team3.png" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="team-caption">-->
    <!--                        <h3><a href="#">Ethan Welch</a></h3>-->
    <!--                        <span>UX Designer</span>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">-->
    <!--                <div class="single-team mb-30">-->
    <!--                    <div class="team-img">-->
    <!--                        <img src="assets/img/gallery/team1.png" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="team-caption">-->
    <!--                        <h3><a href="#">Ethan Welch</a></h3>-->
    <!--                        <span>UX Designer</span>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Team End -->
    <!-- banner-last Start -->
    <!--<div class="banner-area gray-bg pb-90">-->
    <!--    <div class="container">-->
    <!--        <div class="row justify-content-center">-->
    <!--            <div class="col-lg-10 col-md-10">-->
    <!--                <div class="banner-one">-->
    <!--                    <img src="assets/img/gallery/body_card3.png" alt="">-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- banner-last End -->
</main>


<?php include 'footer.php';?>
</body>
</html>