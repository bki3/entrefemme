<?php  
ini_set('opcache.enable', 1);

    session_start();
    include './config/config.php';

 
    if(isset($_POST['subscribe'])){
        
        extract($_POST);
        $date = date('M d, Y');
        $quer = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `email` = '$email'");
        
        if($quer){
            if(mysqli_num_rows($quer) == 0){

                $quer2 = mysqli_query($con, "SELECT * FROM `subscriptions` ORDER BY `id` DESC");
            if($quer2){
                if(mysqli_num_rows($quer2) > 0){
                    $sid = mysqli_fetch_assoc($quer2)['id'];
                    $sid += 1;
                }else{
                    $sid = 1;
                }
		
		if(!isset($name)){
			$name = "Newsletter";
		}

                $query = mysqli_query($con, "INSERT INTO `subscriptions` (`id`, `name`, `email`,`date`) VALUES ('$sid', '$name','$email','$date')");
            
                if($query){
                    echo "<script>alert('Subscribed Successfully!'); window.location.href = 'index.php';</script>";   
                }else{
                    echo "<script>alert('Error: Failed to Update Records ".mysqli_error($con)."');</script>";
                }

            }else{
                    echo "<script>alert('Error: Failed to Update Records ".mysqli_error($con)."');</script>";
            }
            
            }else{
                    echo "<script>alert('Email Already Subscribed!'); window.location.href = 'index.php';</script>";   
            }
        }else{
            echo "<script>alert('Error: Mail Found Query: ".mysqli_error($con)."'); </script>";
        }
        
    }
    
$_SESSION['category'] = 'home page';


    $stmtee = mysqli_query($con, "SELECT * FROM `post` WHERE `status` = '0' ORDER BY `id` DESC LIMIT 6");
    $stmt2 = mysqli_query($con, "SELECT * FROM `post` WHERE `slider` = '1' AND `status` = '0' ORDER BY `id` DESC");
    $stmt3 = mysqli_query($con, "SELECT * FROM `post` WHERE `feature` = '1' AND `status` = '0' ORDER BY `id` DESC LIMIT 10 ");
    $stmt5 = mysqli_query($con, "SELECT * FROM `post` WHERE `status` = '0' ORDER BY `views` DESC  LIMIT 8");
    $stmt6 = mysqli_query($con, "SELECT * FROM `post` WHERE `status` = '0' ORDER by `id` DESC LIMIT 2");

   
$ip = $_SERVER['REMOTE_ADDR'];  //$_SERVER['REMOTE_ADDR']

$ipdat = json_decode(file_get_contents("https://api.hostip.info/get_json.php?ip=".$ip));

$country = $ipdat->country_name;
$place = $ipdat->country_code;
$city = $ipdat->city;

if($ipdat == NULL){
    $country = "N/A";
    $place = "N/A";
    $city = "N/A";
}

    $date = date('Y-m-d h:i:s');
    $datee = date('Y-m-d');

    
    $sql = "SELECT * FROM `visitors` WHERE `date` LIKE '%$datee%' and `ip` = '$ip'";
    $query = mysqli_query($con, $sql);
    
    
    if($query){
        if(mysqli_num_rows($query) == 0){
        
            $sql2 = "INSERT INTO `visitors` (`ip`, `city`, `region`, `country`, `date`, `timezone`) VALUES ('$ip', '$city', '$place', '$country', '$date', '')";
            $query2 = mysqli_query($con, $sql2);
            
            if(!$query2){
                echo mysqli_error($con); 
            }
        }

    }else{
        echo mysqli_error($con);
    }

$facebook = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `social` WHERE `platform` = 'facebook'"));
$metadesc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'metadesc'"));

$favicon = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'favicon'"))['setting_value'];



