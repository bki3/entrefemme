<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin']) and $_SESSION['admin'] == '1'){
    echo "<script>window.location.href= './logout.php';</script>";
}

$stmt = mysqli_query($con, "SELECT * FROM `videos`");


if(isset($_POST['delete'])){
    $del = $_POST['delete'];
 
    $stmt2 = mysqli_query($con, "DELETE FROM `videos` WHERE `id` = '$del' ");
    if($stmt2) { 
        echo "<script> alert('Successfully Deleted!'); window.location.href= './videos.php';</script>";
    }else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './videos.php';</script>";
    }
} 


if(isset($_GET['lock'])){
    $lock = $_GET['lock'];
    $stmt3 = mysqli_query($con, "UPDATE `videos` SET `status` = '0' WHERE `id` = '$lock' ");
    if($stmt3){ 
        echo "<script> alert('Successfully Hidden!'); window.location.href= './videos.php';</script>";
    }else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './videos.php';</script>";
    }
}   

if(isset($_GET['unlock'])){
    $unlock = $_GET['unlock'];
    $stmt4 = mysqli_query($con, "UPDATE `videos` SET `status` = '1' WHERE `id` = '$unlock' ");
     if($stmt4){ 
         echo "<script> alert('Successfully Visible!'); window.location.href= './videos.php';</script>";
     }else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './videos.php';</script>";
    }
}  


if(isset($_POST['update'])){

    extract($_POST);
    
if($_FILES["fileToUpload"]["error"] == 0){

$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = round(microtime(true)) . '.' . "webp";

$target_dir = "../assets/img/";
$target_file = $target_dir . $newfilename;

if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){

     $stmt5 = mysqli_query($con, "UPDATE `videos` SET `link` = '$link', `title`= '$title', `main` = '1', `picture` = '$target_file' WHERE `id` = '$id' ");
     if($stmt5){ 
         echo "<script> alert('Successfully Updated!'); window.location.href= './videos.php';</script>";
     }else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './videos.php';</script>";
     }
}


}else{
 
   $stmt5 = mysqli_query($con, "UPDATE `videos` SET `link` = '$link', `title`= '$title', `main` = '1' WHERE `id` = '$id' ");
     if($stmt5){ 
         echo "<script> alert('Successfully Updated!'); window.location.href= './videos.php';</script>";
     }else{
        echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './videos.php';</script>";
    }
}

}  

if(isset($_POST['addnew'])){
    extract($_POST);

$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = round(microtime(true)) . '.' . "webp";

$target_dir = "../assets/img/";
$target_file = $target_dir . $newfilename;


if($_FILES["fileToUpload"]["error"] == 0){
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
	
	$stmt6= mysqli_query($con, "INSERT INTO `videos`(`link`, `title`, `main`, `status`, `picture`) VALUES ('$link',  '$title', '1', '1', '$target_file') ");
     
	if($stmt6){ echo "<script> alert('Successfully Added!'); window.location.href= './videos.php';</script>";
   	
	}else{
        	echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './videos.php';</script>";
	}
  

  } else {
    echo "<script>alert('Sorry, there was an error uploading your file.'); </script>";
    
    exit();
  }

}


}   // end new upload





?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Videos - Admin Panel</title>
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
          <li class="breadcrumb-item active">Youtube Videos</li>
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
      Create New Video
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Video</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">

                <input type="text" name="title" class="form-control my-2" placeholder="Type Title" required>
                <input type="text" name="link" class="form-control my-2" placeholder="Type Youtube Link" required>
		
		<label>Choose Image</label>
		<input type="file" name="fileToUpload" class="mb-2 form-control" required>
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
		<th>Image</th>
                <th>Link</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
           </thead>
           <tbody id="myTable">
                <?php
                if($stmt){
                    if(mysqli_num_rows($stmt) > 0){

                    while($row = mysqli_fetch_assoc($stmt)){
                
                    
                    if($row['status'] == '0'){
                        $status = '<span class="text-danger">Locked</span>';
                        $btn = "<a href='videos.php?unlock=".$row['id']."'><button type='button' name='unlock' value='".$row['id']."'  class='btn btn-primary text-light'><i class='fa fa-unlock'></i></button></a>";
                    }else{
                        $status = '<span class="text-success">Active</span>';   
                        $btn = "<a href='videos.php?lock=".$row['id']."'><button type='button' name='lock' value='".$row['id']."' class='btn btn-warning text-light'><i class='fa fa-lock'></i></button></a>";
                    }
                        print_r("
                        
                        <tr>
                            <td>".$row['id']."</td>
			<td><img src='".$row['picture']."' width='100%' height='70px' alt='No Image'></td>
                            <td><a href='".$row['link']."'>".$row['link']."</a></td>
                            <td>".ucfirst($row['title'])."</td>
                            <td>".$status."</td>
                            <td><form method='POST'><button data-bs-toggle='modal' data-bs-target='#myModal".$row['id']."' type='button' class='btn btn-info text-light'><i class='fa fa-edit'></i></button>
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
            <form method="POST"enctype="multipart/form-data">
                <input type="hidden" name="id" value="'.$row['id'].'" class="form-control">
                <input type="text" name="link" value="'.$row['link'].'" class="form-control my-2" required>
                <input type="text" name="title" value="'.$row['title'].'" class="form-control my-2" required>
		<input type="file" name="fileToUpload" class="form-control mb-2">
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
                    echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './videos.php';</script>";
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