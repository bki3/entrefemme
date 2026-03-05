<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `applications`");


if(isset($_POST['delete'])){
    $del = $_POST['delete'];
    $stmt2 = mysqli_query($con, "DELETE FROM `applications` WHERE `id` = '$del' ");
      echo "<script> alert('Successfully Deleted!'); window.location.href= './applications.php';</script>";
} 



?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Careers - Admin Panel</title>
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
          <li class="breadcrumb-item">Careers</li>
          <li class="breadcrumb-item active">Applicants</li>
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
                <th>Full Name</th>
                <th>CoverLetter</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Resume</th>
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
                            <td>".ucfirst($row['fullname'])."</td>
                            <td>".$row['cover_letter']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['contact']."</td>
                            <td>".$row['city']."</td>
                            <td><a href='".$row['resume']."' target='_blank'>Resume</a></td>
                            <td>
                            <form method='POST'>
   
                            <button type='button' class='btn btn-danger text-light' data-bs-toggle='modal' data-bs-target='#delete".$row['id']."'><i class='fa fa-trash'></i></button></form></td>
                        </tr>
                        
                        ");
                        
                        print_r('
                        
                        
<!-- The Modal -->
<div class="modal" id="delete'.$row['id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST">
                <label>Are you sure you want to delete?</label><br><br>
                <button type="submit" name="delete" value="'.$row['id'].'" class="pull-right btn btn-danger btn-sm px-4 text-light">Yes</button>
                <button type="button" data-bs-dismiss="modal" class="pull-right mx-2 btn btn-info px-4 btn-sm text-light">No</button>
            </form>
      </div>

    </div>
  </div>
</div>
                        
                        
                        
<!-- The Modal -->
<div class="modal" id="myModal'.$row['id'].'">
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
                <input type="hidden" name="id" value="'.$row['id'].'" class="form-control">
                <label>Job Title</label>
                <input type="text" name="title" value="'.$row['title'].'" class="form-control my-2" required>
                <label>Department</label>
                <input type="text" name="department" value="'.$row['department'].'" class="form-control my-2" required>
                <label>Office Location</label>
                <input type="text" name="office" value="'.$row['office'].'" class="form-control my-2" required>
                <label>Jobs Vacancies/Seats</label>
                <input type="number" name="vacancies" value="'.$row['vacancies'].'" class="form-control my-2" required>
                <label>Description</label>
                <textarea rows="6" name="description" class="form-control my-2" required>'.$row['description'].'</textarea>
                
                <input type="submit" name="update" class="btn btn-sm btn-info px-5" value="Update">
            </form>
      </div>
    </div>
  </div>
</div>


                        
                        ');
                    }

                    }else{
                        print_r("<tr><td colspan='8' class='text-center'><b>No Records Found</b></td></tr>");
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