<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php'); 

session_start();
include '../config/config.php';


if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}


$stmt = mysqli_query($con, "SELECT * FROM `subscriptions` ORDER BY `id` DESC");

$subscribers = array();
if($stmt){
  if(mysqli_num_rows($stmt) > 0){
    while($row = mysqli_fetch_assoc($stmt)){
      $data = array('name'=>$row['name'], 'email'=>$row['email']);
      array_push($subscribers, $data); 
    }
  }
}



$stmt = mysqli_query($con, "SELECT * FROM `services` ORDER BY `id` DESC");


/////////////////////////////////
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $stmt = mysqli_query($con, "DELETE FROM `services` WHERE `id` = '$id'");
    if($stmt){
        echo '<script>alert("Service Deleted Successful"); window.location.href = "services.php";</script>';
    }else{
        echo '<script>alert("Failed: '.mysqli_error($con).'"); window.location.href = "services.php";</script>';
    }

}



//////////////////////////////////////////////////////////////

if(isset($_POST['add_service'])){
    extract($_POST);
    
if($_FILES['fileToUpload']['error'] == 0 and isset($_FILES['fileToUpload']['name']) ){
        
    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if(!is_dir($target_dir)){
        mkdir($target_dir);
    }
    
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href = 'services.php'; </script>";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $image = $_FILES['fileToUpload']['name'];
        $details = str_replace("'", "\'", $details);

        $stmt = mysqli_query($con, "INSERT INTO `services` (`image`, `title`, `details`, `email`, `contact`) VALUES ('$image', '$title', '$details', '$email', '$contact')");
        if($stmt){

        foreach ($subscribers as $key => $value) {

          $sub_name = $subscribers[$key]['name'];
          $sub_email = $subscribers[$key]['email'];

            $mail = new PHPMailer(true);
         
              try {
                  $mail->SMTPDebug = 2;                                       
                  $mail->isSMTP();                                            
                  $mail->Host       = 'smtp.ionos.com';                    
                  $mail->SMTPAuth   = true;                             
                  $mail->Username   = 'support_team@entrefemme.com';                 
                  $mail->Password   = 'UnlockSuccesswithOurGuide2024@$';                        
                  $mail->SMTPSecure = 'ssl/tls';                              
                  $mail->Port       = 587;   
               
                  $mail->setFrom('support_team@entrefemme.com', 'Entre Femme');             
                  $mail->addAddress("$sub_email");
                  $mail->addAddress("$sub_email", "$sub_name");
                    
                  $mail->isHTML(true);                                  
                  $mail->Subject = "$title";
                  $mail->Body    = "<h1 style='text-align:center;'>$title</h1><img src='https://entrefemme.com/$img' width='100%'><br>$description<a href='https://entrefemme.com/'><button style='border:0px; color: white; padding:2%; background-color: #DF678B; text-align:center; '> Read more </button></a>";
                  $mail->AltBody = '';
                  $mail->send();
                    
              } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
              }
            }
            


          echo "<script> alert('Successfully Added!'); window.location.href= './services.php';</script>";
        }else{
          echo "<script> alert('Error: ".mysqli_error($con)."'); window.location.href= './services.php';</script>";
        }
    
          
      } else {
          echo "<script> alert('Error: Failed to Upload File'); window.location.href= './services.php';</script>";
      }
    }
    
    
    }else{
       echo "<script> alert('Error: ".$_FILES['fileToUpload']['error']."'); window.location.href= './services.php';</script>";
    }
    
}





?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Services - Admin Panel</title>
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



<script src="editor/ckeditor.js"></script>
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
          <li class="breadcrumb-item active">Services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            
            <div class="row">
                <div class="col-lg-12 col-6 mb-3">
                    <!-- Button to Open the Modal -->
<a href="services.php" class="float-end"> 
	<button type="button" class="btn btn-primary btn-sm rounded-0">
  		Go to Services
	</button>
</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" enctype="multipart/form-data">
                        <label>Service Name</label>
                        <input type="text" name="title" class="form-control" placeholder="Type service title">
                        
                        <br>
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Type email address">

                        <br>
                        <label>Contact No.</label>
                        <input type="text" name="contact" class="form-control" placeholder="Type contact number">
                        <br>
                        <textarea name="details" class="form-control" id="texteditor" placeholder="Describe the service "></textarea>
                                                         
                        <script>
                            CKEDITOR.replace('texteditor');
                        </script>

                        <br>
                        <label>Choose Image:</label>
                        <input type="file" name="fileToUpload" class="form-control">
                        <br>
                        <input type="submit" name="add_service" value="Add Service" class="btn btn-primary btn-sm px-4">
                        

                    </form>
                </div>
            </div>
            
          
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