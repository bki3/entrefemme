

<?php
 include_once('config/config.php');  
 $ssq=mysqli_query($con, "SELECT * FROM `settings`");
 
 $shoplink = $facebook = $twitter = $youtube = $instagram = $service_link = "#";
 
 if($ssq){
     if(mysqli_num_rows($ssq) > 0){
         
         while($rs=mysqli_fetch_assoc($ssq)){
             
             if($rs['setting_name'] == 'facebook'){
                 $facebook = $rs['setting_value'];
             }
             
             if($rs['setting_name'] == 'twitter'){
                 $twitter = $rs['setting_value'];
             }
             
             if($rs['setting_name'] == 'youtube'){
                 $youtube = $rs['setting_value'];
             }
             
             if($rs['setting_name'] == 'instagram'){
                 $instagram = $rs['setting_value'];
             }

             if($rs['setting_name'] == 'shoplink'){
                 $shoplink = $rs['setting_value'];
             }

             if($rs['setting_name'] == 'service_link'){
                 $service_link = $rs['setting_value'];
             }
             
         }
     }
 }

?>
<script src="./widgets/latest/dwf.js" defer></script>


<script>window.gtranslateSettings = {"default_language":"en","languages":["en","fr"],"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"inline","switcher_open_direction":"bottom","alt_flags":{"en":"usa"}}</script>

<style>
  
  
td#translator span div .gt_selected{
    width: 75px;
    display: block;
    background-color: #f4f4f4 !important;
}

td#translator span div .gt_selected a{
    width: 75px;
    border: 0;
    display: block;
    font-size: 1vw;
    padding: 0 !important;
    background-color: #f4f4f4 !important;
}

td#translator span div{
    width: 75px;
    display: block;
    background-color: #f4f4f4 !important;
    border: 0 !important;
}
td#translator a::after{
    display:none;
}

.gt_container--hich1m .gt_switcher a img{
    width: 15px !important;
    height: 15px !important;
    border-radius: 50% !important;
    border: 0 !important;
}

.gt_container--hich1m .gt_switcher a{
    font-size: 1vw !important;
    border: 0 !important;
    color: black !important;
}


.gt_container--hich1m .gt_switcher .gt_option a {
    color: #000;
    padding: 4px 0px !important;
}


@media screen and (min-width: 1600px) {
      
    .gt_container--hich1m .gt_switcher .gt_option a {
        padding: 0px 0px !important;
    }
    
    .gt_container--hich1m .gt_switcher a{
        font-size: 0.6vw !important;
    }

}


   .header-area .header-mid .header-banner img{
        width: auto !important;
    }  


@media screen and (max-width: 425px) {
    p{
        text-align: left !important;
        align-content: start !important;
        align-items: start !important;
    }

    footer a, footer span {
        font-size: 3vw !important;
    }

    td#translator span div .gt_selected a {
        width: 85px;
        font-size: 2.9vw !important;
        background-color: #f4f4f4 !important;
        color: black !important;
    }

    .gt_container--hich1m .gt_switcher .gt_option a {
        color: #000;
        width: 85px;
        font-size: 2.9vw !important;
        background-color: #f4f4f4 !important;
        color: black !important;
        
    }
    
    .header-area .header-mid .header-banner img {
         width: 30px !important;
         height: 30px !important;
    }
    
    /*.header-mid{*/
        /*background-color: #DF678B;*/
    /*}*/

    #searchtd{
        color: black !important;
    }
    
    #searchtd a i{
        font-size: 4vw !important;
    }
    
    #translator span{
        display: block;
        width: 50px !important;
        text-align: center;
        padding-left: 5px !important;
    }
    
    #mySidenav a {
        font-size: 3vw !important;
        margin-bottom: 2%;
    }
    

    #mySidenav, #sideshowbtn{
        z-index: 999999 !important;
        display:none;
    }
    

    #shopspan{
        display:none;
    }
    
    #subspan{
        display:none;
    }
    
    .header-bottom{
        /*height: 50px !important;*/
    }


    table tr td{
        text-align:center !important;
        padding: 0;
        margin:0;
    }
    
    #cookiebox{
        text-align: center;
        font-size: 2vw !important;
    }
}

h1,h2,h3,h4,h5,h6{
    text-align: left !important;
}


    
</style>


<!-- Header -->

