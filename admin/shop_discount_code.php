<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `discount_code`");

if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $stmt = mysqli_query($con, "DELETE FROM `discount_code` WHERE `id` = '$id' ");
      echo "<script> alert('Successfully Deleted!'); window.location.href= './shop_discount_code.php';</script>";
}   



if(isset($_POST['new'])){

    $code = $_POST['code'];
    $amount = $_POST['amount'];
    $stmt = mysqli_query($con, "INSERT INTO  `discount_code` (`code`, `amount`, `status`) VALUES('$code',  '$amount', '1') ");
      if($stmt) {
          echo "<script> alert('Successfully Added!'); window.location.href= './shop_discount_code.php';</script>";
      }else{
          echo mysqli_error($con);
          echo "<script> alert('Failed to Add!'); window.location.href= './shop_discount_code.php';</script>";
      }
} 


if(isset($_POST['update'])){
    
    extract($_POST);

    $stmt = mysqli_query($con, "UPDATE `discount_code` SET `code`='$code', `amount`='$amount' WHERE `id` = '$id' ");
      if($stmt) {
          echo "<script> alert('Updated Added!'); window.location.href= './shop_discount_code.php';</script>";
      }else{
          echo mysqli_error($con);
          echo "<script> alert('Failed to Add!'); window.location.href= './shop_discount_code.php';</script>";
      }
} 

?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Discount Coupons - Admin Panel</title>
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
          <li class="breadcrumb-item active">Discount Code</li>
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
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#myModal">
                Add New Code
                </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Code</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST">
                                
                                <div class="form-group mb-2">
                                <input type="text" name="code" class="form-control" placeholder="Type Code " required>
                                </div>
                                <div class="form-group my-2">
                                <input type="number" name="amount" class="form-control" placeholder="Type Amount in Percentage " required>
                                </div>

                                <div class="form-group my-2">
                                    <input type="submit" class="btn btn-primary btn-sm float-end" name="new" value="Add New">
                                </div>

                            </form>
                        </div>

                        </div>
                    </div>
                    </div>
            </div>
            </div>
            
           <table class="table table-striped table-hover">
           <thead>
                <th>Discount Code</th>
                <th>Discount Amount %</th>
                <th>Action</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){

                        
$btn = "<button type='submit' class='btn btn-danger btn-sm float-center' name='delete' value='".$row['id']."'>Delete</button>";
                        
                        print_r("
                        
                        <tr>
                            <td>".$row['code']."</td>
                            <td>".$row['amount']."%</td>
                            <td><form method='post'>".$btn." &nbsp; <button data-bs-toggle='modal' class='btn btn-info btn-sm' data-bs-target='#update".$row['id']."' type='button' >Edit</button></form></td>
                        </tr>
                        
                        ");
                        
                        print_r('
                        <!-- The Modal -->
                    <div class="modal" id="update'.$row['id'].'">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Code</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST">
                                
                                <div class="form-group py-0 mt-0 mb-2">
                                <input type="hidden" name="id" class="form-control" value="'.$row['id'].'" placeholder="Type Code " required>
                                <label>Discount Code</label>
                                <input type="text" name="code" class="form-control" value="'.$row['code'].'" placeholder="Type Code " required>
                                </div>
                                <div class="form-group my-2">
                                <label>Discount Amount (%)</label>
                                <input type="number" name="amount" class="form-control" value="'.$row['amount'].'" placeholder="Type Amount in Percentage " required>
                                </div>

                                <div class="form-group my-2">
                                    <input type="submit" class="btn btn-primary btn-sm float-end" name="update" value="Update">
                                </div>

                            </form>
                        </div>

                        </div>
                    </div>
                    </div>');
                    }

                    }else{
                        print_r("<tr><td colspan='5' class='text-center'><b>No Code Found</b></td></tr>");
                    }
                    
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