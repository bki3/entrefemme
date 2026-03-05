<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `users` WHERE `type` = '1'");


if(isset($_POST['update'])){
    extract($_POST);
    
    $stmt2 = mysqli_query($con, "UPDATE `users` SET `name` = '$name', `email`='$email', `link`='$link' WHERE `user_id` = '1' ");
    if($stmt2){  
        echo "<script> alert('Successfully Updated!'); window.location.href= './admins.php';</script>";
    }else{
        echo "<script> alert('Failed to Updated!'); window.location.href= './admins.php';</script>";
    }
}   




?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admins - Admin Panel</title>
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
          <li class="breadcrumb-item active">Admins</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            
            
           <table class="table table-striped table-hover">
           <thead>
                <th>Id</th>
                <th>User Name</th>
                <th>Email Address</th>
                <th>Author Link</th>
                <th>Access</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){
                
                        print_r("
                        
                        <tr>
                            <td>".$row['user_id']."</td>
                            <td>".ucfirst($row['name'])."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['link']."</td>
                            <td><button class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#myModal".$row['id']."'><i class='fa fa-edit'></i>Edit</button></td>
                        </tr>
                        
                        ");
                        
                        print_r('
                        <!-- The Modal -->
                        <div class="modal" id="myModal'.$row['id'].'">
                          <div class="modal-dialog">
                            <div class="modal-content">
                        
                              <!-- Modal body -->
                              <div class="modal-body">
                              <h4>Edit Info</h4>
                                   <form method="POST">
                                    <input type="hidden" class="form-control w-100" value="'.$row['id'].'" name="id">
                                    <label>Username: </label>
                                    <input type="text" class="form-control w-100" value="'.$row['name'].'" name="name" placeholder="Type Username">
                                    <br>
                                    <label>Email: </label>
                                    <input type="text" class="form-control" value="'.$row['email'].'" name="email" placeholder="Type Email Address">
                                    <br>
                                    <label>Author Link: </label>
                                    <input type="text" class="form-control" value="'.$row['link'].'" placeholder="Author Link" name="link">
                                    <br>
                                    <input type="submit" class="btn btn-info btn-sm px-5" value="Update" name="update">
                                    
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
      &copy; Copyright <strong><span>Entre Femme - <?php echo date('Y'); ?></span></strong>. All Rights Reserved
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