<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header">
            
            <div class="header-mid gray-bg">
                <div class="container">
                    <div class="row d-flex align-items-center p-3">
                        <!-- Logo -->
                        <div class="col-xl-7 col-lg-7 col-md-4 col-12 d-none d-md-block">
                            <div class="logo">
                                <a href="index.php" class="text-dark">
                                    <img src="assets/img/logo/cleanlogo2.png" height="60" width="140" alt="entre femme"> | Unlock Success with Our Guide
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-xl-5 col-lg-5 col-md-8 col-12">
                            <div class="header-banner ">

<table width="100%" class="">
    <tr>
         <td id="searchtd" class=""><a class="mx-2"><i onClick="search()" class="fa fa-search"></i></a> </td>
        <td class="border-1 border-right" id="translator" class=""><span class="gtranslate_wrapper"></span></td>
        <td class="border-1 border-right"><a href="<?php echo $shoplink; ?>" class="mx-2 text-dark"><i class="fas fa-shopping-cart rounded-circle p-2 text-light" style="background-color:#3d1657;"></i> <span id="shopspan">Shop</span> </a>  </td>
        <td><a class="mx-2 text-dark" style="cursor:pointer;" id="myBtn" onClick="subscription()"><i class="fas fa-envelope rounded-circle p-2 text-light" style="background-color:#3d1657;"></i> <span id="subspan">Subscribe</span></a></td>
        <td id="sideshowbtn"><!-- Use any element to open the sidenav -->
            <!--<span >-->
                <!--<i style="font-size:22px;" class="fas fa-bars"></i>-->
        <span onclick="openNav()" style="cursor:pointer;" id="morebtn" class="sc-iyvn34-0 keEGDF icon-hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" aria-label="Hamburger24 icon" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M21.5 21a.5.5 0 0 1 .09 1H2.5a.5.5 0 0 1-.09-1H21.5zm0-9a.5.5 0 0 1 .09 1H2.5a.5.5 0 0 1-.09-1H21.5zm0-9a.5.5 0 0 1 .09 1H2.5a.5.5 0 0 1-.09-1H21.5z"></path></svg></span>
        
                <!--</span>-->
        </td>
    </tr>
</table>       



<style>
    #mySidenav a{
        font-size: 1vw;
        margin-bottom: 2%;
    }
    .fa-close{
        color: #000 !important;
    }
</style>


  
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn pt-4" onclick="closeNav()"><i class="fa fa-close fa-2x"></i></a>
  <!-- <li><img src="assets/img/logo/cleanlogo.png" style="width:10vw;" alt="right_logo"></li> -->
  <ul style="">
  <hr class="m-0 my-1 p-0">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="blog.php" >Blog</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="topics.php">Topics</a></li>
        <li><a href="<?php echo $service_link; ?>">Services</a></li>
        <li><a href="testimonials.php">Testimonials</a></li>
        <li><a href="faq.php">FAQs</a></li>
        <li><a href="privacy.php">Privacy Policy</a></li>
         
        <hr class="m-0 my-2 p-0">
        <li><a href="privacy.php">PRIVACY </a></li>
        <li><a href="jobs.php" >JOBS</a></li>
        <li><a href="terms.php">TERM OF USE</a></li>
        <li>
            <a href="<?php echo $facebook; ?>" target="_new" class="d-inline"><i style="color: #0B5FCC" class=" fab fa-facebook-square fa-facebook"></i ></a>
            <a href="<?php echo $twitter; ?>" target="_new" class="d-inline" ><i class="  text-info  fab fa-twitter"></i></a>
            <a href="<?php echo $instagram; ?>" target="_new" class="d-inline" ><i style="color: #992180;" class=" text-  fab fa-instagram"></i></a>
            <a href="<?php echo $youtube; ?>" target="_new" class="d-inline"><i class=" text-danger  fab fa-youtube"></i></a>
            <a href="feed.rss" class="d-inline" target="_new"><i style="color: #8b8b8b " class="fa fa-rss"></i></a>
        </li>
        <li><a style="text-transform: uppercase;">© <?php echo date('Y');?> - Entre Femme </a></li>
    </ul>
</div>



<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->

