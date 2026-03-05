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


if(isset($_POST['sendmail'])){
extract($_POST);

  if(isset($subs) and $subs == 1){ 
    foreach ($subscribers as $key => $value) {

      $sub_name = $subscribers[$key]['name'];
      $sub_email = $subscribers[$key]['email'];

      $mail = new PHPMailer(true);
 
      try {
          $mail->SMTPDebug = 2;                                       
          $mail->isSMTP();                                            
// $mail->Host       = 'smtp.ionos.com';                  
          $mail->Host       = 'smtp.gmail.com';  
          $mail->SMTPAuth   = true;                             
// $mail->Username   = 'support_team@entrefemme.com';                 
// $mail->Password   = 'UnlockSuccesswithOurGuide2024@$';                        
	  $mail->Username   = 'imcsaccess@gmail.com';
          $mail->Password   = 'qomvolsioflyfjgh';
          $mail->SMTPSecure = 'ssl/tls';                              
          $mail->Port       = 587;   
       
          $mail->setFrom('support_team@entrefemme.com', 'Entre Femme');               
          $mail->addAddress("$sub_email");
          $mail->addAddress("$sub_email", "$sub_name");
            
          $mail->isHTML(true);                                  
          $mail->Subject = "$subject";
          $mail->Body    = "<h1 style='text-align:center;'>$subject</h1>$message";
          $mail->AltBody = '';
          $mail->send();
            
          echo "<script>alert('Email sent Successfully');window.location.href = 'send_mail.php'; </script>";

      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
      }
      
    }


  }else{

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
          $mail->addAddress("$to");
          // $mail->addAddress("$to", "");
            
          $mail->isHTML(true);                                  
          $mail->Subject = "$subject";
          $mail->Body    = "<h1 style='text-align:center;'>$subject</h1>$message<a href='https://entrefemme.com/'><button style='border:0px; color: white; padding:2%; background-color: #DF678B; text-align:center; '> Visit our Website </button></a>";
          $mail->AltBody = '';
          $mail->send();

      echo "<script>alert('Email sent Successfully');window.location.href = 'send_email.php'; </script>";
            
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
      }
      

  }
}

?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Send Email to Subscribers - Admin Panel</title>
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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
          <li class="breadcrumb-item active">Send mail to Subscribers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <form method="POST">
          <div class="row">
            
            <div class="col-lg-6 mb-3">
              <div class="form-group">
                  <input type="text" id="myCheck" class="form-control" placeholder="Send To Specific Email" name="to">
              </div>
            </div>

            <div class="col-lg-6 mb-3">
              <div class="form-group">
                  <input type="checkbox" name="subs" value="1" onclick="func()"> Send to All Subscribers
              </div>
            </div>

            <div class="col-lg-12 mb-3">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Subject" name="subject">
              </div>
            </div>
            <div class="col-lg-12 mb-3">
              <div class="form-group">
                  <textarea class="form-control" id="texteditor" placeholder="Message..." name="message" rows="6"></textarea>

                   <script>
                      CKEDITOR.replace('texteditor');

                      function func(){
                        document.getElementById("myCheck").disabled = true;
                      }
                  </script>

              </div>
            </div>

            <div class="col-lg-6 mb-3">
              <div class="form-group">
                  <input type="submit" class="btn btn-danger btn-sm px-4 pull right" name="sendmail">
              </div>
            </div>

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

</html>
