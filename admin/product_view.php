<?php 
session_start();

include '../config/config.php';
if(!isset($_SESSION['login'])){
    echo "<script>window.location.href= './login.php';</script>";
}


if(isset($_POST['add_product'])){
    
extract($_POST);

$id = $_GET['id'];

// if file selected
if($_FILES['fileToUpload']['error'] == 0){

    
$target_dir = "../shop/assets/images/";

if(!is_dir($target_dir)){
    mkdir($target_dir);
}

$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);

$target_file = $target_dir . $newfilename;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<script>alert('Sorry, your file was not uploaded.'); </script>";
  
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


$sadmin = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `products` WHERE `id` = '".$_GET['id']."'"));



if(isset($_POST['europe'])){
    $europe='1';
}else{
    $europe='0';
}

if(isset($_POST['others'])){
    $uk='1';
}else{
    $uk='0';
}

if(isset($_POST['usa'])){
    $usa='1';
}else{
    $usa='0';
}


$picture = '../shop/'.$sadmin['picture'];

if(unlink($picture) ){


$title = str_replace("'", "\'", $title);  
$description = str_replace("'", "\'", $description);


$sql = mysqli_query($con, "UPDATE `products` SET `name` = '$title', `picture` = '$target_file', `price` = '$price', `shipping` = '$shipping', `tax` = '$tax',  `stock` = '$stock', `size` = '$size', `color` = '$color', `description` = '$description', `category` = '$category', `others`='$uk', `usa`='$usa', `europe`='$europe' WHERE `id` = '$id'");
       
    if($sql){
        
       echo "<script>alert('Product Updated Successful'); window.location.href = './products.php';</script>";
       
    }else{
       echo "<script>alert('Failed to Update'); window.location.href = './products.php';</script>";
    }

}else{
    
$title = str_replace("'", "\'", $title);   
$description = str_replace("'", "\'", $description);
    
$sql = mysqli_query($con, "UPDATE `products` SET `name` = '$title', `picture` = '$target_file', `price` = '$price', `shipping` = '$shipping', `tax` = '$tax',  `stock` = '$stock', `size` = '$size', `color` = '$color', `description` = '$description', `category` = '$category', `others`='$uk', `usa`='$usa', `europe`='$europe' WHERE `id` = '$id'");
       
    if($sql){
        
       echo "<script>alert('Product Updated Successful'); window.location.href = './products.php';</script>";
       
    }else{
       echo "<script>alert('Failed to Update'); window.location.href = './products.php';</script>";
    }

}


  } else {
    echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href='products.php';</script>";
  }
}


// if file not selected
}else{
    
    
$sadmin = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `products` WHERE `id` = '".$_GET['id']."'"));



if(isset($_POST['europe'])){
    $europe='1';
}else{
    $europe='0';
}

if(isset($_POST['others'])){
    $uk='1';
}else{
    $uk='0';
}

if(isset($_POST['usa'])){
    $usa='1';
}else{
    $usa='0';
}

$title = str_replace("'", "\'", $title);   
$description = str_replace("'", "\'", $description);

    $sql = mysqli_query($con, "UPDATE `products` SET `name` = '$title', `price` = '$price', `shipping` = '$shipping', `tax` = '$tax',  `stock` = '$stock', `size` = '$size', `color` = '$color', `description` = '$description', `category` = '$category', `others`='$uk', `usa`='$usa', `europe`='$europe' WHERE `id` = '$id'");
           
    if($sql){
        
       echo "<script>alert('Product Updated Successful'); window.location.href = './products.php';</script>";
       
    }else{
       echo "<script>alert('Failed to Update: ".mysqli_error($con)."'); window.location.href = './products.php';</script>";
    }

}


    
}



$stmt = mysqli_query($con, "SELECT * FROM `shop_cats`");
if(isset($_GET['id'])){
$stmt2 = mysqli_query($con, "SELECT * FROM `products` WHERE `id` = '".$_GET['id']."'");
$data = mysqli_fetch_assoc($stmt2);
}else{
    echo "<script>window.location.href = './products.php';</script>";
}





