<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `users` WHERE `type` = '2'");


if(isset($_POST['delete'])){
    $del = $_POST['delete'];
    $stmt2 = mysqli_query($con, "DELETE FROM `users` WHERE `user_id` = '$del' ");
    if($stmt2){ 
        echo "<script> alert('Successfully Deleted!'); window.location.href= './authors.php';</script>"; 
    }else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './authors.php';</script>"; 
        
    }
} 


if(isset($_POST['lock'])){
    $lock = $_POST['lock'];
    $stmt3 = mysqli_query($con, "UPDATE `users` SET `status` = '1' WHERE `user_id` = '$lock' ");
    if($stmt3){ echo "<script> alert('Successfully Locked!'); window.location.href= './authors.php';</script>";}else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './authors.php';</script>";
    }
}   

if(isset($_POST['unlock'])){
    $unlock = $_POST['unlock'];
    $stmt4 = mysqli_query($con, "UPDATE `users` SET `status` = '0' WHERE `user_id` = '$unlock' ");
     if($stmt4){ echo "<script> alert('Successfully Unlocked!'); window.location.href= './authors.php';</script>";}else{
         echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './authors.php';</script>"; 
        }
}  


if(isset($_POST['update'])){

    extract($_POST);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $stmt5 = mysqli_query($con, "UPDATE `users` SET `name` = '$name', `email`= '$email',  `link`= '$link', `password` = '$password', `type`='$type' WHERE `user_id` = '$id' ");
    if($stmt5){ echo "<script> alert('Successfully Updated!'); window.location.href= './authors.php';</script>";}else{ 
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './authors.php';</script>"; 
    }
}  

if(isset($_POST['addnew'])){
    extract($_POST);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $stmt6= mysqli_query($con, "INSERT INTO `users`(`name`, `password`, `email`, `link`, `type`, `status`) VALUES ('$name',  '$password', '$email', '$link', '$type', '0') ");
    if($stmt6){ echo "<script> alert('Successfully Added!'); window.location.href= './authors.php';</script>";}else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './authors.php';</script>"; 
    }
}  





?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Accounts - Admin Panel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<?php include 'links.php';?>


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
          <li class="breadcrumb-item active">Authors</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
<button type="button" class="btn btn-primary px-3 pull-right" data-bs-toggle="modal" data-bs-target="#myModal">
      Create New Author
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Author</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST">
                <input type="hidden" name="id" class="form-control">
                <input type="text" name="name" class="form-control my-2" placeholder="Type Author Name" required>
                <input type="email" name="email" class="form-control my-2" placeholder="Type Author Email" required>
                <input type="password" name="password" class="form-control my-2" placeholder="Set Password" required>
                <input type="text" name="link" class="form-control my-2" placeholder="Author Link" required>
                <select name="type" class="form-control my-2">
                    <option value="2">Author</option>
                    <option value="1">Admin</option>
                </select>
                <input type="submit" name="addnew" class="btn btn-sm btn-primary px-5" value="Add Now">
            </form>
      </div>
    </div>
  </div>
</div>

                </div>
            </div>
          <div class="row">
            
           <table class="table table-striped table-hover">
           <thead>
                <th>Id</th>
                <th>User Name</th>
                <th>Email Address</th>
                <th>Author Link</th>
                <th>Status</th>
                <th>Actions</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){
            
                    
                    if($row['status'] == '1'){
                        $status = '<span class="text-danger">Locked</span>';
                        $btn = "<button type='submit' name='unlock' value='".$row['user_id']."'  class='btn btn-primary text-light'><i class='fa fa-unlock'></i></button>";
                    }else{
                        $status = '<span class="text-success">Active</span>';   
                        $btn = "<button type='submit' name='lock' value='".$row['user_id']."' class='btn btn-warning text-light'><i class='fa fa-lock'></i></button>";
                    }
                        print_r("
                        
                        <tr>
                            <td>".$row['user_id']."</td>
                            <td>".ucfirst($row['name'])."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['link']."</td>
                            <td>".$status."</td>
                            <td><form method='POST'><button data-bs-toggle='modal' data-bs-target='#myModal".$row['user_id']."' type='button' class='btn btn-info text-light'><i class='fa fa-edit'></i></button>
                            ".$btn."
                            <button type='button' class='btn btn-danger text-light' data-bs-toggle='modal' data-bs-target='#delete".$row['user_id']."'><i class='fa fa-trash'></i></button></form></td>
                        </tr>
                        
                        ");
                        
                        print_r('
                        
                        
<!-- The Modal -->
<div class="modal" id="delete'.$row['user_id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST">
                <label>Are you sure you want to delete?</label><br><br>
                <button type="submit" name="delete" value="'.$row['user_id'].'" class="pull-right btn btn-danger btn-sm px-4 text-light">Yes</button>
                <button type="button" data-bs-dismiss="modal" class="pull-right mx-2 btn btn-info px-4 btn-sm text-light">No</button>
            </form>
      </div>

    </div>
  </div>
</div>
                        
                        
                        
<!-- The Modal -->
<div class="modal" id="myModal'.$row['user_id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modify Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST">
                <input type="hidden" name="id" value="'.$row['user_id'].'" class="form-control">
                <input type="text" name="name" value="'.$row['name'].'" placeholder="Type Author Name" class="form-control my-2" required>
                <input type="email" name="email" value="'.$row['email'].'" placeholder="Type Email Address" class="form-control my-2" required>
                <input type="password" name="password" value="'.$row['password'].'" placeholder="Set Password" class="form-control my-2" required>
                <input type="text" name="link" value="'.$row['link'].'" placeholder="Author Link" class="form-control my-2" required>
                <select name="type" class="form-control my-2">
                    <option value="2">Author</option>
                    <option value="1">Admin</option>
                </select>
                <input type="submit" name="update" class="btn btn-sm btn-info px-5" value="Update">
            </form>
      </div>
    </div>
  </div>
</div>


                        
                        ');
                    }

                    }else{
                        print_r("<tr><td colspan='6' class='text-center'><b>No Records Found</b></td></tr>");
                    }
                    
                }else{
            echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './authors.php';</script>"; 

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