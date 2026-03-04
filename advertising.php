<?php
include './config/config.php';
$sql = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'advertising'");
if($sql){
    if(mysqli_num_rows($sql) > 0){
        $data = mysqli_fetch_assoc($sql);
    }
}

?>
<!doctype html>
<html class="no-js" lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Advertising | Entre  Femme</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <!--<link rel="shortcut icon" type="image/x-icon" href="./assets/img/logo/cleanlogo2.png" width="100%">-->
    <link rel="icon" type="image/x-icon" href="./assets/img/logo/favlogo.png">
    
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
<main class="mb-50">
    <div class="about-details">
        <div class="container">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Advertising</li>
                </ol>
            </nav>
            <div class="row mt-3">
                <div class="col-lg-12 col-12">
                    <div class="p-5" style="background-image: url('assets/img/banner/img.png'); border-bottom: 5px solid #DF678B;">
                        <h2 class="text-center text-light">Advertising</h2>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="about-details-cap mb-50">
                        <h4>Advertising </h4>
           <?php echo $data['setting_value']; ?>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
   
</main>


<?php include 'footer.php';?>
</body>
</html>