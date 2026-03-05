<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= 'login.php';</script>";
}

$author = ''; $keywords = ''; $description = '';

$stmt = mysqli_query($con, "SELECT * FROM `seo` ");

if($stmt){ 
    if(mysqli_num_rows($stmt) > 0){
        $data = mysqli_fetch_assoc($stmt);
        $author = $data['author']; $keywords = $data['keywords']; $description = $data['description'];
    }
}

if(isset($_POST['update'])){
    extract($_POST);
    $keywords = str_replace("'", "", $keywords);

    $stmt = mysqli_query($con, "UPDATE `seo` SET `author` = '$name', `keywords` = '$keywords', `description` = '$description'");
    
    if($stmt){
        echo "<script>alert('Updated Successful'); window.location.href = './seo.php';</script>";
    }else{
        print_r($stmt);
    }
}


?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Search Engine Optimization - Admin Panel</title>
  <meta content="Search Engine Optimization" name="description">
  <meta content="Colonoscopy food chech" name="keywords">
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
          <li class="breadcrumb-item active">Search Engine Optimization</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
           
        <form method="post">
            <div class="row">
                <div class="col">
                    <label>Website Author</label>
                    <input type="text" class="form-control" value="<?php echo $author;?>" placeholder="Website Author" name="name">  
                </div>
                <div class="col">
                </div>
            </div>
            
            <div class="row mt-3">
                 <div class="col">
                     <label>Keywords (must be Comma (,) Seprated)</label>
                    <textarea rows="5" class="form-control" placeholder="Keywords" name="keywords"><?php echo $keywords;?></textarea>
                </div>
                <div class="col">
                    
                </div>
            </div>
            
             <div class="row mt-3">
                <div class="col">
                    <label>Description</label>
                    <textarea rows="5" class="form-control" type="text" placeholder="Description " name="description"><?php echo $description;?></textarea>
                </div>
                <div class="col"></div>
            </div>
            
            <div class="row mt-3">
                <div class="col">
                    <input type="submit" class="btn btn-dark" name="update" value="Update">
                </div>
                <div class="col"></div>
            </div>
        </form>
            

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

</php>