?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Entre Femme | Spread Joy Daily</title>
    <meta name="keywords" content="entrefemme, entre, entre femme, blog, article, entrefemme.com"><meta name="description" content="<?php echo $metadesc['setting_value']; ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon; ?>"><link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>"><meta http-equiv="Cache-control" content="public"><meta name="robots" content="follow, index, max-snippet: -1, max-video-preview: -1; max-image-preview: large;"><link href="assets/css/bootstrap.min.css" rel="stylesheet" defer><link rel="stylesheet" href="assets/css/owl.carousel.min.css" defer><link rel="stylesheet" href="assets/css/ticker-style.css" defer>
    <link rel="stylesheet" href="assets/css/flaticon.css" defer>
    <link rel="stylesheet" href="assets/css/slicknav.css" defer>
    <link rel="stylesheet" href="assets/css/animate.min.css" defer>
    <link rel="stylesheet" href="assets/css/magnific-popup.css" defer>
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css" defer>
    <link rel="stylesheet" href="assets/css/themify-icons.css" defer>
    <link rel="stylesheet" href="assets/css/slick.css" defer>
    <link rel="stylesheet" href="assets/css/nice-select.css" defer>
    <link rel="stylesheet" href="assets/css/style.css" defer>
    <link rel="stylesheet" href="assets/css/sidemenu.css" defer>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed">
    
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv='cache-control' content='no-cache'>
    <style>
        
    .card-body a{
        font-family: "Roboto", sans-serif !important;
        font-size: 17px;
        line-height: 19px;
        color: #666666;
        font-weight: 700;
    }
    
    
    .bg-trans{
         background-color: rgba(255,255,255, 0.8) !important;
    }

/*
@media only screen and (max-width: 480px) {
  
    .slick-slide{
        height: 65vw !important;
    }

    .trend-top-img{
        height: auto !important;
    }
}


@media only screen (min-width: 481px) and (max-width: 768px) {
  
    .slick-slide{
        height: 50vw !important;
    }

    .trend-top-img{
        height: auto !important;
    }
}


@media only screen (min-width: 769px) and (max-width: 1024px){
  
    .slick-slide{
        height: auto !important;
    }


   .trend-top-img{
        height: auto !important;
    }
}
*/

    </style>
    
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://entrefemme.com/">
<meta property="og:title" content="<?php echo $facebook['title']; ?>">
<meta property="og:description" content="<?php echo $facebook['description']; ?>">
<meta property="og:image" content="<?php echo str_replace('../','', $facebook['image']); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://entrefemme.com/">
<meta property="twitter:title" content="<?php echo $twitter['title']; ?>">
<meta property="twitter:description" content="<?php echo $twitter['description']; ?>">
<meta property="twitter:image" content="<?php echo str_replace('../','', $twitter['image']); ?>"><?php echo $adsense; ?><meta name="google-adsense-account" content="ca-pub-6316376535287964">
</head>

<body class="gray-bg">
    
<!-- Preloader Start -->
<!-- <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/cleanlogo.png" width="150vw" alt="">
            </div>
        </div>
    </div>
</div> -->
<!--  Preloader Start -->

<?php include 'navbar.php'; ?>

<!--------------------------
-------- Header End  -------
---------------------------->

<?php 

if(isset($_SESSION['category'])){
    echo "<script>document.getElementById('".$_SESSION['category']."').classList.add('active'); </script>";
}

?>


<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix pt-25 gray-bg">
        <div class="container">
            <div class="trending-main">
                <div class="row ">
                    
<div class="col-lg-2 d-none d-md-none d-lg-block d-sm-block d-xs-block">

