<?php
session_start();

include_once('./config/config.php');


if (isset($_GET['id'])) {
   $id = $_GET['id'];

   $stmt = mysqli_query($con, "SELECT * FROM `post` WHERE `id` = '$id'");
   if ($stmt) {
      if (mysqli_num_rows($stmt) > 0) {


         $stmt2 = mysqli_query($con, "SELECT * FROM `comment` WHERE `post_id` = '$id'");
         $data = mysqli_fetch_assoc($stmt);

         $_SESSION['category'] = strtolower($data['category']);

         $data['views'] += 1;
         $view = $data['views'];
         $stmt = mysqli_query($con, "UPDATE `post` SET `views`= '$view' WHERE `id` = '$id'");

         $num_of_comments = mysqli_num_rows($stmt2);
      } else {
         echo "<script> alert('Article not Available'); window.location.href = './index.php'; </script>";
      }
   } else {
      echo "<script>alert('Sorry for Inconveniance - Server Under Maintenance'); window.location.href = './index.php';</script>";
   }
} else {
   echo "<script>window.location.href= './index.php';</script>";
}




$request = str_replace("blog_details.php?id=" . $_GET['id'] . "", "", $_SERVER['REQUEST_URI']);
$imgurl = 'https://' . $_SERVER['SERVER_NAME'] . $request . '/' . str_replace("../", "", $data['picture']);
?>



<!doctype html>
<html lang="en-US">
<meta charset="UTF-8">
<meta name="description" content="<?php echo $data['meta_description']; ?>">
<meta name="keywords" content="<?php echo $data['meta_keywords']; ?>">
<meta name="author" content="<?php echo $data['username']; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $data['meta_title']; ?> | Entre Femme | Spread Joy Everyday</title>

<link rel="manifest" href="">
<link rel="shortcut icon" type="image/x-icon" href="./assets/img/logo/cleanlogo.png">

<!-- CSS here -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" >
<link rel="stylesheet" href="assets/css/owl.carousel.min.css" >
<link rel="stylesheet" href="assets/css/ticker-style.css" >
<link rel="stylesheet" href="assets/css/flaticon.css" >
<link rel="stylesheet" href="assets/css/slicknav.css" >
<link rel="stylesheet" href="assets/css/animate.min.css" >
<link rel="stylesheet" href="assets/css/magnific-popup.css" >
<link rel="stylesheet" href="assets/css/fontawesome-all.min.css" >
<link rel="stylesheet" href="assets/css/themify-icons.css" >
<link rel="stylesheet" href="assets/css/slick.css" >
<link rel="stylesheet" href="assets/css/nice-select.css" >
<link rel="stylesheet" href="assets/css/style.css" >
<link rel="stylesheet" href="assets/css/sidemenu.css" >
<!--    <script type='text/javascript' src='//outbursttones.com/2e/e3/45/2ee345c43bef523b0e9f13e1c742ae98.js'></script> -->
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" defer>


