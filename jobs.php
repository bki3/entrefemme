<?php 
session_start();
include './config/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>
<!doctype html>
<html class="" lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Jobs | Entre  Femme</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <!--<link rel="shortcut icon" type="image/x-icon" href="./assets/img/logo/cleanlogo2.png">-->
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
    <?php echo $adsense; ?>
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
<?php include 'navbar.php';?>

<main>
    <div class="about-details section-padding30">
        <div class="container">
        <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jobs</li>
                    </ol>
                </nav>
            
<?php 
    if(isset($_GET['id']) and !empty($_GET['id'])){
    
    $stmt = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `jobs` WHERE `id` = '".$_GET['id']."'"));
    
        print_r('
         <div class="row">
            <div class="offset-col-1 col-lg-8">
                <div class="about-details-cap mb-50">
                    <h4>Jobs Description</h4>
                    <p>'.$stmt['description'].'</p>
                    
                    <form method="POST" action="applications.php" enctype="multipart/form-data">
                        <div class="row my-3">
                            <div class="col"><h4>Apply Now</h4></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control my-2" name="fullname" placeholder="Full Name">
                            </div>
                            <div class="col">
                                <input type="email" class="form-control my-2" name="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control my-2" name="contact" placeholder="Phone Number">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control my-2" name="city" placeholder="City and Country">
                            </div>
                        </div>
                         <div class="row">
                            <div class="col">
                            <label>Resume</label>
                                <input required type="file" class="form-control my-2" name="resume">
                            </div>
                            <div class="col">
                            <label>Cover Letter</label>
                                <input required type="file" class="form-control my-2" name="cover">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-dark px-3  my-2" name="send" value="Apply Now">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ');
        
        
    }else{
?>            
            
            <!--row starts here-->
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-details-cap mb-50">
                        <h4>Jobs Opportunities </h4>
            <p>Welcome to the Jobs Page of Entre Femme, where we help connect talented women with opportunities to achieve their career goals.</p>
            
<p>We understand the challenges women face in the workforce, and we are committed to providing resources and support to help you thrive. Here, you'll find job postings from companies that share our commitment to diversity, equity, and inclusion in the workplace.</p>

<p>We feature a wide range of positions, from entry-level roles to executive positions, across a variety of industries. Our job listings are updated regularly, so be sure to check back often for new opportunities.</p>

<p>In addition to job postings, we also provide career advice and resources to help you navigate the job market. From resume writing tips to interview preparation, we want to empower you with the tools you need to succeed.</p>


<p>At Entre Femme, we believe that every woman has the potential to excel in her career, and we are here to support you every step of the way. Whether you're just starting out or looking to make a career change, we invite you to explore our job listings and join our community of ambitious women.</p>

<p>So what are you waiting for? Start your job search today and take the first step towards building the career of your dreams.</p>


                    </div>
  
                </div>
                <div class="col-lg-4">
                    <div class="about-details-cap mb-50">
                        <h3>Careers</h3>
                        <form>
                            <select class="form-control my-2" name="depart">
                                <option>-- choose department --</option>
<?php 
$stmt2 = mysqli_query($con, "SELECT * FROM `jobs`");
 if($stmt2){
    if(mysqli_num_rows($stmt2) > 0){
        while($row = mysqli_fetch_assoc($stmt2)){
            print_r('
                <option>'.$row['department'].'</option>
            ');
        }
        
    }
 }
?>
                            </select>
                            
                            <select class="form-control my-2" name="office">
                                <option>-- Choose Office Location --</option>
                                
<?php 
$stmt3 = mysqli_query($con, "SELECT * FROM `jobs`");
 if($stmt3){
        if(mysqli_num_rows($stmt3) > 0){
            while($row2 = mysqli_fetch_assoc($stmt3)){
                print_r('
                    <option>'.$row2['office'].'</option>
                ');
            }
            
        }
 }
?>                                
                            </select>
                            
                            <input type="submit" class="my-2 btn btn-sm btn-dark" value="Find">
                        </form>
                    </div>
                    
                    <div class="">
                        
    <!-- Trending Top -->
    <div class="card bg-transparent">
        <div class="card-body text-center">Available Posts</div>
    </div>
 
<?php

if(isset($_GET['office']) and !empty($_GET['office'])){
    $office = $_GET['office'];
    $stmt = mysqli_query($con, "SELECT * FROM `jobs` WHERE `office` = '$office'");
}

if(isset($_GET['depart']) and !empty($_GET['depart'])){
    $depart = $_GET['depart'];
    $stmt = mysqli_query($con, "SELECT * FROM `jobs` WHERE `department` = '$depart'");
}


if(isset($_GET['depart']) and isset($_GET['office']) and !empty($_GET['depart']) and !empty($_GET['office'])){
    $depart = $_GET['depart'];
    $office = $_GET['office'];
    $stmt = mysqli_query($con, "SELECT * FROM `jobs` WHERE `department` = '$depart' AND `office` = '$office'");
}

if(!isset($_GET['depart']) and !isset($_GET['office'])){
    $stmt = mysqli_query($con, "SELECT * FROM `jobs`");
}


 
    if($stmt){
        if(mysqli_num_rows($stmt) > 0){
            
            while($popular = mysqli_fetch_assoc($stmt)){
                
                print_r('
    
    <div class="card bg-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mr-1">
                    <h3>'.$popular['title'].'</h3>
                    <p class="m-0">Position: '.$popular['department'].' <br>Office: '.$popular['office'].'</p>
                    <h6 class="text-center rounded bg-dark text-light p-1"><a class="p-1" href="jobs.php?id='.$popular['id'].'">Apply Now</a></h6>
                </div>
            </div>
        </div>
    </div>

                ');
            }
            
        }else{
            echo "<span>No Vacancies Available at the moment</span>";
        }
    }
    
    
    ?>
                        
                    </div>
                </div>
            </div><!--row ends here-->
            
<?php } ?>            
            
        </div>
    </div>
   
</main>

<!-- Search model Begin -->
<div class="search-model-box" >
    <div class="d-flex align-items-center h-100 justify-content-center">
        <div class="search-close-btn">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Searching key.....">
        </form>
    </div>
</div>
<!-- Search model end -->


<?php include 'footer.php';?>
</body>
</html>