<div class="row">
    <div class="col">
    
    <!-- Trending Top -->
    <div class="card bg-transparent p-2"  style="border: 1px solid gray;">
        <div class="card-body text-center text-shadow font-weight-bold"  style="border: 1px solid gray;">
            LATEST NEWS
        </div>
    </div>
    
    <?php  
    
    if($stmtee){
        if(mysqli_num_rows($stmtee) > 0){

            while($latest = mysqli_fetch_assoc($stmtee)){
                
$color = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '".$latest['category']."'"));

                
    print_r('
     <div class="card bg-transparent border-0 p-0">
        <div class="card-body px-0 pt-1">
            <div class="row p-0">
                <div class="col">
                    <a href="category.php?name='.$latest['category'].'"><span class="'.$color['color'].'"> '.$latest['category'].'</span></a>
                    
                    <h6><a href="blog_details.php?id='.$latest['id'].'">'.$latest['title'].'</a></h6>
                </div>
            </div>
        </div>
    </div>
    <hr style="background-color: gray !important; height: 1px; " class="p-0 my-1">
                ');
            }
            
        }else{
             print_r('
     <div class="card bg-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <p class="m-0">No Latest News at the Moment</p>
                </div>
            </div>
        </div>
    </div>
                ');
        }
    }else{
        echo mysqli_error($con);
    }
    
    
    ?>
    <a href="blog.php"><button class="btn btn-primary btn-sm w-100 p-3">VIEW ALL POSTS</button></a>
    
    
    </div>
</div>



<?php 

$adone = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adone'");
if($adone){
    if(mysqli_num_rows($adone) > 0){
        $adon=mysqli_fetch_assoc($adone);
    }
} 
?>
<!--left side banner Ad-->
<div class="row">
    <div class="col">
       <div class="home-banner2 d-none d-lg-block mt-3">
            <img src="<?php echo trim(strtolower(str_replace("../","",$adon['setting_value']))); ?>" alt="<?php echo trim(strtolower($adon['setting_name'])); ?>" height="auto" width="100%">
        </div>
    </div>
</div>


<!--left side banner Ad-->
<div class="row my-3">
    <div class="col-12">
        <!-- Trending Top -->
    <div class="card bg-transparent p-2"  style="border: 1px solid gray;">
        <div class="card-body text-center text-shadow font-weight-bold"  style="border: 1px solid gray;">
            PODCAST
        </div>
    </div>
        <!--<h4 style="color: #e83e8c; text-align:center;">Podcast</h4>-->
  
 <div id="demo" class="carousel slide" data-ride="carousel" data-interval="4000">


  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      
        <div class="card border-0 gray-bg" style="width:100%">
            <a href="https://podcasts.apple.com/us/podcast/entre-femme/id1557174991">
                <center><img class="card-img-top w-75" src="assets/img/podcasts/apple.webp" alt="Apple"></center>
            </a>
        </div>
      
    </div>
    <div class="carousel-item">
      
        <div class="card border-0 gray-bg" style="width:100%">
            <a href="https://open.spotify.com/show/10b1xGI1sVoRcIMjjR4A0R">
                <center><img class="card-img-top w-75" src="assets/img/podcasts/spotify.webp" alt="Card image"></center>
            </a>
        </div>
      
    </div>
    <div class="carousel-item">
        
        <div class="card border-0 gray-bg" style="width:100%">
            <a href="https://www.stitcher.com/podcast/entre-femme">
                <center><img class="card-img-top w-75" src="assets/img/podcasts/stitcher.webp" alt="Card image"></center>
            </a>
        </div>
     
     
    </div>
    
    <div class="carousel-item">
        
        <div class="card border-0 gray-bg" style="width:100%">
            <a href="https://music.amazon.com/podcasts/073d3b22-54db-4504-af92-5a3ae3a78bf5/Entre-Femme">
                <center><img class="card-img-top w-75" src="assets/img/podcasts/amazon.webp" alt="Card image"></center>
            </a>
        </div>
     
     
    </div>
    
    <div class="carousel-item">
        
        <div class="card border-0 gray-bg" style="width:100%">
            <a href="https://www.youtube.com/@entrefemme7750">
                <center><img class="card-img-top w-75" src="assets/img/podcasts/youtube.webp" alt="Card image"></center>
            </a>
        </div>
     
     
    </div>
    
    <div class="carousel-item">
        
        <div class="card border-0 gray-bg" style="width:100%">
            <a href="https://www.google.com/podcasts?feed=aHR0cHM6Ly9mZWVkcy5yZWRjaXJjbGUuY29tL2YwMzY0YzMxLTAyNzYtNGNiMi1iYmExLWYwODcwYzA3MmExNQ%3D%3D">
              <center><img class="card-img-top w-75" src="assets/img/podcasts/google.webp" alt="Card image"></center>
            </a>
        </div>
     
     
    </div>
    
    <div class="carousel-item">
        
        <div class="card border-0 gray-bg" style="width:100%">
            <a href="https://radiopublic.com/entre-femme-69wY5w">
                <center><img class="card-img-top w-75" src="assets/img/podcasts/radiopublic.webp" alt="Card image"></center>
            </a>
        </div>
     
    </div>
    
  </div>



</div>


    <div class="text-center"><h6>Check out our latest podcast episodes</h6></div>
    </div>
</div>


<div class="row mt-4">
    <div class="col">
        <div>
            <hr style="background-color: gray !important; height: 1px; " class="p-0 my-1">
            <h6 class="d-block">
                <b>Whats your favorite News Category?</b>
            </h6>
            <form method="POST" action="action.php">
    
    <?php 
    
    $stmteee = mysqli_query($con, "SELECT * FROM `categories` WHERE `menu` = '1' AND `id` != '1'");
    if($stmteee){
        if(mysqli_num_rows($stmteee) > 0){
            while($cat_row = mysqli_fetch_assoc($stmteee)){
                print_r('
                
                <hr style="background-color: gray !important; height: 1px;" class="p-0 my-1">
                <label class="d-block"><input type="radio" name="cat" value="'.$cat_row['cat_name'].'"> '.$cat_row['cat_name'].'</label>
                
                ');
            }
        }
    }
    ?>       
                
                <hr style="background-color: gray !important; height: 1px; " class="p-0 my-1">
                <label class="d-block"><input type="submit" class="btn btn-info" name="vote" value="Vote"></label>
            </form>
        </div>
    </div>
</div>




</div>                
    
    
<!--
  -------------------------------------
--- top middle section starts here ------
  -------------------------------------
-->
<div class="col-lg-6">
    <!-- Trending Top -->
    <div class="slider-active mb-2">
        <!-- Single -->
        
      
    <?php  
    
    if($stmt2){
        if(mysqli_num_rows($stmt2) > 0){
            
            while($slider = mysqli_fetch_assoc($stmt2)){

$color2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '".$slider['category']."'"));

                     
                print_r('
    <div class="single-slider">
        <div class="trending-top mb-30">
            <div class="trend-top-img">
                <a href="blog_details.php?id='.$slider['id'].'">
                <img src="'.str_replace("../","",$slider['picture']).'" width="100%" alt="'.$slider['category'].'" height="auto"></a>
                <div class="trend-top-cap">
                    <a href="category.php?name='.$slider['category'].'">
                    <span class="newcolor2 bg-trans p-1 rounded-0 text-capitalize mb-1 shadow shadow-sm p-0" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms">'.$slider['category'].'</span>
                    </a>
                    <h4 class="text-light"><a href="blog_details.php?id='.$slider['id'].'" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms">'.ucfirst($slider['title']).'</a></h4>
                    <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms"></p>
                </div>
            </div>
        </div>
    </div>
                ');
            }
            
        }else{
             print_r('
     
        <div class="single-slider">
            <div class="trending-top mb-30">
                <div class="trend-top-img">
                    <img src="assets/img/trending/trending_top02.jpg" width="100%" height="auto" alt="sample">
                    <div class="trend-top-cap">
                        <span class="bgr" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms">Business</span>
                        <h4 class=" "><a href="" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms">Anna Lora Stuns In White At Her Australian Premiere</a></h4>
                        <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">by Alice cloe   -   March 1, 2023</p>
                    </div>
                </div>
            </div>
        </div>
                ');
        }
    }
    
    
    ?>

    </div>
    
    
    
    <!-- Featured News Left Side -->
    <div class="card bg-transparent p-2"  style="border: 1px solid gray;">
        <div class="card-body text-center text-shadow font-weight-bold"  style="border: 1px solid gray;">FEATURED NEWS</div>
    </div>
    
    <!-- Slider -->
    <div class="row">
       

    <?php
    if($stmt3){
        if(mysqli_num_rows($stmt3) > 0){
            
            while($feature = mysqli_fetch_assoc($stmt3)){
                
 $color3 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '".$feature['category']."'"));
 
               
                print_r('
    
        <div class="col-lg-6 mt-2">
            <div class="weekly2-single">
                <div class="weekly2-img">
                    <a href="blog_details.php?id='.$feature['id'].'"><img src="'.str_replace("../","",$feature['picture']).'" alt="" width="100%" height="auto"></a>
                </div>
                <div class="weekly2-caption mt-2">
                    <a href="category.php?name='.$feature['category'].'"><span class="'.$color3['color'].' py-2 ">'.$feature['category'].'</span></a>
                    <h5 class="mt-2"><a href="blog_details.php?id='.$feature['id'].'">'.$feature['title'].'</a></h5>
                </div>
            </div> 
        </div>
                ');
            }
            
        }else{
             print_r('
     
        <div class="col-lg-6 mt-2">
            <!-- Single -->
            <div class="weekly2-single">
                <div class="weekly2-img">
                    <img src="assets/img/trending/trending_top03.jpg" alt="no image" width="100%" height="auto">
                </div>
                <div class="weekly2-caption">
                    <span class="bg-warning py-2 rounded">Fitness</span>
                    <h5 class="my-2"><a href="#">Scarlett’s disappointment at latest accolade</a></h5>
                    
                    <p><i class="fas fa-calendar-alt"></i> 3-3-2023</p>
                    <h6>Struggling to sell one multi-million dollar home currently on the market won’t stop actress and singer Jennifer Lopez. </h6>
                </div>
            </div> 
        </div>
                ');
        }
    }
    
    
    ?>
    
    
        

    </div>
    <!-- row end here -->


<!-- Trending Top -->
<div class="card bg-transparent p-2" style="border: 1px solid gray;" id="unique">
        <div class="card-body text-center text-shadow font-weight-bold" style="border: 1px solid gray;">WATCH</div>
</div>

<!-- Slider -->


<div class="row mt-2">
    
    
    <?php  
    $unique = '';
    
$uq = mysqli_query($con, "SELECT * FROM `videos` ORDER BY `id` DESC LIMIT 2");
        
if($uq) { 
    while($uni = mysqli_fetch_assoc($uq)){
        echo '  
    <div class="col-lg-6 col-12" >
            <a href="'.$uni['link'].'"><img src="'.$uni['picture'].'" height="auto" width="100%" alt="no image">
            <h5 class="text-dark">'.$uni['title'].'</h5></a>
    </div>';
    }
}
    
    ?>
       
        
   
    
</div>
<!--row end here-->
 
    
</div>
<!-- col-lg-8 end here -->





<!-------------------------------------------------
------------------ Right content ------------------
--------------------------------------------------->

<div class="col-lg-4">

    <!-- Trending Top -->
   <div class="card bg-transparent p-2"  style="border: 1px solid gray;">
        <div class="card-body text-center text-shadow font-weight-bold"  style="border: 1px solid gray;">POPULAR NEWS</div>
    </div>
 
<?php
 
    if($stmt5){
        if(mysqli_num_rows($stmt5) > 0){
            
            while($popular = mysqli_fetch_assoc($stmt5)){
                
    
 $color33 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '".$popular['category']."'"));       
                print_r('
    
    <div class="card bg-transparent border-0 p-0">
        <div class="card-body px-2">
            <div class="row">
                <div class="col-4 mr-1">
                    <a href="blog_details.php?id='.$popular['id'].'"><img src="'.str_replace("../","",$popular['picture']).'" alt="no image" width="125%" height="auto"></a>
                </div>
                <div class="col-7">
                        
                     <a href="category.php?name='.$popular['category'].'">
                     <span class="'.$color33['color'].' py-2">'.$popular['category'].'</span></a>

                    <h5 class=""><a href="blog_details.php?id='.$popular['id'].'">'.$popular['title'].'</a></h5>
                </div>
            </div>
        </div>
    </div>
    <hr style="background-color: gray !important; height: 1px; " class="p-0 my-1">

                ');
            }
            
        }else{
             print_r('
     
       
    <div class="card bg-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-3 mr-1">
                    <img src="assets/img/gallery/most_recent1.png" width="100%" height="auto" alt="">
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


$adtwo = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adtwo'");
if($adtwo){
    if(mysqli_num_rows($adtwo) > 0){
        $adtw=mysqli_fetch_assoc($adtwo);
    }
}


    ?>
    
    
<!--right ad-->
<div class="home-banner2 d-none d-lg-block mt-3">
    <img src="<?php echo trim(strtolower(str_replace("../","",$adtw['setting_value']))); ?>" alt="<?php echo trim(strtolower($adtw['setting_name'])); ?>" height="auto" width="100%">
</div>

 <!-- Trending Top -->
   <div class="mt-2 card bg-transparent p-2"  style="border: 1px solid gray;">
        <div class="card-body text-center text-shadow font-weight-bold"  style="border: 1px solid gray;">MOST COMMENTED</div>
    </div>

<?php
 
    if($stmt6){
        if(mysqli_num_rows($stmt6) > 0){
            
            while($bottom = mysqli_fetch_assoc($stmt6)){
                
$color77 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '".$bottom['category']."'")); 
    
    print_r('
    
        <div class="slider-active">
            <div class="single-slider my-0">
                <div class="trending-top p-0 my-2">
                    <div class="trend-top-img h-100">
                        <a href="blog_details.php?id='.$bottom['id'].'"><img src="'.str_replace("../","",$bottom['picture']).'" alt="" width="100%" height="auto"></a>
                    <div class="trend-top-cap">
                        <a href="category.php?name='.$bottom['category'].'"><p class="newcolor bg-trans text-center p-0 shadow shadow-lg" style="width:70px">'.$bottom['category'].'</p></a>
                        <h6 class="text-light"><a href="blog_details.php?id='.$bottom['id'].'">'.$bottom['title'].'</a></h6>
                    </div>
                    </div>
                </div>
            </div>
        </div>

                ');
            }
            
        }else{
             print_r('
     
        <div class="slider-active">
            <div class="single-slider">
                <div class="trending-top my-3 p-0">
                   <div class=""><h1>No Records Found</h1></div>
                </div>
            </div>
        </div>

                ');
        }
    }
    
    
    ?>
     <!--shadow shadow-lg bg-light w-25 text-center rounded-2-->

                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
    

    
    
    <div class="container-fluid my-4 bg-black border-1 border-top rounded-2 p-4 ">
    <div class="row">
    
    <!--<div class="col-2"></div>-->
    
    <div class="col">
        
      <aside class="single_sidebar_widget newsletter_widget align-items-center">
          
         <h4 class="widget_title font-weight-bold text-center text-uppercase p-0">Join our newsletter and never miss out on our latest Articles!</h4>
         <p class="text-center p-0"><small><i>Subscribe to our newsletter for the latest blog articles while we ensure your privacy is respected.</i></small></p>
         
         <form method="POST">
            <div class="row" id="subscribe_row">
               <div class="col-5 p-1">
               <input type="text" name="name" class="form-control rounded-0" onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Enter Your Name'" placeholder='Your Name' required>
               </div>
               <div class="col-6 p-1">
               <input type="email" name="email" class="form-control rounded-0" onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Your Email Address'" placeholder='Your Email Address' required>
               </div>
               <div class="col-1 p-1">
            <button class="rounded-0 px-2 py-1 m-0 bg-dark" type="submit" name="subscribe">
                <i class="fa fa-paper-plane text-light"></i>
            </button>
               </div>
            </div>
         </form>
      </aside>
    </div>
    
    
    </div>
    </div>
    
    
</main>


<?php include 'footer.php';?>

