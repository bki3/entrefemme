<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `categories` WHERE `status` = '0' ");


if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $stmt = mysqli_query($con, "DELETE FROM `categories` WHERE `id` = '$id' ");
    if($stmt){  
        echo "<script> alert('Successfully Deleted!'); window.location.href= './categories.php';</script>";
    } else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './categories.php';</script>";
    }
}   



if(isset($_POST['new'])){

    extract($_POST);
    $stmt = mysqli_query($con, "INSERT INTO `categories`(`cat_name`, `slogan`, `color`, `status`) VALUES('$name', '$slogan', 'newcolor', '0') ");
      if($stmt) {
          echo "<script> alert('Successfully Added!'); window.location.href= './categories.php';</script>";
      }else{
          echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './categories.php';</script>";
      }
} 



if(isset($_POST['enable'])){
    $id = $_POST['enable'];
    $stmt = mysqli_query($con, "UPDATE `categories` SET `menu` = '1' WHERE `id` = '$id' ");
    if($stmt) {
        echo "<script> alert('Successfully Enabled!'); window.location.href= './categories.php';</script>";
    }else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './categories.php';</script>";
    }
} 

if(isset($_POST['cat_update'])){
    extract($_POST);
    $stmt = mysqli_query($con, "UPDATE `categories` SET `cat_name` = '$catname', `slogan` = '$slogan' WHERE `id` = '$id' ");
    if($stmt){  
        echo "<script> alert('Successfully Updated!'); window.location.href= './categories.php';</script>";
    } else{
        echo "<script> alert('Failed to Update!'); window.location.href= './categories.php';</script>";
    }
}


if(isset($_POST['disable'])){
    $id = $_POST['disable'];
    $stmt = mysqli_query($con, "UPDATE `categories` SET `menu` = '0' WHERE `id` = '$id' ");
    if($stmt){  
        echo "<script> alert('Successfully Disabled!'); window.location.href= './categories.php';</script>";
    } else{
        echo "<script> alert('Failed to Update!'); window.location.href= './categories.php';</script>";
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
                <button type="button" class="btn btn-primary rounded-0 btn-sm float-end" data-bs-toggle="modal" data-bs-target="#myModal">
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
                                <input type="text" name="slogan" class="form-control" placeholder="Type slogan" required>
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
                <th>Category Name</th>
                <th>Slogan</th>
                <th>Navbar Status</th>
                <th>Action</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){

                        if($row['status'] == 0){
                            $btn = "<button type='submit' class='btn rounded-0 btn-danger btn-sm float-center' name='delete' value='".$row['id']."'>Delete</button>";
                            
                            $btn3 = "<button type='button' data-bs-toggle='modal' data-bs-target='#myModal".$row['id']."' class='btn btn-primary rounded-0 btn-sm float-center' name='edit'>Edit</button>";
                            
                        }
                        
                        if($row['menu'] == '1'){
                            $btn2 = "<button type='submit' class='btn rounded-0 btn-info btn-sm float-center' name='disable' value='".$row['id']."'>Disable</button>";
                            $in="<span class='text-success'>Enabled</span>";
                        }else{
                            $btn2 = "<button type='submit' class='btn rounded-0 btn-success btn-sm float-center' name='enable' value='".$row['id']."'>Enable</button>";
                            $in="<span class='text-danger'>Disabled</span>";
                        }
                        
                        if($row['id'] == '1'){
                            $btn = '';
                        }
                        print_r("
                        
                        <tr>
                            <td>".$row['cat_name']."</td>
                            <td>".$row['slogan']."</td>
                            <td>".$in."</td>
                            <td><form method='post'>".$btn.' '.$btn2.' '.$btn3."</form></td>
                        </tr>
                        
                        ");
                        
                        
print_r('
<div class="modal" id="myModal'.$row['id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
            <h3>Edit Category</h3>
            <hr>
            <form method="POST">
            <input type="hidden" class="form-control" value="'.$row['id'].'" name="id">
            <input type="text" class="form-control" placeholder="Category Name" name="catname" value="'.$row['cat_name'].'">
            <br>
            <input type="text" class="form-control" placeholder="Slogan here" name="slogan" value="'.$row['slogan'].'">
            <br>
            <input type="submit" class="btn btn-danger rounded-0 w-100" value="Update" name="cat_update">
                
            </form>
                
      </div>

    

    </div>
  </div>
</div>
');
                        
                        
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