// --------------------------------
// Delete images codes start here
// --------------------------------
if(isset($_GET['delete'])){
    
    $dq = mysqli_query($con, "SELECT * FROM `product_pics` WHERE `id` = '".$_GET['delete']."'");
    
    $data = mysqli_fetch_assoc($dq);

    
    if(unlink($data['source'])){
    
        $dq = mysqli_query($con, "DELETE FROM `product_pics` WHERE `id` = '".$_GET['delete']."'");
        if($dq){
         echo "<script>alert('Image Deleted');window.location.href = './product_view.php?id=".$_GET['id']."';</script>";
        }else{
         echo "<script>alert('Failed to Delete Image Record');window.location.href = './product_view.php?id=".$_GET['id']."';</script>";
        }
        
    }else{
        
        $dq = mysqli_query($con, "DELETE FROM `product_pics` WHERE `id` = '".$_GET['delete']."'");
        if($dq){
         echo "<script>alert('Image Deleted');window.location.href = './product_view.php?id=".$_GET['id']."';</script>";
        }else{
         echo "<script>alert('Failed to Delete Image Record');window.location.href = './product_view.php?id=".$_GET['id']."';</script>";
        }
    }
}


// --------------------------------
// Update image codes start here
// --------------------------------

if(isset($_POST['update_file'])){
    
extract($_POST);

$temp = explode(".", $_FILES["file"]["name"]);
$newfilename = $picid .'_' . $pid . '.' . end($temp);
    
$target_dir = "../shop/assets/images/";


if(!is_dir($target_dir)){
    mkdir($target_dir);
}

$target_file = $target_dir . $newfilename;



$uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<script>alert('Sorry, failed to upload file.'); window.location.href='product_view.php?id=".$pid."';</script>";
// if everything is ok, try to upload file
} else {

  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    

    $oldpic= mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `product_pics` WHERE `id` = '$picid'"));
    
    if(unlink($oldpic['source'])){
    // print_r($oldpic['source']);exit();
        
        $uq=mysqli_query($con,"UPDATE `product_pics` SET `source`='$target_file' WHERE `id` = '$picid'");
        if($uq){
            print_r("<script>alert('Update Successfully.'); window.location.href='product_view.php?id=".$pid."';</script>");
        }
        
    }else{
        
        $uq=mysqli_query($con,"UPDATE `product_pics` SET `source`='$target_file' WHERE `id` = '$picid'");
        if($uq){
            print_r("<script>alert('Update Successfully.'); window.location.href='product_view.php?id=".$pid."';</script>");
        }else{
            print_r("<script>alert('Failed to Delete Old Image'); window.location.href='product_view.php?id=".$pid."';</script>");
            
        }
        
    
        
    }
  } else {
    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
  }
  
}

}


