<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `testimonials` ORDER BY `id` DESC");



if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = mysqli_query($con, "DELETE FROM `testimonials` WHERE `id` = '$id'");
    if($stmt){
        echo "<script>alert('Deleted Successfully'); window.location.href = './testimonials.php';</script>";
    }else{
        echo "<script>alert('Error: ".mysqli_error($con)."'); window.location.href = './testimonials.php';</script>";
    }

}



////// update codes start here 
if(isset($_POST['update'])){
    extract($_POST);
    
if($_FILES['fileToUpload']['error'] == 0){
        
    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $image = $_FILES['fileToUpload']['name'];
        $stmt = mysqli_query($con, "UPDATE `testimonials` SET `image` = '$image', `title` = '$title', `details` = '$details'  WHERE `id` = '$id' ");
        if($stmt) { 
            echo "<script> alert('Successfully Updated!'); window.location.href= './testimonials.php';</script>"; 
        }else{
            echo "<script>alert('Error: ".mysqli_error($con)."'); window.location.href = './testimonials.php'; </script>";
        }
    
          
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    
    
}else{
    
    $stmt = mysqli_query($con, "UPDATE `testimonials` SET `title` = '$title', `details` = '$details'  WHERE `id` = '$id' ");
      echo "<script> alert('Successfully Updated!'); window.location.href= './testimonials.php';</script>";
    
}

    
}   


//////////////////////////////////////////////////////////////

if(isset($_POST['addnew'])){
    extract($_POST);
    
    if($_FILES['fileToUpload']['error'] == 0){
        
        $target_dir = "../assets/img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script> alert('Error: Invalid Image File'); window.location.href= './testimonials.php';</script>";

        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $image = $_FILES['fileToUpload']['name'];
                $stmt = mysqli_query($con, "INSERT INTO `testimonials` (`image`, `title`, `details`) VALUES ('$image', '$title', '$details')");
                if($stmt) { 
                    echo "<script> alert('Successfully Added!'); window.location.href= './testimonials.php';</script>";
                }else{
                    echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './testimonials.php';</script>";
                }
            
                
            } else {
                    echo "<script> alert('Error: Failed to upload Image.'); window.location.href= './testimonials.php';</script>";
            }
        }
    
    
    }
    
}   



?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Testimonials - Admin Panel</title>
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
          <li class="breadcrumb-item active">Testimonials</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            
            <div class="row">
                <div class="col-lg-8 col-6">
                    <input id="myInput" type="text" class="form-control col-md-12 float-start" placeholder="Search..">
                </div>
                <div class="col-lg-4 col-6 mb-3">
                    <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#myModal">
  Add Review
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Review</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form enctype="multipart/form-data" method="POST">
            <label>Title</label>
            <input class="form-control rounded-0" type="text" name="title" required>
            <br>
            <label>Choose Image</label>
            <input class="form-control rounded-0" type="file" name="fileToUpload" required>
            <br>
            <label>Message</label>
            <textarea class="form-control rounded-0" rows="5" name="details" required></textarea>
            <br>
            <input type="submit" value="UPDATE" class="btn btn-danger w-100 rounded-0 btn-sm" name="addnew">
        </form>
      </div>

    </div>
  </div>
</div>

                </div>
            </div>
            
           <table class="table table-striped table-hover">
           <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Message</th>
                <th>Action</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){

                        
            $btn = "<a href='./testimonials.php?delete=".$row['id']."'><button type='button' class='btn btn-danger btn-sm rounded-0' name='delete' value='".$row['id']."'>Delete</button></a>";
                        
                        print_r("
                        
                        <tr>
                            <td><img src='../assets/img/".$row['image']."' width='100px'></td>
                            <td>".$row['title']."</td>
                            <td>".$row['details']."</td>
                            <td><form method='post'>".$btn."<button type='button' data-bs-toggle='modal' data-bs-target='#myModal".$row['id']."' class='btn btn-info rounded-0 btn-sm'>Edit</button></form></td>
                        </tr>
                        
                        
                        ");
                        
                        echo '<!-- The Modal -->
<div class="modal" id="myModal'.$row['id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Testimonials</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="'.$row['id'].'">
            <label>Title</label>
            <input class="form-control rounded-0" type="text" name="title" value="'.$row['title'].'" required>
            <br>
            <label>Choose Image</label>
            <input class="form-control rounded-0" type="file" name="fileToUpload">
            <br>
            <label>Message</label>
            <textarea class="form-control rounded-0" rows="5" name="details" required>'.$row['details'].'</textarea>
            <br>
            <input type="submit" value="UPDATE" class="btn btn-danger w-100 rounded-0 btn-sm" name="update">
        </form>
      </div>

    </div>
  </div>
</div>';
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