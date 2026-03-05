<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
include '../config/config.php';


if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$popular_limit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` LIKE '%popular%' "))['setting_value'];
$latest_limit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` LIKE '%latest%' "))['setting_value'];
$watch_limit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` LIKE '%watch%' "))['setting_value'];
$feature_limit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` LIKE '%feature%' "))['setting_value'];
$comment_limit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` LIKE '%comment%' "))['setting_value'];



if(isset($_POST['update'])){
    extract($_POST);

    $sql = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$popular' WHERE `setting_name` LIKE '%popular%'");
    $sql2 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$latest' WHERE `setting_name` LIKE '%latest%'");
    $sql3 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$watch' WHERE `setting_name` LIKE '%watch%'");
    $sql4 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$feature' WHERE `setting_name` LIKE '%feature%'");
    $sql5 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '$comment' WHERE `setting_name` LIKE '%comment%'");

    if($sql5){
        echo "<script>alert('Updated Successful !!'); window.location.href  = 'limits.php';</script>";
    }
}

?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Section Limits - Admin Panel</title>
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
          <li class="breadcrumb-item"><a href="index.php">Admin Panel</a></li>
          <li class="breadcrumb-item active">Section Limits</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
        
<form method="POST">
    <label>Latest Section Limit </label>
    <input type="number" class="form-control my-3" name="latest" value="<?php echo $latest_limit; ?>" required>

    <label>Popular Section Limit </label>
    <input type="number" class="form-control my-3" name="popular" value="<?php echo $popular_limit; ?>" required>

    <label>Feature Section Limit </label>
    <input type="number" class="form-control my-3" name="feature" value="<?php echo $feature_limit; ?>" required>

    <label>Watch Section Limit </label>
    <input type="number" class="form-control my-3" name="watch" value="<?php echo $watch_limit; ?>" required>

    <label>Comment Section Limit </label>
    <input type="number" class="form-control my-3" name="comment" value="<?php echo $comment_limit; ?>" required>

    <input type="submit" class="btn btn-primary rounded-0 px-4" value="Update" name="update">

</form>
               

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

</html>