if(isset($_POST['add_images'])){
    
    
$id = $_GET['id'];
//$files = array_filter($_FILES['upload']['name']); //something like that to be used before processing files.

// Count # of uploaded files in array
$total = count($_FILES['files']['name']);


// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

  //Get the temp file path
  $tmpFilePath = $_FILES['files']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "../shop/assets/images/" . $_FILES['files']['name'][$i];

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
        
    $sql = mysqli_query($con, "INSERT INTO `product_pics` (`product_id`, `source`) VALUES ('$id', '$newFilePath')");
    
    if($sql){
        print_r("<script>alert('New Images Added Successful'); window.location.href = './products.php';</script>");
    }
    
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

  <title>Edit product - Admin Panel</title>
  
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
          <li class="breadcrumb-item"><a href="products.php">Products</a></li>
          <li class="breadcrumb-item active">Edit product</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <form method="POST" enctype="multipart/form-data">
              <div class="row mt-2">
                    <div class="col">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        <input type="text" name="title" value="<?php echo $data['name']; ?>" class="form-control" placeholder="Product Title">
                    </div>
                    
            
                    <div class="col">
                        <select name="category" class="form-control" value="<?php echo $data['category']; ?>">
                            <option>--- Choose Category ---</option>
                            <?php 
                            
                                if($stmt){
                                    if(mysqli_num_rows($stmt) > 0){
                                        while($ro = mysqli_fetch_assoc($stmt)){
                                        
                                        if(strtoupper($ro['cat_name']) == strtoupper($data['category'])){
                                            
                                            print_r('
                                            <option value="'.$ro['cat_name'].'" selected>'.$ro['cat_name'].'</option>
                                            ');
                                        }else{
                                            print_r('
                                            <option value="'.$ro['cat_name'].'">'.$ro['cat_name'].'</option>
                                            ');
                                        }
                                        
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
            </div>
            
            
             <div class="row my-3">
                <div class="col">
                <label>Colors ( Comma ',' Seprated )</label>
                <input type="text" name="color" value="<?php echo $data['color']; ?>" class="form-control" placeholder="Product Colors">
    
                </div>
                
                <div class="col">
                <label>Size's ( Comma ',' Seprated )</label>
                <input type="text" name="size" value="<?php echo $data['size']; ?>" class="form-control" placeholder="Product Size">
    
                </div>
            </div>
            
            
            <div class="row my-3">
                <div class="col">
                <label>Price</label>
                <input type="text" name="price" value="<?php echo $data['price']; ?>" class="form-control" placeholder="Product Price">
    
                </div>
                
                <div class="col">
                <label>Stock</label>
                <input type="number" name="stock" value="<?php echo $data['stock']; ?>" class="form-control" placeholder="Product Stock">
    
                </div>
            </div>
            
            <div class="row my-3">
                <div class="col">
                <label>Shipping</label>
                <input type="number" name="shipping" value="<?php echo $data['shipping']; ?>" class="form-control" placeholder="Product Price">
    
                </div>
                
                <div class="col">
                <label>Tax</label>
                <input type="text" name="tax" value="<?php echo $data['tax']; ?>" class="form-control" placeholder="Product Stock">
    
                </div>
            </div>
            
            <div class="row my-3">
                <div class="col">
                    <textarea id="descr" name="description" rows="8" class="form-control" placeholder="Type Description"><?php echo $data['description']; ?></textarea>
                </div>
            </div>  
            
            <script>CKEDITOR.replace('descr');</script>
            
            <div class="row my-3">
                
                    <?php 
                        if($data['europe']){
                            echo "<div class='col'><label><input type='checkbox' name='europe' checked> Europe</label></div>";
                        }else{
                            echo "<div class='col'><label><input type='checkbox' name='europe'> Europe</label></div>";
                        }
                        
                        if($data['usa']){
                            echo "<div class='col'><label><input type='checkbox' name='usa' checked> USA </label></div>";
                        }else{
                            echo "<div class='col'><label><input type='checkbox' name='usa'> USA </label></div>";
                        }
                        
                        if($data['others']){
                            echo "<div class='col'><label><input type='checkbox' name='others' checked>Others</label></div>";
                        }else{
                            echo "<div class='col'><label><input type='checkbox' name='others'>Others</label></div>";
                        }
                    
                    ?>
                
            </div> 
            
            <hr>
            
            <label>Update Image: </label>
            <input type="file" class="mt-2 form-control" name="fileToUpload">

             <div class="row my-3">
                <div class="col">
                    <input type="submit" class="rounded-0 btn btn-primary px-4" name="add_product" value="Update product">   
                </div>
            </div> 
        
            
          </form>
          

        <div class="row">
        <hr>
        <div class="col-12 bg-secondary text-center p-2 text-light">
            <h4>Product Images</h4>
        </div>
        <hr>
        
            <?php
            
                  $pquery=mysqli_query($con,"SELECT * FROM `product_pics` WHERE `product_id`='".$_GET['id']."'");
                  $images=array();
                  if($pquery){
                      if(mysqli_num_rows($pquery) > 0){
                          
                          while($pics=mysqli_fetch_assoc($pquery)){
                            array_push($images, $pics['id']);
                            $prodid=$pics['product_id'];
                            print_r('
                            <div class="col-6 col-lg-3">
                                <img src="'.$pics['source'].'" width="100%">
                                <p class="bg-secondary text-center p-2 text-light">'.$pics['id'].'</p>
                                <a href="product_view.php?id='.$_GET['id'].'&delete='.$pics['id'].'"><button class="btn w-100 btn-danger rounded-0 btn-sm">Delete</button></a>
                            </div>');
                         
                          }
                          
                      }
                     
                  }
            ?>
            
        </div>
      <form method="POST" enctype="multipart/form-data">    
            <div class="row my-3">
                <div class="col-4">
                
            <input type="hidden" value="<?php echo $prodid; ?>" name="pid">            
              <select class="form-control" name="picid">
                  <?php 
                    for($i=0; $i < count($images); $i++){
                        
                      print_r('
                        <option value="'.$images[$i].'">Image id: '.$images[$i].'</option>
                      ');
                    }
                  
                  
                  ?>
              </select>
              </div>
                <div class="col-4">
                  <input type="file" class="form-control" name="file">
                </div>
                <div class="col-4">
                     <input type="submit" class="btn btn-sm rounded-0 btn-secondary" name="update_file" value="Update">
                </div>
            </div>

          </form>
          <hr>
    <form enctype="multipart/form-data" method="POST">
          <div class="row">
            <div class="col">
                <label>Add New Images: </label>
                <input type="file" class="mt-2 form-control" name="files[]" multiple>

            </div>
            <div class="col">
                <input type="submit" name="add_images" value="Add New Images" class="btn btn-secondary mt-2">
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