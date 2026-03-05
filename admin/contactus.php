<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$estmt = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'email'");
$astmt = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'address'");
$cstmt = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'contact'");

 if($estmt and $astmt and $cstmt){
    
    $erow = mysqli_fetch_assoc($estmt);
    $arow = mysqli_fetch_assoc($astmt);
    $crow = mysqli_fetch_assoc($cstmt);

}else{
    print_r("No Records Found");
}

if(isset($_POST['update'])){
    extract($_POST);
    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$email' WHERE `setting_name` = 'email' ");
    $stmt1 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$contact' WHERE `setting_name` = 'contact' ");
    $stmt2 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$address' WHERE `setting_name` = 'address' ");
    
    if($stmt and $stmt1 and $stmt2){
        echo "<script> alert('Updated Successful!'); window.location.href= './contactus.php';</script>";
    }  
        
}   


?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contact us Page - Admin Panel</title>
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
          <li class="breadcrumb-item active">Contact us</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            
            <div class="row">
                <div class="col-lg-12 col-6">
                <form method="POST">
                <label>Email Address:</label>
                <textarea type="text" class="form-control" rows="5" name="email"><?php echo $erow['setting_value']; ?></textarea>
                <br>
                <label>Contact</label>
                <textarea type="text" class="form-control" rows="5" name="contact"><?php echo $crow['setting_value']; ?></textarea>
                <br>
                <label>Address</label>
                <textarea type="text" class="form-control" rows="5" name="address"><?php echo $arow['setting_value']; ?></textarea>
                <br>
                <input type="submit" class="btn btn-danger px-5 rounded-0 btn-sm" value="Update" name="update">
                </form>
                </div>
            <div class="col-lg-6 col-6 mb-3">
                
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