<script>
    /* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 header-flex">
                            <!-- sticky -->
                            <div class="sticky-logo">
                                <a href="index.php">
                                    <img src="assets/img/logo/cleanlogo.png" width="150vw" alt="">
                                </a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-md-block align-items-center">
                                <nav>                  
                                    <ul id="navigation">
    <?php 
    
                           
            $err = 0;                        
            $stmt = mysqli_query($con, "SELECT * FROM `categories` WHERE `menu` = '1' AND `status` = '0'");
            if($stmt){
                
                if(mysqli_num_rows($stmt) > 0){
                    
                    while($mrow=mysqli_fetch_assoc($stmt)){
                        
                        if($mrow['id'] == '1'){
                            print_r('
                             <li id="'.strtolower($mrow['cat_name']).'" class=""><a href="index.php">'.strtoupper($mrow['cat_name']).'</a></li>
                            ');
                        }else{
                            
                        print_r('
                            
                            <li  id="'.strtolower($mrow['cat_name']).'" class=""><a href="category.php?name='.strtolower($mrow['cat_name']).'">'.strtoupper($mrow['cat_name']).'</a></li>
                        
                        ');
                        
                        }
                    }
                    
                }else{
                    $err = 1;
                }
            }else{
                $err = 1;
                
                
            }               
            
            if($err == '1'){                        
                                    ?>
                                        <li  id="health" class=""><a href="category.php?name=health">HEALTH</a></li>
                                        <li id="technology" class=""><a href="category.php?name=technology" >TECHNOLOGY</a></li>
                                        <li id="travel" class=""><a href="category.php?name=travel" >TRAVEL </a></li>
                                        <li id="fashion" class=""><a href="category.php?name=fashion" >FASHION</a></li>
                                        <li id="food" class=""><a href="category.php?name=food" >FOOD</a></li>
                                        <li id="finance" class=""><a href="category.php?name=finance"  >FINANCE </a></li>
                                        <li id="personal" class=""><a href="category.php?name=personal">PERSONAL </a></li>
                                        <li id="culture" class=""><a href="category.php?name=culture" >CULTURE </a></li>
                                        <li id="lifestyle" class=""><a href="category.php?name=lifestyle">LIFESTYLE</a></li>
                                        <li id="fitness" class=""><a href="category.php?name=fitness" >FITNESS</a></li>
        <?php } ?>                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>             
                       
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-md-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</header>

<?php 
// include_once('./config/config.php');

$catee = $_SESSION['category'];
$sql = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` != 'home page' OR `cat_name` != 'HOME PAGE'");
if($sql){
    if(mysqli_num_rows($sql) > 0){
        while($rwo = mysqli_fetch_assoc($sql)){
            if($catee == strtolower($rwo['cat_name']) ){
    
    echo "<script> let ".strtolower($rwo['cat_name']).$rwo['id']." = document.getElementById('".strtolower($rwo['cat_name'])."'); ".strtolower($rwo['cat_name']).$rwo['id'].".classList.add('active'); 
        
        
    </script>";
            
            }
            
    echo "<script> document.getElementById('".strtolower($rwo['cat_name'])."').classList.remove('active'); </script>";
            
     
            
            
    if(isset($_GET['name']) and $_GET['name'] == strtolower($rwo['cat_name'])){
    echo "<script> let ".strtolower($rwo['cat_name'])." = document.getElementById('".strtolower($rwo['cat_name'])."'); ".strtolower($rwo['cat_name']).".classList.add('active'); </script>";
        $_SESSION['category'] = strtolower($rwo['cat_name']);
        
    }
//     else{
        
// echo "<script> let ".strtolower($rwo['cat_name']).$rwo['id']." = document.getElementById('home page'); a.classList.add('active'); </script>";
// $_SESSION['category'] = 'home page';

//     }
            
        }
    }else{
        echo "<script>alert('no category found');</script>";
    }
}else{
        echo "<script>alert('Server Error');</script>";
}



// if(isset($_GET['name']) and $_GET['name'] == 'health' || $_SESSION['category'] == 'health'){
//     echo "<script> let a = document.getElementById('health'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'health';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'tech' || $_SESSION['category'] == 'tech'){
//     echo "<script> let a = document.getElementById('tech'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'tech';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'travel' || $_SESSION['category'] == 'travel'){
//     echo "<script> let a = document.getElementById('travel'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'travel';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'fashion' || $_SESSION['category'] == 'fashion'){
//     echo "<script> let a = document.getElementById('fashion'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'fashion';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'food' || $_SESSION['category'] == 'food'){
//     echo "<script> let a = document.getElementById('food'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'food';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'finance' || $_SESSION['category'] == 'finance'){
//     echo "<script> let a = document.getElementById('finance'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'finance';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'personal' || $_SESSION['category'] == 'personal'){
//     echo "<script> let a = document.getElementById('personal'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'personal';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'culture' || $_SESSION['category'] == 'culture'){
//     echo "<script> let a = document.getElementById('culture'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'culture';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'lifestyle' || $_SESSION['category'] == 'lifestyle'){
//     echo "<script> let a = document.getElementById('lifestyle'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'lifestyle';
    
// }elseif(isset($_GET['name']) and $_GET['name'] == 'fitness' || $_SESSION['category'] == 'fitness'){
//     echo "<script> let a = document.getElementById('fitness'); a.classList.add('active'); </script>";
//     $_SESSION['category'] = 'fitness';
    
// }else{
//         echo "<script> let a = document.getElementById('home page'); a.classList.add('active'); </script>";
//         $_SESSION['category'] = 'home page';
// }

?>

<style>
    .subscribeBox, .searchBox{
        position: fixed;
        width: 100%;
        height: 100%;
        top:0;
        bottom:0;
        right:0;
        left:0;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
    }
</style>
<div id="subscribeBox" class="subscribeBox d-none">
    <div class="container">
        <div class="row p-xl-4">
            <div class="col-lg-12 col-12 p-lg-4">
                <div class="p-lg-4 py-4">
                    <div>
                    <h2 class="text-light text-center"> Subscribe Newsletter <i onClick="subsclose()" style="cursor:pointer;" class="fa fa-close pull-right"></i> </h2>
                    <hr>
                    </div>
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0 border-0 border border-bottom-1" name="name" placeholder="Type your name">                  
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0 border border-bottom-1" name="email" placeholder="Email Address">                  
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn pull-center rounded-0 border-0 border border-bottom-1" name="subscribe" value="Subscribe">                  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<div id="searchBox" class="searchBox d-none">
    <div class="container">
        <div class="row p-xl-4">
            <div class="col-lg-12 col-12 p-lg-4">
                <div class="p-lg-4 py-4">
                    <div>
                    <h2 class="text-light text-center"> Search <i onClick="searchclose()" style="cursor:pointer;" class="fa fa-close pull-right"></i> </h2>
                    <hr>
                    </div>
                    <form action="search.php">
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0 border-0 border border-bottom-1" name="name" placeholder="Search here">                  
                        </div>
                    
                        <div class="form-group">
                            <input type="submit" class="btn pull-center rounded-0 border-0 border border-bottom-1" name="fullname" value="Search">                  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function subscription(){
        document.getElementById('subscribeBox').classList.remove("d-none");
    }
    
    function search(){
        document.getElementById('searchBox').classList.remove("d-none");
    }
    
    function subsclose(){
        document.getElementById('subscribeBox').classList.add("d-none");
    }
    
    function searchclose(){
        document.getElementById('searchBox').classList.add("d-none");
    }
    
</script>






<div class="modal" id="subsi">
  <div class="modal-dialog">
    <div class="modal-content">


      <!-- Modal body -->
      <div class="modal-body">
        <center>
        <!-- <img src="./assets/img/logo/cleanlogo2.png" alt="" width="30%"><br> -->
	<h5 class="mt-3"><b style="color: #DF678B;">READY TO UNLOCK YOUR SUCCESS</b></h5>
	<h1 class="">Get Daily Tips, Tricks, <br> and tech guides</h1>
	
	<h4 class="text-center">Delivery to your inbox</h4>
	<br>
	<form action="index.php" method="POST">
	<input type="email" placeholder="Email Address" name="email" class="form-control rounded-0"><br>
	<input type="submit" class="btn btn-danger w-100 p-4 rounded-0" value="SIGN ME UP" name="subscribe"><br><br>
	<a href="#" data-dismiss="modal" class="text-dark">No thanks</a>
	</form>
	</center>
      </div>

    </div>
  </div>
</div>
    

<script>
	

		let timeer = setInterval(timer, 5000);

		function timer(){

            if(window.scrollY > 500){
                
                if(!sessionStorage.day){

                let myModal = new bootstrap.Modal(document.getElementById('subsi'), {});
                myModal.show();

                sessionStorage.setItem('day', new Date().getDate());

                clearInterval(timeer);
                }else{
                    clearInterval(timeer);
                }
            }
            
		}




</script>