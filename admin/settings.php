<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= 'login.php';</script>";
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['update_smtp'])){
    extract($_POST);
    foreach ($_POST as $key => $value) {
       
       if($key != 'update_smtp'){
        $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$value."' WHERE `setting_name` = '$key' ");
       } 
    }

    if($stmt){
        echo "<script>alert('Settings Updated Successfully !!'); window.location.href='settings.php';</script>";
    }else{
        echo mysqli_error($con); exit();
    }

}


if(isset($_POST['update_fav'])){
    extract($_POST);

        $target_dir = "../assets/img/logo/";

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            
            $file = './assets/img/logo/'.basename($_FILES["fileToUpload"]["name"]);
            $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$target_file."' WHERE `setting_name` = 'favicon' ");

            if($stmt){
                echo "<script>alert('Favicon Updated Successfully !!'); window.location.href = './settings.php';</script>";
            }else{
                echo mysqli_error($con); exit();
            }

          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }        
}


if(isset($_POST['change'])){
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE `name` = 'admin'"));

    $newpass = password_hash($newpass, PASSWORD_BCRYPT);

        $stmt = mysqli_query($con, "UPDATE `users` SET `password` = '".$newpass."' WHERE `name` = 'admin'");
        if($stmt){
            echo "<script>alert('Password changed successfully !!'); window.location.href = './settings.php';</script>";
        }else{
            echo mysqli_error($con);
        }

}



if(isset($_POST['set_metatitle'])){
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'metatitle'"));


$metatitle = str_replace("'", "\'", $metatitle);
        $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$metatitle."' WHERE `setting_name` = 'metatitle'");
        if($stmt){
            echo "<script>alert('Updated successfully !!'); window.location.href = './settings.php';</script>";
        }else{
            echo mysqli_error($con);
        }

}


if(isset($_POST['set_meta'])){
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'metadesc'"));


$metadesc = str_replace("'", "\'", $metadesc);
        $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$metadesc."' WHERE `setting_name` = 'metadesc'");
        if($stmt){
            echo "<script>alert('Updated successfully !!'); window.location.href = './settings.php';</script>";
        }else{
            echo mysqli_error($con);
        }

}

if(isset($_POST['adsense'])){
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adsense'"));

    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$adcode."' WHERE `setting_name` = 'adsense'");
    if($stmt){
        echo "<script>alert('Updated successfully !!'); window.location.href='settings.php';</script>";
    }else{
        echo mysqli_error($con);
    }
    
    mysqli_close($con);
}

$stmt44 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'authorlink'"));
    
    
if(isset($_POST['author'])){
    extract($_POST);
    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$authorlink."' WHERE `setting_name` = 'authorlink'");
    if($stmt){
        echo "<script>alert('Updated successfully !!'); window.location.href='settings.php';</script>";
    }else{
        echo mysqli_error($con);
    }
    
    mysqli_close($con);
}

$stmt33 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adsense'"));
if(isset($_POST['adone'])){
    
$target_dir = "../assets/img/gallery/";
$target_file = $target_dir . basename($_FILES["fileone"]["name"]);


$target_file = str_replace(" ", "_", strtolower($target_file));


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileone"]["tmp_name"], $target_file)) {
        
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adone'"));

    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".trim(str_replace('../', '', $target_file))."' WHERE `setting_name` = 'adone'");
    if($stmt){
        echo "<script>alert('Updated successfully !!'); window.location.href='settings.php';</script>";
    }else{
        echo mysqli_error($con);
    }
    
    mysqli_close($con);
        

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


}     //Ad file one upload end here
    






