<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= 'login.php';</script>";
}


$stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'client_id'"));
if(isset($_POST['set'])){
    extract($_POST);

    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$client_id."' WHERE `id` = '".$stmt2['id']."'");
    if($stmt){
        echo "<script>alert('Updated successfully !!'); window.location.href='payment.php';</script>";
    }else{
        echo mysqli_error($con);
    }
}

$stmt3 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'stripe'"));
if(isset($_POST['stripe'])){
    extract($_POST);

    $stmt = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$client_id."' WHERE `id` = '".$stmt3['id']."'");
    if($stmt){
        echo "<script>alert('Updated successfully !!'); window.location.href='payment.php';</script>";
    }else{
        echo mysqli_error($con);
    }
}


?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Payment Settings - Admin Panel</title>
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
          <li class="breadcrumb-item active">Payment Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12 col-12">
                <h3>Paypal Integration</h3>
                <hr>
                <form method="POST">
                    <div class="form-group mb-1">
                        <label>Paypal Client ID <small>(sb is testing account)</small></label>
                        <input type="text" class="form-control" value="<?php echo $stmt2['setting_value']; ?>" name="client_id">
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Set Paypal Account" name="set">
                    </div>
                </form>
            </div>
            <hr>
            <div class="col-lg-12 col-12">
                <h3>Stripe Integration</h3>
                <span>Testing Key: <small>pk_test_51MY8YnHy9MICtNdqBnH8rx3vfd4l5je7Go2fDmmbtxb1TZ5GL5NgwuY9YztGiwImmkPyrEGwMn44ulVxcFKWmNqO00v6PKnmk4</small></span>
                <hr>
                <form method="POST">
                    <div class="form-group mb-1">
                        <label>Stripe Publishable Key </label>
                        <input type="text" class="form-control" value="<?php echo $stmt3['setting_value']; ?>" name="client_id">
                        
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm px-4" value="Set Stripe Account" name="stripe">
                    </div>
                </form>
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

</php>