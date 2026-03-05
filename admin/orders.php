<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `orders` ORDER BY `id` DESC");

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = mysqli_query($con, "DELETE FROM `orders` WHERE `id` = '$id'");
    
    if($stmt){

        $stmt2 = mysqli_query($con, "DELETE FROM `cart` WHERE `order_id` = '$id'");

        if($stmt2){
            echo "<script>alert('Deleted Successfully!'); window.location.href = './orders.php';</script>";
        }else{
            echo "<script>alert('Error:  ".mysqli_error($con)."'); window.location.href = './orders.php';</script>";
        }

    }else{
        echo "<script>alert('Error:  ".mysqli_error($con)."'); window.location.href = './orders.php';</script>";
    }

}


?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Orders - Admin Panel</title>
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
          <li class="breadcrumb-item active">Shop Orders</li>
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
                
            </div>
            </div>
            
           <table class="table table-striped table-hover">
           <thead>
                <th>Id</th>
                <th>Date</th>
                <th>Address</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){

                        
                        print_r("
                        
                        <tr>
                            <td>".$row['id']."</td>
                            <td>".$row['date']."</td>
                            <td>".$row['address']."</td>
                            <td>".$row['amount']."$</td>
                            <td><span class='text-success'>".$row['status']."</td>
                            <td><a href='view_order.php?id=".$row['id']."'><button class='btn btn-warning'><i class='fa fa-eye'></i></button></a>
                            <a href='orders.php?delete=".$row['id']."'><button class='mx-2 btn btn-danger'><i class='fa fa-trash'></i></button></a>
                            </td>
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