<style>
   #details {
      font-family: "times" !important;
      font-weight: 400;
      line-height: 30px;
      font-size: 21px;
      color: #506172;
      text-align: justify;
   }

   #details a {
      color: #DF678B !important;
   }

   /*.blog_details blockquote{*/
   /*    text-align: left !important;*/
   /*    font-*/
   /*}*/

   /*.blog_details p{*/
   /*    font-size: 21px !important;*/
   /*line-height: 25px !important;*/
   /*    color: #22222 !important;*/
   /*    text-align: justify;*/
   /*    font-family: "Times" !important;*/
   /*}*/

   /*.single-post h1{*/
   /*    font-weight: 800;*/
   /*}*/

   #details blockquote {
      border-left: 5px solid gray;
      padding-left: 20px;
      /*font-size: 21px !important;*/
      text-align: justify;
   }

   #details ul {
      list-style: disc !important;
      padding-left: 15px !important;
      margin-left: 20px !important;
   }
   
   #details ol {
      list-style: disc !important;
      padding-left: 15px !important;
      margin-left: 20px !important;
   }

   #details li {
      list-style: disc !important;
   }

   p {
      font-family: "times";
      line-height: 30px;
      font-size: 21px;
   }
   .breadcrumb .breadcrumb-item a{
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

<meta property="og:url" content="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>">
<meta property="og:title" content="<?php echo $data['title']; ?>">
<meta property="og:type" content="article" />
<meta property="og:description" content="<?php echo $data['meta_description']; ?>">
<meta property="og:image" content="<?php echo $imgurl; ?>">
<!--<meta name="twitter:card" content="summary_large_image">-->





</head>

<body style="font-family: 'Roboto Condensed', sans-serif !important;">

   <!-- Preloader Start -->
   <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
         <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
               <img src="assets/img/logo/cleanlogo.png" width="150vw" alt="">
            </div>
         </div>
      </div>
   </div>
   <!-- Preloader Start -->


   <!-- Header -->
   <?php include 'navbar.php';

   $dcat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '" . $data['category'] . "' "));
   ?>

   <?php

   if (isset($_SESSION['category'])) {
      echo "<script> document.getElementById('" . $_SESSION['category'] . "').classList.add('active'); </script>";
   }

   ?>

   <main>
      <!--================Blog Area =================-->
      <section class="blog_area single-post-area py-5">
         <div class="container">

            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active"><a href="category.php?name=<?php echo strtolower($dcat['cat_name']); ?>" style="color: #DF678B;"><?php echo $dcat['cat_name']; ?></a></li>
  
               </ol>
            </nav>

            <div class="row">
               <div class="col-lg-8 posts-list">
                  <div class="single-post">
                     <div class="row my-1">

                     

                        <div class="col-lg-12">
                           <h1><b><?php echo $data['title']; ?></b></h1>
                           <p class="text-justify"><?php echo $data['short_title']; ?></p>
                        </div>
                        <?php $author = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE `name` = '" . $data['username'] . "'")); ?>

                        <div class="row px-4">
                           <div class="col-lg-12 col-12 text-center">
                              <ul class="blog-info-link mt-3 mb-4" id="bloginfo">
                                 <li class=""><a class="text-dark" href="<?php echo $data['authorlink']; ?>"><i class="fa fa-user"></i> <?php echo ucfirst($data['username']); ?></a></li>
                                 <li class=""><i class="fa fa-calendar"></i> <?php echo $data['date']; ?></li>
                                 <li class="d-none d-sm-block"><i class="fa fa-comments"></i> <?php echo $num_of_comments; ?> Comments</li>
                                 <li class="d-none d-sm-block"><i class="fa fa-eye"></i> <?php echo $data['views']; ?> Views</li>

                                 <!-- <li class="d-inline"> -->

                                 <!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v18.0" nonce="jqNkBpsh"></script> -->

                                 <!-- <div class="fb-share-button" data-href="<?php # echo $_SERVER['REQUEST_URI'];
                                                                              ?>" data-layout="button" data-size=""> -->
                                 <!-- <a target="_new" href="<?php #echo $_SERVER['REQUEST_URI']; 
                                                               ?>" class="fb-xfbml-parse-ignore" style="color: #635c5c !important;"></a> -->
                                 <!-- </div> -->

                                 <!-- </li> -->
                                 <li class="d-inline">

                                    <a style="color: #635c5c;" target="_blank" class="twitter-share-button" href="https://twitter.com/intent/tweet?text=https://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>">
                                       <i class="fab fa-twitter "></i></a>


                                 </li>
                                 <!--   <li class="d-inline"><a style="color: #635c5c;"  target="_new" href="<?php if (isset($_SESSION['instagram'])) {
                                                                                                                  echo $_SESSION['instagram'];
                                                                                                               } else {
                                                                                                                  echo '#';
                                                                                                               } ?>"><i class="fab fa-instagram px-2"></i></a></li> -->
                                 <li class="d-inline"><a style="color: #635c5c;" target="_new" href="https://www.reddit.com/submit?post=https://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"><i class="fab fa-reddit "></i></a></li>
                                 <li class="d-inline"><a style="color: #635c5c;" target="_new" href="mailto:?subject=<?php echo $data['title']; ?>&body=https://<?php echo $_SERVER['SERVER_NAME']; ?><?php echo $_SERVER['REQUEST_URI']; ?>"><i class="fa fa-envelope "></i></a></li>
                                 <!--  <li class="d-inline"><a style="color: #635c5c;"  target="_new" href="<?php if (isset($_SESSION['youtube'])) {
                                                                                                               echo $_SESSION['youtube'];
                                                                                                            } else {
                                                                                                               echo '#';
                                                                                                            } ?>"><i class="fab fa-youtube"></i></a></li> -->
                                 <li class="d-inline"><a style="color: #635c5c; cursor:pointer;" target="_new" onclick="navigator.clipboard.writeText('<?php echo "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>');alert('Article Copied');"><i class="fa fa-paperclip"></i></a></li>
                              </ul>
                           </div>
                        </div>
                     </div>

                     <div class="feature-img">

                        <a href="<?php echo $data['img_link']; ?>"><img class="img-fluid" width="100%" src="<?php echo str_replace("../", "", $data['picture']); ?>" alt="<?php echo $data['title']; ?>"></a>

                        <a class="pt-4 mt-6 text-dark" href="<?php echo $data['img_link']; ?>"><?php echo $data['img_title']; ?></a>
                     </div>
                     <div class="">

                        <div class="excert" id="details">
                           <?php echo $data['body']; ?>
                        </div>

                        <!--<div class="quote-wrapper">-->
                        <!--   <div class="quotes">-->
                        <!--      MCSE boot camps have its supporters and its detractors. Some people do not understand why you-->
                        <!--      should have to spend money on boot camp when you can get the MCSE study materials yourself at-->
                        <!--      a fraction of the camp price. However, who has the willpower to actually sit through a-->
                        <!--      self-imposed MCSE training.-->
                        <!--   </div>-->
                        <!--</div>-->

                     </div>
                  </div>
                  <script>
                     //   document.getElementsByTagName("ul").classList.add("");
                  </script>
                  <div class="navigation-top">
                     <div class="d-sm-flex justify-content-between">
                        <a href="action.php?like=<?php echo $_GET['id']; ?>">
                           <p class=""><span class=""><i class="fa fa-thumbs-up"></i></span> Like </p>
                        </a>
                        <p class="like-info"><span class=""><i class="fa fa-heart"></i></span> <?php echo $data['likes']; ?>
                           people like this</p>
                        <!--<div class="col-sm-4 text-center my-2 my-sm-0">-->
                        <!--<p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                        <!--</div>-->
                     </div>
                     <div class="navigation-area">
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                              <div class="thumb">
                                 <a href="blog_details.php?id=<?php echo $_GET['id'] - 1; ?>">
                                    <img class="img-fluid" src="assets/img/post/preview.png" alt="Previous Image">
                                 </a>
                              </div>
                              <div class="arrow">
                                 <a href="blog_details.php?id=<?php echo $_GET['id'] - 1; ?>">
                                    <span class="lnr text-white ti-arrow-left"></span>
                                 </a>
                              </div>
                              <div class="detials">
                                 <p>Prev Post</p>
                                 <!--<a href="#">-->
                                 <!--   <h4>Space The Final Frontier</h4>-->
                                 <!--</a>-->
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                              <div class="detials">
                                 <p>Next Post</p>
                                 <!--<a href="#">-->
                                 <!--   <h4>Telescopes 101</h4>-->
                                 <!--</a>-->
                              </div>
                              <div class="arrow">
                                 <a href="blog_details.php?id=<?php echo $_GET['id'] + 1; ?>">
                                    <span class="lnr text-white ti-arrow-right"></span>
                                 </a>
                              </div>
                              <div class="thumb">
                                 <a href="blog_details.php?id=<?php echo $_GET['id'] + 1; ?>">
                                    <img class="img-fluid" src="assets/img/post/next.png" alt="Next Image">
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--<div class="blog-author">-->
                  <!--   <div class="media align-items-center">-->
                  <!--      <img src="assets/img/blog/author.png" alt="">-->
                  <!--      <div class="media-body">-->
                  <!--         <a href="#">-->
                  <!--            <h4>Harvard milan</h4>-->
                  <!--         </a>-->
                  <!--         <p>Second divided from form fish beast made. Every of seas all gathered use saying you're, he-->
                  <!--            our dominion twon Second divided from</p>-->
                  <!--      </div>-->
                  <!--   </div>-->
                  <!--</div>-->
                  <div class="comments-area">
                     <h4><?php echo $num_of_comments . " "; ?> Comments</h4>

                     <?php
                     if ($stmt2) {
                        if ($num_of_comments > 0) {
                           while ($ro = mysqli_fetch_assoc($stmt2)) {
                              print_r('
        
        <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                           <i class="fa fa-user fa-4x"></i>
                            <!--  <img src="assets/img/comment/comment_1.png" alt="comments">-->
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 ' . $ro['body'] . '
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">' . $ro['name'] . '</a>
                                    </h5>
                                    <p class="date">' . $ro['date'] . ' </p>
                                 </div>
                                <!-- <div class="reply-btn">
                                    <a href="#" class="btn-reply text-uppercase">reply</a>
                                 </div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>                    
                            
                            
                            ');
                           }
                        }
                     }
                     ?>



                  </div>
                  <div class="comment-form">
                     <h4>Leave a Reply</h4>
                     <form class="form-contact comment_form" action="action.php" method="POST" id="commentForm">
                        <div class="row">

                           <div class="col-12">
                              <div class="form-group">
                                 <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <input class="form-control" name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
                                 <input class="form-control" name="name" id="name" type="text" placeholder="Name" requried>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <input class="form-control" name="email" id="email" type="email" placeholder="Email" requried>
                              </div>
                           </div>

                        </div>
                        <div class="form-group">
                           <button type="submit" name="addcomment" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="blog_right_sidebar">
                     <aside class="single_sidebar_widget search_widget">
                        <form action="#">
                           <div class="form-group">
                              <div class="input-group mb-3">
                                 <input type="text" class="form-control" placeholder='Search Keyword' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
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
                           $cat_query = mysqli_query($con, "SELECT * FROM `categories` WHERE `menu` = '1' AND `id` != '1'");
                           if ($cat_query) {
                              if (mysqli_num_rows($cat_query) > 0) {

                                 while ($cat = mysqli_fetch_assoc($cat_query)) {
                                    $st = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `post` WHERE `category` = '" . $cat['cat_name'] . "'"));

                                    print_r('
                        <li>
                           <a href="category.php?name=' . strtolower($cat['cat_name']) . '" class="d-flex">
                              <p><i class="fa fa-angle-double-right"></i> <b>' . $cat['cat_name'] . '</b></p>&nbsp;
                              <p>| <small>' . $st . ' posts</small></p>
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
                        $recent = mysqli_query($con, "SELECT * FROM `post` WHERE `status` = '0' ORDER BY `id` DESC LIMIT 4");

                        if ($recent) {
                           if (mysqli_num_rows($recent) > 0) {
                              while ($rec = mysqli_fetch_assoc($recent)) {

                                 print_r('
                    <div class="media post_item">
                        <img src="' . str_replace('../', ' ', $rec['picture']) . '" alt="post" width="100vw">
                        <div class="media-body">
                            <a href="category.php?name=' . strtolower($rec['category']) . '" style="color: #DF678B;">' . $rec['category'] . '</a>
                           <a href="blog_details.php?id=' . $rec['id'] . '">
                              <h3>' . $rec['title'] . '</h3>
                           </a>
                           <p>' . $rec['date'] . '</p>
                        </div>
                     </div>
                                ');
                              }
                           }
                        }

                        ?>

                     </aside>

                     <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>
                        <form action="subscribe.php" method="POST">
                           <div class="form-group">
                              <input type="email" name="email" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                           </div>
                           <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit" name="subscribe">Subscribe</button>
                        </form>
                     </aside>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--================ Blog Area end =================-->
   </main>

   <script>
      if (window.screen.width > 514) {
         document.getElementById('bloginfo').classList.remove('d-flex');
      } else {
         document.getElementById('bloginfo').classList.add('d-flex');
      }
   </script>
   <?php include 'footer.php'; ?>