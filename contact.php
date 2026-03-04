<?php


if (isset($_POST['submit'])) {
    $date = date('M d, Y');
    $query = mysqli_query($con, "INSERT INTO `contacts` (`name`, `email`, `message`, `date`) VALUES ('" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . $_POST['message'] . "', '$date')");
    if ($query) {
        echo "<script> alert('Thank you !! We will get back to you soon!! '); window.location.href = 'contact.php';</script>";
    } else {
        echo mysqli_error($con);
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact us - Entre Femme Blog </title>
    <meta name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/cleanlogo.png">

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" defer>


    <style>
        .text-shadow {
            text-shadow: 2px 2px 1px rgba(0, 0, 0, 0.2);
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


        @media screen and (min-width: 768px) {
            #subscribe_row {
                padding: 0vw 20vw 0vw 20vw;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/cleanlogo2.png" width="100%" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader ends -->

    <?php include 'navbar.php'; ?>
    <main>
        <!-- ================ contact section start ================= -->
        <section class="contact-section">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
                <!--<div class="d-none d-sm-block mb-5 pb-4">-->

                <!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&amp;callback=initMap">-->
                <!--    </script>-->

                <!--</div>-->


                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                    </div>
                    <div class="col-lg-8">
                        <form method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" placeholder="Type your message" name="message" id="message" cols="30" rows="9"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" name="submit" class="button button-contactForm boxed-btn" value="Send">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'address'");
                                if ($sql) {
                                    if (mysqli_num_rows($sql) > 0) {
                                        $address = mysqli_fetch_assoc($sql);
                                        echo $address['setting_value'];
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'contact'");
                                if ($sql) {
                                    if (mysqli_num_rows($sql) > 0) {
                                        $address = mysqli_fetch_assoc($sql);
                                        echo $address['setting_value'];
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'email'");
                                if ($sql) {
                                    if (mysqli_num_rows($sql) > 0) {
                                        $address = mysqli_fetch_assoc($sql);
                                        echo $address['setting_value'];
                                    }
                                }
                                ?>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ contact section end ================= -->
    </main>

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

    <?php include 'footer.php'; ?>