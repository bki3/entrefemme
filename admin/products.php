<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php'); 


session_start();
include '../config/config.php';
if(!isset($_SESSION['admin'])){
    echo "<script>window.location.href= 'login.php';</script>";
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



# --------- Delete Section Coding starts here --------------
$stmt = mysqli_query($con, "SELECT * FROM `products` ORDER BY `id` DESC");
$stmt2 = mysqli_query($con, "SELECT * FROM `shop_cats`");

if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $stmt3 = mysqli_query($con, "DELETE FROM `products` WHERE `id` = '$id' ");
    if($stmt3){ 
        echo "<script> alert('Successfully Deleted!'); window.location.href= './products.php';</script>";
    }else{
        echo "<script>alert('Delete Error:  ".mysqli_error($con)."'); window.location.href = './products.php';</script>";
    }
}  





if(isset($_POST['new'])){
    extract($_POST);
 
$errr=0;

    if(isset($_POST['usa'])){
        $usa='1';
    }else{
        $usa='0';
    }
    
    if(isset($_POST['others'])){
        $uk='1';
    }else{
        $uk='0';
    }
    
    if(isset($_POST['europe'])){
        $europe='1';
    }else{
        $europe='0';
    }

$name = str_replace("'", "\'", $name);
$description = str_replace("'", "\'", $description);
    $stmt3 = mysqli_query($con, "INSERT INTO `products`(`name`, `price`,  `stock`, `color`, `size`, `category`, `description`, `europe`, `usa`, `others`, `picture`, `views`, `shipping`, `tax`, `status`) VALUES ('$name', '$price', '$stock', '$color', '$size', '$category', '$description', '$europe', '$usa', '$uk', '', '0', '0', '0', '0') ");
    
    if($stmt3){

        $errr=1;


    }else{
        echo "<script>alert('Add Product Error:  ".mysqli_error($con)."'); window.location.href = './products.php';</script>";
    }
    
    
    

$stmttt = mysqli_query($con, "SELECT * FROM `products` ORDER BY `id` DESC");  
$iid=mysqli_fetch_assoc($stmttt);

$idd=$iid['id'];

//$files = array_filter($_FILES['upload']['name']); //something like that to be used before processing files.

// Count # of uploaded files in array
$total = count($_FILES['files']['name']);

$done = 0;

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

  //Get the temp file path
  $tmpFilePath = $_FILES['files']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $_FILES['files']['name'][$i] = str_replace(" ", "_",  $_FILES['files']['name'][$i]);
    $newFilePath = "../shop/assets/images/" . $_FILES['files']['name'][$i];
    
    
    
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
    
    if($errr==1){
            
        $sql99 = mysqli_query($con, "INSERT INTO `product_pics` (`product_id`, `source`) VALUES ('$idd', '$newFilePath')");
        
        if($sql99){
            $done = 1;
            echo "<script> alert('Product Added Successfully'); window.location.href= './products.php';</script>";
        }

    }else{
          echo "<script> alert('Failed to Add!'); window.location.href= './products.php';</script>";
    }    
    
    }
  }
}

    $img = str_replace("../", "", $newFilePath);
    foreach ($subscribers as $key => $value) {

      $sub_name = $subscribers[$key]['name'];
      $sub_email = $subscribers[$key]['email'];

    $mail = new PHPMailer(true);
 
      try {
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
          $mail->Subject = "$name";
          $mail->Body    = "<h1 style='text-align:center;'>$name</h1><img src='https://entrefemme.com/$img' width='100%'><br><h2>$price</h2><br>$description<a href='https://entrefemme.com/shop/'><button style='border:0px; color: white; padding:2%; background-color: #DF678B; text-align:center; '>Shop Now</button></a>";
          $mail->AltBody = '';
          $mail->send();
            
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
      }
    }



if(unlink($iid['picture'])){
  
    $ss = mysqli_query($con, "UPDATE `products` SET `picture` = '$newFilePath' WHERE `id` = '$idd'");
    if($ss){
        echo "<script>alert('Updated Successful!'); window.location.href = './products.php';</script>";
    }else{
        echo "<script>alert('Failed to Update!'); window.location.href = './products.php';</script>";
    }

}else{
    
    
    $ss = mysqli_query($con, "UPDATE `products` SET `picture` = '$newFilePath' WHERE `id` = '$idd'");
    if($ss){
        echo "<script>alert('Updated Successful!'); window.location.href = './products.php';</script>";
    }else{
        echo "<script>alert('Failed to Update!'); window.location.href = './products.php';</script>";
    }

}

    

} 




