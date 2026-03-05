<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

if(isset($_GET['id'])){
    
    $stmt = mysqli_query($con, "SELECT * FROM `cart` WHERE `order_id` = '".$_GET['id']."' AND `status` = '1'");
    
    if(!$stmt){
        echo "<script>alert('Error:  ".mysqli_error($con)."'); window.location.href = './orders.php';</script>";
    }

}else{
    echo "<script>window.location.href = './orders.php';</script>";
}




?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Order - Admin Panel</title>
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
          <li class="breadcrumb-item active">Order Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            
            <div class="row">
                <div class="col-lg-6 col-6">
                    <input id="myInput" type="text" class="form-control col-md-12 float-start" placeholder="Search..">
                </div>
            <div class="col-lg-6 col-6 mb-3">
                <a href="orders.php"><button class="btn btn-primary px-4 pull-right"><i class="fa fa-arrow-left"></i> Go Back</button></a>
            </div>
            </div>
            
           <table class="table table-striped table-hover">
           <thead>
                <th>Id</th>
                <th>Product</th>
                <th>Name</th>
                <th>User</th>
                <th>Quantity</th>
                <th>Price</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){

                $stmt2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `products` WHERE `id` = '".$row['product']."'"));
               $stmt3 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `product_pics` WHERE `product_id` = '".$stmt2['id']."' ORDER BY `id` DESC"));

                if(!$stmt2){
                    echo "<script>alert('Products Error:  ".mysqli_error($con)."'); window.location.href = './orders.php';</script>";
                }

                        print_r("
                        
                        <tr>
                            <td>".$row['id']."</td>
                            <td><img src='".$stmt3['source']."' width='100vw'></td>
                            <td>".$stmt2['name']."</td>
                            <td>".$row['user']."</td>
                            <td>".$row['quantity']."</td>
                            <td>".$stmt2['price']."$</td>
                        </tr>
                        
                        ");
                    }

                    }else{
                        print_r("<tr><td colspan='6' class='text-center'><b>No Records Found</b></td></tr>");
                    }
                    
                }else{
                    echo "<script>alert('Error:  ".mysqli_error($con)."'); window.location.href = './orders.php';</script>";
                }

                ?>
           </tbody>
           </table>

          </div>
        </div><!-- End Left side columns -->

        

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>EntreFemme</span></strong>. All Rights Reserved
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