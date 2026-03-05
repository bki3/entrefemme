<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= 'login.php';</script>";
}

if(isset($_POST['change'])){
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE `name` = 'admin'"));

    if($newpass == $oldpass and $newpass != $stmt2['password']){
        echo "<script>alert('old and new password are same try different password');</script>";
    }else{
        $stmt = mysqli_query($con, "UPDATE `users` SET `password` = '".$newpass."' WHERE `name` = 'admin'");
        if($stmt){
            echo "<script>alert('Password changed successfully !!');</script>";
        }else{
            echo mysqli_error($con);
        }
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

    $stmt33 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adsense'"));
    
    


if(isset($_POST['adone'])){
    
$target_dir = "../assets/img/gallery/";
$target_file = $target_dir . basename($_FILES["fileone"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["adone"])) {
  $check = getimagesize($_FILES["fileone"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


// Check file size
if ($_FILES["fileone"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp" && $imageFileType != "WEBP" && $imageFileType != "gif" && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG") {
  $error = "Sorry, only JPG, JPEG, PNG, Webp & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileone"]["tmp_name"], $target_file)) {
        
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adone'"));

    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".trim(str_replace('../', ' ', $target_file))."' WHERE `setting_name` = 'adone'");
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

// Check if image file is a actual image or fake image
if(isset($_POST["adtwo"])) {
  $check = getimagesize($_FILES["filetwo"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


// Check file size
if ($_FILES["filetwo"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["filetwo"]["tmp_name"], $target_file)) {
        
    extract($_POST);
    
    $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'adtwo'"));

    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".trim(str_replace('../', ' ', $target_file))."' WHERE `setting_name` = 'adtwo'");
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
        
    
?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Help Desk - Admin Panel</title>
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
          <li class="breadcrumb-item active">Help & Support</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            
            <hr>
                <h1>Help & Support</h1>
            <hr>
             <p> <b>Image Size & Format:</b> Always Use Square Image such as 600px x 600px and use jpg, png, webp formats of images. </p>
            <hr>
            <p>For Changing of Font Style Blog Detail Page use this code to modify and use it inside website header  section of the admin panel settings menu.</p>
            <hr>
<pre>.blog-details{
    font-family: "Arial" !important;
}</pre>

<small><i><b>Note:</b> Use own font style by replacing the "Arial" font.</i></small>            
        
          

          <hr>
            <h1>SMTP Instructions</h1>
          <hr>

          <p>
            To change the smtp settings of your website, you have to go to these files you can find it right there,
            <br>
            <ol>
              <li> main directory > admin > new_article.php</li>
              <li> main directory > admin > send_email.php</li>
              <li> main directory > admin > add_service.php</li>
            </ol>

            Open these files one by one in any order and you can find there <br>
            SMTPHost that defines host of your smtp <br>
            SMTP_Username that defines host of your smtp username / email address <br>
            SMTP_Password that defines host of your smtp password  <br>
          </p>


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