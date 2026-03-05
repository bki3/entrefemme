<?php 
session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= './login.php';</script>";
}

$facebook = '';
$twitter = '';
$instagram = '';
$stmt = mysqli_query($con, "SELECT * FROM `faq`");


if(isset($_POST['update'])){
    extract($_POST);
    
    $stmt0 = mysqli_query($con, "UPDATE `faq` SET `question` = '$question', `answer` = '$answer' WHERE `id` = '$id'");
     if($stmt0){

        echo "<script>alert('Updated Successful'); window.location.href = './faq.php';</script>";
    }else{
        echo "<script>alert('Failed to update'); window.location.href = './faq.php';</script>";
    }
    
}


if(isset($_POST['add'])){
    extract($_POST);
    
    $stmt2 = mysqli_query($con, "INSERT INTO `faq` (`question`, `answer`) VALUES ('$question', '$answer')");
     if($stmt2){

        echo "<script>alert('Successfully Added'); window.location.href = './faq.php';</script>";
    }else{
        echo "<script>alert('Failed to update'); window.location.href = './faq.php';</script>";
    }
    
}


if(isset($_GET['id'])){
    $id = $_GET['id'];    
    
    $stmt1 = mysqli_query($con, "DELETE FROM `faq` WHERE `id` = '$id'");
     if($stmt1){

        echo "<script>alert('Deleted Successful'); window.location.href = './faq.php';</script>";
    }else{
        echo "<script>alert('Failed to Delete'); window.location.href = './faq.php';</script>";
    }
    
}

?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>FAQ's - Admin Panel</title>
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

</head>

<body>
<?php include 'top_nav.php';?>
<?php include 'sidebar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Frequently Asked Question's</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Admin Panel</a></li>
          <li class="breadcrumb-item active">FAQ's</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12 col-6">
                    <button class="btn btn-primary rounded-0 px-3 pull-right" data-bs-toggle="modal" data-bs-target="#myModaladd">Add New Question</button>
                </div>
            </div>
            
                                           
<!-- The Modal -->
<div class="modal" id="myModaladd">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Question</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST">
                <input type="text" class="form-control rounded-0 py-2" placeholder="Type Question here..." name="question"><br>
                <textarea name="answer"  class="form-control rounded-0" rows="8" placeholder="Type answer here..."></textarea><br>
                
                <input type="submit" name="add" class="btn btn-info rounded-0 px-4" value="Add Question">
            </form>
      </div>

    </div>
  </div>
</div>
            
            
            
            
            <div class="row">
                <div class="col-lg-12 col-6">
                    
                    <table class="table table-condensed table-hovered">
                        <thead>
                            <th>Questions</th>
                            <th>Answer</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php 
                            if($stmt){
                                if(mysqli_num_rows($stmt) > 0){
                                    while($r=mysqli_fetch_assoc($stmt)){
                                        print_r('
                                        <tr>
                                            <td>'.$r['question'].'</td>
                                            <td>'.$r['answer'].'</td>
                                            <td>
                                            
                                                <form><button type="submit" name="id" value="'.$r['id'].'" class="btn btn-danger d-inline"><i class="fa fa-trash"></i></button></form>
                                                <button data-bs-toggle="modal" data-bs-target="#myModal'.$r['id'].'" class="btn btn-info d-inline"><i class="fa fa-edit"></i></button>
                                            
                                            </td>
                                        </tr>
                                        
                                        
<!-- The Modal -->
<div class="modal" id="myModal'.$r['id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit FAQs</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form method="POST">
                <input type="hidden" value="'.$r['id'].'" name="id" >
                <input type="text" class="form-control rounded-0 py-2" name="question" value="'.$r['question'].'"><br>
                <textarea name="answer"  class="form-control rounded-0" rows="8">'.$r['answer'].'</textarea><br>
                
                <input type="submit" name="update" class="btn btn-info rounded-0 px-4" value="Update">
            </form>
      </div>

    </div>
  </div>
</div>

                                        ');
                                    }
                                }
                            }
                            
                            ?>
                           
                        </tbody>
                    </table>
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