if(isset($_POST['adtwo'])){
    
$target_dir = "../assets/img/gallery/";
$target_file = $target_dir . basename($_FILES["filetwo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$target_file = str_replace(" ", "_", strtolower($target_file));


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["filetwo"]["tmp_name"], $target_file)) {
        
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adtwo'"));

    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".trim(str_replace('../', '', $target_file))."' WHERE `setting_name` = 'adtwo'");
    if($stmt){
        echo "<script>alert('Updated successfully !!'); window.location.href='settings.php';</script>";
    }else{
        echo mysqli_error($con);
    }
    
    mysqli_close($con);
        

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


}     //Ad file one upload end here
        



if(isset($_POST['set_shoplink'])){
    
    $shoplink = $_POST['shoplink'];
    $stmt =  mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'shoplink'"); 

    if(mysqli_num_rows($stmt) > 0){

        $stmt2 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$shoplink."' WHERE `setting_name` = 'shoplink' ");

        if($stmt2){

            echo "<script>alert('Updated successfully !!'); window.location.href = './settings.php';</script>";
        }else{
            echo mysqli_error($con);
        }

    }else{
        $date = date('Y-m-d');
        $stmt3 = mysqli_query($con, "INSERT INTO `settings` (`setting_name`, `setting_value`, `last_updated`) VALUES ('shoplink', '$shoplink', '$date')");
        if($stmt3){
            echo "<script>alert('Added successfully !!');window.location.href = './settings.php';</script>";
        }else{
            echo mysqli_error($con);
        
        }
    }

}

if(isset($_POST['set_service'])){
    
    $shoplink = $_POST['service_link'];
    $stmt =  mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'service_link'"); 

    if(mysqli_num_rows($stmt) > 0){

        $stmt2 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$shoplink."' WHERE `setting_name` = 'service_link' ");

        if($stmt2){

            echo "<script>alert('Updated successfully !!'); window.location.href = './settings.php';</script>";
        }else{
            echo mysqli_error($con);
        }

    }else{
        $date = date('Y-m-d');
        $stmt3 = mysqli_query($con, "INSERT INTO `settings` (`setting_name`, `setting_value`, `last_updated`) VALUES ('service_link', '$shoplink', '$date')");
        if($stmt3){
            echo "<script>alert('Added successfully !!');window.location.href = './settings.php';</script>";
        }else{
            echo mysqli_error($con);
        
        }
    }

}

$metatitle = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'metatitle'"));

$metadescription = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'metadesc'"));

$favicon = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'favicon'"));

$shoplnk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'shoplink'"));


$service_link = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'service_link'"));



?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Settings - Admin Panel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<?php include 'links.php';?>

</head>