?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Products - Admin Panel</title>
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
          <li class="breadcrumb-item active">Shop Products</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12 mb-3">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <input id="myInput" type="text" class="form-control col-md-12 float-start" placeholder="Search..">
                </div>
            <div class="col-lg-6 col-6 mb-3">
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#myModal">
                Add New Product
                </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Product</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data">
                                
                                <div class="form-group my-2">
                                    <input type="text" name="name" class="form-control" placeholder="Type product name" required>
                                </div>
                                
                                <div class="form-group mt-2">
                                    <select name="category" class="form-control">
                                        <option value="1">-- Select Category --</option>
                                        <?php 
                                            if(mysqli_num_rows($stmt2) > 0){
                                                while($row2 = mysqli_fetch_assoc($stmt2)){
                                                    print_r("<option value='".$row2['cat_name']."'>".$row2['cat_name']."</option>");
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                 
                                <div class="row my-2">
                                    <div class="col">
                                    <input type="text" name="price" class="form-control" placeholder="Type price " required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="stock" class="form-control" placeholder="Type stock " required>
                                    </div>
                                </div>
                                
                                <div class="row my-2">
                                    <div class="col">
                                    <input type="text" name="shipping" class="form-control" placeholder="Type shipping " required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="tax" class="form-control" placeholder="Type taxes " required>
                                    </div>
                                </div>
                           
                                <div class="row my-2">
                                    <div class="col">
                                    <input type="text" name="color" class="form-control" placeholder="Type Colors comma(,) seprated" required>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col">
                                        <input type="text" name="size" class="form-control" placeholder="Type Size (Ex. Small, Medium, Large) Comma(,) Seprated" required>
                                    </div>
                                </div>
                           
                                
                                <div class="form-group my-2">
                                    <textarea name="description" id="texteditor" rows="4" class="form-control" placeholder="Type product description" required></textarea>
                                </div>
                                
                                
                                <script>
                                    CKEDITOR.replace('texteditor');
                                </script>
                                
                                
                            
                                <div class="row my-2">
                                    <div class="col">
                                        <label>Choose Country</label>
                                        <label><input type="checkbox" name="europe"> Europe </label>
                                    </div>
                                    <div class="col">
                                        <label><input type="checkbox" name="usa"> USA </label>
                                    </div>
                                    <div class="col">
                                        <label><input type="checkbox" name="others"> Others </label>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                <div class="form-group my-2">
                                    <input type="file" name="files[]" class="form-control" required multiple>
                                </div>

                                <div class="form-group my-2">
                                    <input type="submit" class="btn btn-primary btn-sm float-end" name="new" value="Add New">
                                </div>

                            </form>
                        </div>

                        </div>
                    </div>
                    </div>
            </div>
                </div>
            </div>
            
           <table class="table table-striped">
           <thead>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Shipping</th>
                <th>Tax</th>
                <th>Stock</th>
                <th>Description</th>
                <th>Action</th>
           </thead>
           <tbody id="myTable">


<?php 

    if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;


    $total_pages_sql = "SELECT COUNT(*) FROM `products`";
    $result = mysqli_query($con, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $sql = "SELECT * FROM `products` ORDER BY `id` DESC LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($con,$sql);

    if(mysqli_num_rows($res_data)){

     while($row = mysqli_fetch_assoc($res_data)){

        if($row['status'] == 0){
            $btn = "<button type='submit' class='btn d-inline btn-danger rounded-0 btn-sm' name='delete' value='".$row['id']."'>Delete</button>";
        }
    
    // $imgSel=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `product_pics` WHERE `product_id` = '".$row['id']."' ORDER BY `id` DESC"));    
    
        print_r("
        
        <tr>
            <td>".$row['id']."</td>
            <td><img src='../shop/".$row['picture']."' width='100vw'></td>
            <td>".$row['name']."</td>
            <td>".$row['category']."</td>
            <td>".$row['price']."</td>
            <td>".$row['shipping']."</td>
            <td>".$row['tax']."</td>
            <td>".$row['stock']."</td>
            <td class='w-25'>".$row['description']."</td>
            <td><form method='post'>
            <a href='product_view.php?id=".$row['id']."'><button type='button' class='btn text-light d-inline btn-sm rounded-0 btn-info'>Edit</button></a>".$btn."</form></td>
        </tr>
        
        ");
        
    }
}   
                  
                ?>
           </tbody>
           </table>




<ul class="pagination justify-content-center">
    <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>

    <?php 
        if($pageno <= $total_pages) {
                $f = $pageno-1;
                $fm = $pageno-2;
                
                $l = $pageno+1;
                $lm = $pageno+2;
                
                if($pageno > 2){
                    echo '<li class="page-item"><a class="page-link" href="?pageno='.$fm.'">'.$fm.'</a></li>';
                }

               if($pageno > 1){
                    echo '<li class="page-item"><a class="page-link" href="?pageno='.$f.'">'.$f.'</a></li>';
               }
               
                echo '<li class="page-item active"><a class="page-link" href="?pageno='.$pageno.'">'.$pageno.'</a></li>';

                if($l <= $total_pages){

                echo '<li class="page-item"><a class="page-link" href="?pageno='.$l.'">'.$l.'</a></li>';
                }

                if($lm < $total_pages){

                echo '<li class="page-item"><a class="page-link" href="?pageno='.$lm.'">'.$lm.'</a></li>';
                }
                
            }
    ?>
  
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>

</ul>


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

</php>