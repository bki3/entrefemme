<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `shop_cats` WHERE `status` = '0'");


if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $stmt = mysqli_query($con, "UPDATE  `shop_cats` SET `status` = '1' WHERE `id` = '$id' ");
      echo "<script> alert('Successfully Deleted!'); window.location.href= './shop_categories.php';</script>";
}   



if(isset($_POST['new'])){

    $name = $_POST['name'];
    $stmt = mysqli_query($con, "INSERT INTO  `shop_cats` (`cat_name`, `status`) VALUES('$name',  '0') ");
      if($stmt) {
          echo "<script> alert('Successfully Added!'); window.location.href= './shop_categories.php';</script>";
      }else{
          echo mysqli_error($con);
          echo "<script> alert('Failed to Add!'); window.location.href= './shop_categories.php';</script>";
      }
} 

?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Categories - Admin Panel</title>
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
          <li class="breadcrumb-item active">Categories</li>
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
                Add New Category
                </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Category</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST">
                                
                                <div class="form-group my-2">
                                <input type="text" name="name" class="form-control" placeholder="Type category name" required>
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
                <th>Id</th>
                <th>Category Name</th>
                <th>Action</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){

                        if($row['status'] == 0){
                            $btn = "<button type='submit' class='btn btn-danger btn-sm float-center' name='delete' value='".$row['id']."'>Delete</button>";
                        }
                        print_r("
                        
                        <tr>
                            <td>".$row['id']."</td>
                            <td>".$row['cat_name']."</td>
                            <td><form method='post'>".$btn."</form></td>
                        </tr>
                        
                        ");
                    }

                    }else{
                        print_r("<tr><td colspan='5' class='text-center'><b>No Records Found</b></td></tr>");
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