<body>
<?php include 'top_nav.php';?>
<?php include 'sidebar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
        
        <div class="row">    
            <div class="col-lg-12 col-12">
                <h3>Website Header</h3>
                <hr>
                 <form method="POST">
                    <div class="form-group mb-1">
                        <textarea class="form-control" rows="8" name="adcode"><?php echo $stmt33['setting_value']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Update" name="adsense">
                    </div>
                </form>
            </div>

            <hr>

            <div class="col-lg-12 col-12">
                <h3>Website Title</h3>
                <hr>
                <form method="POST">
                    <div class="form-group mb-1">
                        <input class="form-control" placeholder="Type Website Title" rows="7" name="metatitle" value="<?php echo $metatitle['setting_value']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Update" name="set_metatitle">
                    </div>
                </form>
            </div>
            <hr>
            <div class="col-lg-12 col-12">
                <h3>Website Description</h3>
                <hr>
                <form method="POST">
                    <div class="form-group mb-1">
                        <textarea class="form-control" placeholder="Type Website Description" rows="7" name="metadesc"><?php echo $metadescription['setting_value']; ?></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Update" name="set_meta">
                    </div>
                </form>
            </div>

            <hr>
            
            <div class="col-lg-12 col-12">
                <h3>Modify Advertisement</h3>
                <hr>
            <div class="row">
                <div class="col-lg-6 col-12">
                
                 <form method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <?php 
                            $sql = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adone'");
                            if($sql){
                                 $adone=mysqli_fetch_assoc($sql);
                                
                                print_r('
                                    <img src="../'.trim($adone['setting_value']).'" width="50%" class="img-responsive">
                                ');
                                
                            }
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <input type="file" class="form-control my-3" name="fileone">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Update Ad" name="adone">
                    </div>
                </form>
                </div>    
                <div class="col-lg-6 col-12">        
                
                 <form method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <?php 
                            $sql = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adtwo'");
                            if($sql){
                                 $adone=mysqli_fetch_assoc($sql);
                                
                                print_r('
                                    <img src="../'.trim($adone['setting_value']).'" width="50%" class="img-responsive">
                                ');
                                
                            }
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <input type="file" class="form-control my-3" name="filetwo">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Update Ad" name="adtwo">
                    </div>
                </form>
                </div>    <!--col end -->
            </div>    <!--row end -->
            </div>
          </div>
        <hr>
        <div class="row">
            <div class="col-lg-6 col-12">
                <h3>Change Password</h3>
                <hr>
                <form method="POST">
                    <div class="form-group mb-1">
                        <input type="password" class="form-control" placeholder="Type current Password" name="oldpass">
                    </div>
                    <div class="form-group mb-1">
                        <input type="password" class="form-control" placeholder="Type New Password" name="newpass">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Change" name="change">
                    </div>
                </form>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-lg-6 col-12">
                <h3>Favicon Settings</h3>
                <hr>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="file" class="form-control" name="fileToUpload">
                    </div>
    
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Change" name="update_fav">
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-12">

                <img src="../<?php echo $favicon['setting_value']; ?>">
            </div>
        </div>


        <hr>
        <div class="row">
            <div class="col-lg-12 col-12">
                <h3>Shop Redirect Settings (Default [ https://entrefemme.com/shop/ ] )</h3>
                <hr>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="text" value="<?php echo $shoplnk['setting_value'];?>" class="form-control" name="shoplink">
                    </div>
    
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Change" name="set_shoplink">
                    </div>
                </form>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-lg-12 col-12">
                <h3>Service Redirect Settings (Default [ https://entrefemme.com/services.php ] )</h3>
                <hr>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="text" value="<?php echo $service_link['setting_value'];?>" class="form-control" name="service_link">
                    </div>
    
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Change" name="set_service">
                    </div>
                </form>
            </div>
        </div>


        <hr>
      <!--  <div class="row">
            <div class="col-lg-12 col-12">
                <h3 class="text-center bg-danger text-light">SMTP Settings </h3>
                <p class="text-center"><small><b>Warning:</b> Carefully change these setting you can not undo these settings <br> if you make changes wrong that may cause your email sending system failed</small></p>
                <hr>
                <form method="POST">
                    <div class="form-group my-3">
                        <label>SMTP Host</label>
                        <input type="text" class="form-control" value="<?php //echo $smtpHost; ?>" name="smtp_host">
                    </div>

                    <div class="form-group my-3">
                        <label>SMTP Username <small>(Email address)</small></label>
                        <input type="text" class="form-control" value="<?php //echo $smtpUsername; ?>" name="smtp_username">
                    </div>

                    <div class="form-group my-3">
                        <label>SMTP Password</label>
                        <input type="text" class="form-control" value="<?php //echo $smtpPassword; ?>" name="smtp_password">
                    </div>

                    <div class="form-group my-3">
                        <label>SMTP Secure</label>
                        <input type="text" class="form-control" value="<?php //echo $smtpSecure; ?>"  name="smtp_secure">
                    </div>

                    <div class="form-group my-3">
                        <label>SMTP Port</label>
                        <input type="text" class="form-control" name="smtp_port" value="<?php// echo $smtpPort; ?>" >
                    </div>
    
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Change" name="update_smtp">
                    </div>
                </form>
            </div>
        </div>

    -->
        
        </div>
        <!-- End Left side columns -->

        

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Entre Femme</span></strong>. All Rights Reserved
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</php>