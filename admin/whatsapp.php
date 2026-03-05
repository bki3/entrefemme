<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$facebook = '';
$twitter = '';
$instagram = '';
$stmt = mysqli_query($con, "SELECT * FROM `settings` WHERE `setting_name` = 'whatsapp'");
if($stmt){

    while($row = mysqli_fetch_assoc($stmt)){
       $whatsapp = $row['setting_value'];
    }
}

if(isset($_POST['update'])){

    $stmt0 = mysqli_query($con, "UPDATE `settings` SET `setting_value` = '".$_POST['whatsapp']."' WHERE `setting_name` = 'whatsapp'");
     if($stmt0){

        echo "<script>alert('Updated Successful'); window.location.href = './whatsapp.php';</script>";
    }else{
        echo "<script>alert('Failed to update '); window.location.href = './whatsapp.php';</script>";
    }
   

} // facebook update end here



?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Whatsapp - Admin Panel</title>
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
          <li class="breadcrumb-item active">WhatsApp</li>
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
                        <h1 class="text-center">WhatsApp</h1>
                        <p class="text-center"><b>Note:</b> Always use Country code with WhatsApp Number Ex. (+1123567890)</p>
                    <hr>
                </div>
                <div class="col-lg-6 col-6">
                    <form method="POST">
                        
                        <label>WhatsApp Number</label>
                        <input type="text" class="form-control" value="<?php echo $whatsapp; ?>" name="whatsapp" placeholder="Type WhatsApp Number">
                        <br>
                        
                        <input type="submit" name="update" class="btn btn-info px-5 text-light" value="Update">

                    </form>
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