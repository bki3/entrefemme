<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}



if(isset($_POST['update'])){
    extract($_POST);
    if(isset($_FILES['file']['name']) and !empty($_FILES['file']['name'])){
        
        $target_dir = "../shop/assets/images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
if (!is_dir($target_dir)) {
    mkdir($target_dir);
}

        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
         
         $error= "Sorry, your file was not uploaded.";
         echo "<script>alert(".$error.");window.location.href='shop_components.php';</script>";
        
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $st = mysqli_query($con, "UPDATE `shop_components` SET `title` = '$title', `description` = '$desc', `image` = 'assets/images/".$_FILES['file']['name']."' WHERE `id` = '$id'");
                
                if($st){
                    print_r('<script>alert("Successfully Updated"); window.location.href="shop_components.php";</script>');
                }else{
                    print_r('<script>alert("Failed to update"); window.location.href="shop_components.php";</script>');
                }
            
            
          } else {
            $error= "Sorry, there was an error uploading your file.";
            echo "<script>alert(".$error.");window.location.href='shop_components.php';</script>";
          }
          
        }
    
    }else{
        
        
        $st2 = mysqli_query($con, "UPDATE `shop_components` SET `title` = '$title', `description` = '$desc' WHERE `id` = '$id'");
        
        if($st2){
            echo '<script>alert("Successfully Updated"); window.location.href="shop_components.php";</script>';
        }else{
            echo mysqli_error($con);
        }
        
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



</head>

<body>
<?php include 'top_nav.php';?>
<?php include 'sidebar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Shop Components</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Admin Panel</a></li>
          <li class="breadcrumb-item active">Shop Components</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="container-fluid">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <?php 
                                    
                                    
    $stmt = mysqli_query($con, "SELECT * FROM `shop_components`");
    if($stmt){
        if(mysqli_num_rows($stmt) > 0){
            
            while($row=mysqli_fetch_assoc($stmt)){

                           
        print_r('
                                
        <div class="col-lg-6 col-6">
            <div class="card">
                <div class="card-header"><h4 class="text-center font-weight-bold">Position  '.$row['type'].'</h4></div>
                <div class="card-body p-2">
                    <img src="../shop/'.$row['image'].'" width="100%">
                    
                    <h3 class="py-3">'.$row['title'].'</h3>
                    <p>'.$row['description'].'</p>
                    <button data-bs-toggle="modal" data-bs-target="#myModal'.$row['id'].'" class="rounded-0 btn btn-primary w-100"><i class="fa fa-edit"></i> Modify </button>
                </div>
            </div>
        </div>
        
        
<!-- The Modal -->
<div class="modal" id="myModal'.$row['id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Position '.$row['type'].'</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form enctype="multipart/form-data" method="POST">
                <div class="my-3">
                    <input type="hidden" name="id" value="'.$row['id'].'">
                
                    <label>Title</label>
                    <input type="text" name="title" class="form-control rounded-0" value="'.$row['title'].'">
                </div>
                <div class="my-3" id="slogan">
                    <label>Slogan</label>
                    <textarea name="desc" class="form-control rounded-0">'.$row['description'].'</textarea>
                </div>
                
                <div class="my-3">
                    <label>Choose Image (Minimum "'.$row['recommended'].'")</label>
                    <input type="file" name="file" class="form-control rounded-0">
                </div>
                
                <div class="my-3">
                    <input type="submit" name="update" class="btn btn-primary rounded-0">
                </div>
            </form>
      </div>

    </div>
  </div>
</div>
                                
                                
                                ');
                                
        if($row['id'] == 5){
            echo "<hr>";
        }  
                            }
                            
                        }else{
                            echo "No records found";
                        }
                        
                    }
                    
                    ?>
                    
                </div>
            </div>
        </div><!-- End Left side columns -->
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