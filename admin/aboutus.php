<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['login'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$sql = mysqli_query($con, "SELECT * FROM `aboutusblog`");
if($sql){
    if(mysqli_num_rows($sql) > 0){
        $component = array();
        while($data = mysqli_fetch_assoc($sql)){
            array_push($component, $data);
        }
    }
}



///////////////////////////////////////
///////////////////////////////////////

if(isset($_POST['add_article'])){
    extract($_POST);
    
    $sql2 = mysqli_query($con, "UPDATE `aboutusblog` SET `description` = '$mission' WHERE `title` = 'Our Mission'");
    $sql3 = mysqli_query($con, "UPDATE `aboutusblog` SET `description` = '$vision' WHERE `title` = 'Our Vision'");
    $sql4  = mysqli_query($con, "UPDATE `aboutusblog` SET `description` = '$more' WHERE `title` = 'More About us'");
    
    if($sql2 && $sql3 && $sql4){
        echo "<script>alert('Successfully Updated'); window.location.href = './aboutus.php';</script>";
    }else{
        echo "<script>alert('Failed to Updated'); window.location.href = './aboutus.php';</script>";
    }
}



?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edit Article - Admin Panel</title>
  
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
<script src="editor/ckeditor.js"></script>
</head>

<body>
<?php include 'top_nav.php';?>
<?php include 'sidebar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>About us</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Blogs</a></li>
          <li class="breadcrumb-item active">About us</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <form method="POST" enctype="multipart/form-data">

            <div class="row my-3">
                <div class="col">
                    <label><h2><b>Our Mission</b></h2></label>
                    <textarea id="descr" name="mission" rows="8" class="form-control" placeholder="Type Description"><?php echo $component[0]['description']; ?></textarea>
                </div>
            </div>  
            <script>CKEDITOR.replace('descr');</script>
            
            <hr>
            
            <div class="row my-3">
                <div class="col">
                    <label><h2><b>Our Vision</b></h2></label>
                    <textarea id="descr2" name="vision" rows="8" class="form-control" placeholder="Type Description"><?php echo $component[1]['description']; ?></textarea>
                </div>
            </div> 
            
            <script>CKEDITOR.replace('descr2');</script>
            <hr>
            
            <div class="row my-3">
                <div class="col">
                    <label><h2><b>MORE ABOUT US</b></h2></label>
                    <textarea id="descr3" name="more" rows="8" class="form-control" placeholder="Type Description"><?php echo $component[2]['description']; ?></textarea>
                </div>
            </div> 
            
            <script>CKEDITOR.replace('descr3');</script>
            <hr>

             <div class="row my-3">
                <div class="col">
                    <input type="submit" class="btn btn-primary px-4" name="add_article" value="Update About us">   
                </div>
            </div> 
            
            
            
          </form>
          
        </div><!-- End Left side columns -->
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

</html>