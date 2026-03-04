<?php 
session_start();
include './config/config.php';

if(isset($_GET['name'])){
$cat = $_GET['name'];
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');

$stmt = mysqli_query($con, "INSERT INTO `searches` (`title`, `ip`, `date`) VALUES ('$cat', '$ip', '$date')");

}else{
    echo "<script> window.location.href='index.php'; </script>";
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo ucfirst($_GET['name']);?> - Entre Femme </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/logo/cleanlogo2.png">

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
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <div class="row">
                        <div class="col-12"><p>Looking for <b><?php echo $_GET['name'];?></b></p></div>
                        <hr>
                        <?php 



if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}


$no_of_records_per_page = 36;
$offset = ($pageno-1) * $no_of_records_per_page; 


$total_pages_sql = "SELECT COUNT(*) FROM post WHERE `title` LIKE '%$cat%'";
$result = mysqli_query($con, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM `post` WHERE `title` LIKE '%$cat%' LIMIT $offset, $no_of_records_per_page";
$stmt2 =mysqli_query($con, $sql);

$show = 1;
                       
    
    

                        if($stmt2){
                            if(mysqli_num_rows($stmt2) > 0){
                                while($row = mysqli_fetch_assoc($stmt2)){
                                    
    $count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `comment` WHERE `post_id` = '".$row['id']."'"));
    $day = explode(' ', $row['date']);                                
                                    
                                       print_r('
        
        <div class="col-lg-4 mt-2">
            <div class="weekly2-single">
                <div class="weekly2-img">
                    <img src="'.$row['picture'].'" alt="" width="100%" height="200vh">
                </div>
                <div class="weekly2-caption mt-2">
                    <span class="newcolor py-2 rounded">'.$row['category'].'</span>
                    <h5 class="mt-2"><a href="blog_details.php?id='.$row['id'].'">'.$row['title'].'</a></h5>
                    
                </div>
            </div> 
        </div>
                ');
                                }
                            
                            }else{
                              $show = 0;
                                
                                echo ' <div class="col-lg-12 mt-2">
                                <div class="weekly2-single">
                                    <h3>No result found of <b>'.$cat.'</b></h3>
                                </div>
                                </div>
                                
                                ';
                            }
                            
                        }else{
                            echo mysqli_error($con);
                        }
                        
                        ?>
                        
<ul class="pagination" id="paginat">
    
<li class="page-item <?php if($pageno <= $total_pages){ echo 'disabled'; }?> ">
    <a class="page-link" href="<?php echo $_SERVER['SCRIPT_NAME'].'?name='.$_GET['name'];?>&pageno=1">First</a>
</li>

<li class="page-item <?php if($pageno <= $total_pages){ echo 'disabled'; }?>">
<a class="page-link" href="<?php if($pageno <= 1){echo '#';} else {"&pageno=".($pageno - 1);}?>">Prev</a>
</li>

<li class="page-item <?php if($pageno <= $total_pages){ echo 'disabled'; }?>">
<a class="page-link" href="<?php echo $_SERVER['SCRIPT_NAME'].'?name='.$_GET['name']; if($pageno >= $total_pages){ echo '#'; } else {echo "&pageno=".($pageno + 1);}?>">Next</a>
</li>

<li class="page-item <?php if($pageno <= $total_pages){ echo 'disabled'; }?>">
<a class="page-link " href="<?php echo $_SERVER['SCRIPT_NAME'].'?name='.$_GET['name'];?>&pageno=<?php echo $total_pages; ?>">Last</a>
</li>

</ul>

<?php 

if(!$show){

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
                                        <input type="text" class="form-control" name="name" placeholder='Search Keyword'>
                                        <div class="input-group-append">
                                            <button class="btns" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                               
                               <?php 
        $c_query = mysqli_query($con, "SELECT * FROM `categories` ");
                            if($c_query){
                                if(mysqli_num_rows($c_query) > 0){
                                    while($cats = mysqli_fetch_assoc($c_query)){
        
        $co = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `post` WHERE `category` = '".$cats['cat_name']."'"));                          
                                
                                        print_r('
                                        <li>
                                    <a href="category.php?name='.$cats['cat_name'].'" class="d-flex">
                                        <p>'.$cats['cat_name'].'</p>
                                        <p>('.$co.')</p>
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
    if($rec){
        if(mysqli_num_rows($rec) > 0){
            while($recent = mysqli_fetch_assoc($rec)){
        
        // $stm = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name`")        
                print_r('
                <div class="media post_item">
                      <img src="'.$recent['picture'].'" alt="'.$recent['title'].'" width="100vw" height="100vw">
                <div class="media-body">
                    <p class="newcolor">'.$recent['category'].'</p>
                    <a href="blog_details.php?id='.$recent['id'].'">
                        <h3>'.$recent['title'].'</h3>
                    </a>
                    <p>'.$recent['date'].'</p>
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
 
<?php include './footer.php';?>  
 
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