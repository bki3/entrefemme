<?php 
$facebook = '';
$twitter = '';
$instagram = '';
$stmt = mysqli_query($con, "SELECT * FROM `settings`");
if($stmt){
    if(mysqli_num_rows($stmt) > 0){
        while($ro = mysqli_fetch_assoc($stmt)){
            if($ro['setting_name'] == 'facebook'){
                $facebook = $ro['setting_value'];
                $_SESSION['facebook'] = $facebook;
            }
            
            if($ro['setting_name'] == 'twitter'){
                $twitter = $ro['setting_value'];
                $_SESSION['twitter'] = $twitter;
            }
            
            if($ro['setting_name'] == 'instagram'){
                $instagram = $ro['setting_value'];
                $_SESSION['instagram'] = $instagram;
            } 
            
            if($ro['setting_name'] == 'youtube'){
                $youtube= $ro['setting_value'];
                $_SESSION['youtube'] = $youtube;
            } 
            
            if($ro['setting_name'] == 'whatsapp'){
                $whatsapp = $ro['setting_value'];
                $_SESSION['whatsapp'] = $whatsapp;
            }
        }
    }
}
?>
<style>
    #cookiebox{
        position: fixed;
        bottom: 0;
        left:0;
        right:0;
        z-index: 99999;
        height: auto;
    }
    
    .cbutton{
        border-radius: 50px;
    }
    @media only screen and (min-width: 769px) {
    
        /*#cookiebox .content1{*/
        /*    padding: 0px 20px 0px 20px;*/
        /*}*/
        
        #cookiebox .content1 p{
            font-family: "Roboto Condensed";
            font-size: 1.2vw;
            font-weight: 400;
            margin-left: 10px !important;
        }

        #cookiebox .content button{
            margin-right: 100px !important;
        }
    }
    
    @media only screen and (max-width: 768px) {
    
        
         #cookiebox .content1 p{
            font-size: 3vw;
            text-align:left;
            margin: auto;
        }
        
    }
    
    .text-decoration-underline{
        text-decoration: underline;
    }

</style>

<div id="cookiebox" class="bg-dark p-1">
    <div class="row">
        <div class="col-md-12 col-12">   
            <div class="content1 bg-dark text-center text-light pr-5">
                <p style="color:white;">We use cookies to ensure you have the best browsing experience on our website. By using our site, you acknowledge that you have read and understood our <a href="privacy.php" class="text-decoration-underline">Cookie Policy</a> & <a class="text-decoration-underline" href="privacy.php">Privacy Policy</a>
            
                <button class="cbutton btn bg-danger p-3 btn-sm" onClick="accept()">Got it!</button></p>
            </div>
        </div>
    </div>
</div>

<script>
    if(sessionStorage.getItem("cookie") == true){
        document.getElementById("cookiebox").style.display = "none";
    }
    
    function accept(){
        sessionStorage.setItem("cookie", "1");
        document.getElementById("cookiebox").style.display = "none";
    }
</script>


<!-- footer -->

<footer>

<style>
    
    footer a, footer span{
        font-size: 1vw;
    }
</style>
    <!-- Footer Start-->
    <div class="footer-main footer-bg">
        <div class="footer-area p-2 ">
            <div class="container">
                <div class="row d-flex justify-content-between">

                    <div class="col-xl-3 col-lg-3 col-md-3">
                     </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                        <div class="single-footer-caption">
                            <div class="footer-tittle p-2 text-center">
                                <a href="<?php echo $facebook;?>" target="_new"><i style="color: #0B5FCC" class="mx-2 fab fa-facebook-square fa-facebook"></i></a>
                                <a href="<?php echo $twitter;?>" target="_new"><i class="mx-2 text-info fab fa-twitter"></i></a>
                                <a href="<?php echo $instagram;?>" target="_new"><i style="color: #992180;" class="mx-2 fab fa-instagram"></i></a>
                                <a href="<?php echo $youtube; ?>" target="_new"><i class="mx-2 text-danger fab fa-youtube"></i></a>
                                <a href="feed.rss" target="_new"><i style="color: #8b8b8b " class="mx-2 fa fa-rss"></i></a>
                            </div>
                            <div class="text-light my-md-2">
                                <div class="my-md-2">
                                    <a  class="mx-2" href="sitemap.xml"><span>Sitemap</span></a> 
                                    <a  class="mx-2" href="about.php"><span> About</span></a> 
                                    <a  class="mx-2" href="./advisor.php"><span> Advisor</span></a> 
                                    <a  class="mx-2" href="./shop/"><span>Store</span></a>
                                </div>
                                <div class="my-md-2">
                                    <a class="mx-3" href="./accessibility.php"><span> Accessibility</span></a> 
                                    <a class="mx-3" href="privacy.php"><span> Privacy</span></a> 
                                    <a class="mx-3" href="terms.php"><span> Terms of Use</span></a> 
                                    <a class="mx-3" href="advertising.php"><span> Advertising</span></a>
                                    <a class="mx-3" href="jobs.php"><span> Jobs</span></a>
				    <a class="mx-3" href="services.php"><span> Services</span></a>  
                                </div>
                            </div>
                                
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                       
                    </div>
                </div>
            </div>
        </div>


        <!-- footer-bottom aera -->
        <div class="footer-bottom-area footer-bg">
            <div class="container-fluid">
                <div class="footer-border">
                    <div class="row align-items-center">
                        <div class="col-xl-12">
                            <div class="footer-copy-right text-center text-light">
                                <span>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved - Entre Femme </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>



<!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js" async defer></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js" async defer></script>
    <script src="./assets/js/popper.min.js" async defer></script>
    <script src="./assets/js/bootstrap.min.js" async defer></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js" async defer></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js" async defer></script>
    <script src="./assets/js/slick.min.js" async defer></script>
    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js" async defer></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js" async defer></script>
    <script src="./assets/js/animated.headline.js" async defer></script>
    <script src="./assets/js/jquery.magnific-popup.js" async defer></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js" async defer></script>
    <script src="./assets/js/jquery.nice-select.min.js" async defer></script>
    <script src="./assets/js/jquery.sticky.js" async defer></script>
    
    <!-- contact js -->
    <!-- <script src="./assets/js/contact.js" async defer></script>
    <script src="./assets/js/jquery.form.js" async defer></script>
    <script src="./assets/js/jquery.validate.min.js" async defer></script>
    <script src="./assets/js/mail-script.js" async defer></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js" async defer></script>
     -->
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js" async defer></script>
    <script src="./assets/js/main.js" async defer></script>
    
</body>
</html>