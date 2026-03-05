<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `jobs`");

if(isset($_POST['delete'])){
    $del = $_POST['delete'];
    $stmt2 = mysqli_query($con, "DELETE FROM `jobs` WHERE `id` = '$del' ");
      echo "<script> alert('Successfully Deleted!'); window.location.href= './jobs.php';</script>";
} 




if(isset($_POST['update'])){

    extract($_POST);
    $description = str_replace("'", "\'", $description);

    $stmt5 = mysqli_query($con, "UPDATE `jobs` SET `title` = '$title', `description`='$description', `department` = '$department', `office`= '$office', `vacancies`='$vacancies' WHERE `id` = '$id' ");
     if($stmt5){ echo "<script> alert('Successfully Updated!'); window.location.href= './jobs.php';</script>";}else{echo mysqli_error($con); }
}  

if(isset($_POST['addnew'])){
    
    extract($_POST);
    $description = str_replace("'", "\'", $description);
    $stmt6= mysqli_query($con, "INSERT INTO `jobs`(`title`, `description`, `department`, `office`, `vacancies`,  `status`) VALUES ('$title', '$description', '$department', '$office', '$vacancies', '0') ");
     if($stmt6){ echo "<script> alert('Successfully Added!'); window.location.href= './jobs.php';</script>";}else{echo mysqli_error($con); }
     
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
          <li class="breadcrumb-item active">Jobs</li>
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
      Add Job Post
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Job</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST">
                <!--<input type="hidden" name="id" class="form-control">-->
                <input type="text" name="title" class="form-control my-2" placeholder="Type Job Title" required>
                <input type="text" name="department" class="form-control my-2" placeholder="Department" required>
                <input type="text" name="office" class="form-control my-2" placeholder="Office Location (City, Country)" required>
                <input type="number" name="vacancies" class="form-control my-2" placeholder="Total Vacancies" required>
                <textarea name="description" class="form-control my-2" rows="4" placeholder="Type Description" required></textarea>
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
                <th>Title</th>
                <th>Depart.</th>
                <th>Office</th>
                <th>Applicants</th>
                <th>Vacancies</th>
                <th>Actions</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){
                
$row['description'] = str_replace("\'", "'", $row['description']);

$app = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `applications` WHERE `job_id` = '".$row['id']."'"));

$vac = $row['vacancies'] - $app;
                    
                        print_r("
                        
                        <tr style='height:20px !important;'>
                            <td>".ucfirst($row['title'])."</td>
                            <td>".$row['department']."</td>
                            <td>".$row['office']."</td>
                            <td>0".$app."</td>
                            <td>".$vac." left</td>
                            <td>
                            <form method='POST'><button data-bs-toggle='modal' data-bs-target='#myModal".$row['id']."' type='button' class='btn btn-info text-light'><i class='fa fa-edit'></i></button>
                            ".$btn."
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
                        print_r("<tr><td colspan='6' class='text-center'><b>No Records Found</b></td></tr>");
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