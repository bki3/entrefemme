<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$facebook = '';
$twitter = '';
$instagram = '';
$stmt = mysqli_query($con, "SELECT * FROM `social`");
if($stmt){
    $social = array();
    
    while($row = mysqli_fetch_assoc($stmt)){
        array_push($social, $row);
    }
}

if(isset($_POST['update'])){

if($_FILES['fileToUpload']['error'] == 0){
    
    
$target_dir = "../assets/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}



// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "webp" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
    $stmt0 = mysqli_query($con, "UPDATE `social` SET `title` = '".$_POST['title']."', `description` = '".$_POST['desc']."', `image` = '".$target_file."'  WHERE `platform` = 'facebook'");
     if($stmt0){

        echo "<script>alert('Updated'); window.location.href = './socials.php';</script>";
    }else{
        echo "<script>alert('Failed to update '); window.location.href = './socials.php';</script>";
    }
    

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

}else{ // files
    $stmt0 = mysqli_query($con, "UPDATE `social` SET `title` = '".$_POST['title']."', `description` = '".$_POST['desc']."' WHERE `platform` = 'facebook'");
     if($stmt0){
        echo "<script>alert('Updated'); window.location.href = './socials.php';</script>";
    }else{
        echo "<script>alert('Failed to update'); window.location.href = './socials.php';</script>";
    }
    
}


} // facebook update end here






////////////////////////////////////////////

if(isset($_POST['update_twitter'])){

if($_FILES['fileToUpload']['error'] == 0){
    
    
$target_dir = "../assets/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}



// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "webp" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
    $stmt0 = mysqli_query($con, "UPDATE `social` SET `title` = '".$_POST['title']."', `description` = '".$_POST['desc']."', `image` = '".$target_file."'  WHERE `platform` = 'twitter'");
     if($stmt0){

        echo "<script>alert('Updated'); window.location.href = './socials.php';</script>";
    }else{
        echo "<script>alert('Failed to update '); window.location.href = './socials.php';</script>";
    }
    

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

}else{ // files
    $stmt0 = mysqli_query($con, "UPDATE `social` SET `title` = '".$_POST['title']."', `description` = '".$_POST['desc']."' WHERE `platform` = 'twitter'");
     if($stmt0){
        echo "<script>alert('Updated'); window.location.href = './socials.php';</script>";
    }else{
        echo "<script>alert('Failed to update'); window.location.href = './socials.php';</script>";
    }
    
}


} // twitter update end here

?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Socials - Admin Panel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<?php include 'links.php';?>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<?php include 'top_nav.php';?>
<?php include 'sidebar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Admin Panel</a></li>
          <li class="breadcrumb-item active">Social tags seo</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            
            <div class="row">
                <div class="col-lg-12 col-12">
                    <hr>
                        <h1 class="text-center">Facebook & Others</h1>
                        <p class="text-center"><small><b>Note:</b> This settings for website home page and for blog social media tags automatically worked as according to blog picture, description and title.</small></p>
                    <hr>
                </div>
                <div class="col-lg-6 col-6">
                    <form method="POST" enctype="multipart/form-data">
                        
                        <label>Title</label>
                        <input type="text" class="form-control" value="<?php echo $social[0]['title']; ?>" name="title" placeholder="Type Title">
                        <br>
                        <label>Description</label>
                        <input type="text" class="form-control" value="<?php echo $social[0]['description']; ?>" name="desc" placeholder="Type Description">
                        <br>
                        <label>Picture</label>
                        <input type="file" class="form-control" name="fileToUpload">
                        <br>
                        <input type="submit" name="update" class="btn btn-info px-5 text-light" value="Update">

                    </form>
                </div>
                
                <div class="col-lg-6 col-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="<?php echo $social[0]['image']; ?>" alt="facebook Image" width="100%">                        
                            <h4><?php echo $social[0]['title']; ?></h4>
                            <p><?php echo $social[0]['description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
          
          </div>
          
          <div class="row">
            
            <div class="row">
                <div class="col-lg-12 col-12">
                    <hr>
                        <h1 class="text-center">Twitter</h1>
                    <hr>
                </div>
                <div class="col-lg-6 col-6">
                    <form method="POST" enctype="multipart/form-data">
                        
                        <label>Title</label>
                        <input type="text" class="form-control" value="<?php echo $social[1]['title']; ?>" name="title" placeholder="Type Title">
                        <br>
                        <label>Description</label>
                        <input type="text" class="form-control" value="<?php echo $social[1]['description']; ?>" name="desc" placeholder="Type Description">
                        <br>
                        <label>Picture</label>
                        <input type="file" class="form-control" name="fileToUpload">
                        <br>
                        <input type="submit" name="update_twitter" class="btn btn-info px-5 text-light" value="Update">

                    </form>
                </div>
                
                <div class="col-lg-6 col-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="<?php echo $social[1]['image']; ?>" alt="twitter Image" width="100%">                        
                            <h4><?php echo $social[1]['title']; ?></h4>
                            <p><?php echo $social[1]['description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
          
          </div>
        </div><!-- End Left side columns -->

        

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Admin Panel</span></strong>. All Rights Reserved
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

</html>