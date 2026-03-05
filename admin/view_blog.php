<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/config.php';
if(!isset($_SESSION['login'])){
    echo "<script>window.location.href= './logout.php';</script>";
}

if(isset($_POST['add_article'])){
    
extract($_POST);

$date = date('M d, Y');

$sadmin = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '".$_SESSION['login']."'"));

if(isset($_POST['advisor']) and $advisor == 'on'){ $advisor = '1'; } else { $advisor = '0'; }

if(isset($_POST['slider']) and $slider == 'on'){ $slider = '1'; } else { $slider = '0'; }

if(isset($_POST['feature']) and $feature == 'on'){$feature = '1'; } else { $feature = '0'; }

if(isset($_POST['popular']) and $popular == 'on'){ $popular = '1'; } else { $popular = '0'; }

$title = str_replace("'", "\'", $title);
$short_title = str_replace("'", "\'", $short_title);   
$description = str_replace("'", "\'", $description);


$meta_title = str_replace("'", "\'", $meta_title);
$meta_keywords = str_replace("'", "\'", $meta_keywords);   
$meta_description = str_replace("'", "\'", $meta_description);

  $sql = mysqli_query($con, "UPDATE `post` SET `title` = '$title', `short_title` = '$short_title', `body` = '$description', `category` = '$category', `img_title` = '$img_title', `img_link` = '$img_link', `meta_title` = '$meta_title', `meta_keywords` = '$meta_keywords', `meta_description` = '$meta_description', `username` = '$author', `authorlink` = '$authorlink', `date` = '$date', `slider` = '$slider', `feature` = '$feature', `popular` = '$popular', `advisor` = '$advisor', `username`='$author' WHERE `id` = '$id'");
   
   if($sql){
       echo "<script>alert('Article Updated Successful'); window.location.href = 'view_blog.php?id=".$_GET['id']."'; </script>";
       
   }else{
       echo "<script>alert('Error: ".mysqli_error($con)."');</script>";exit();
   }
    
}



$stmt = mysqli_query($con, "SELECT * FROM `categories` WHERE `status` = '0'");

if(isset($_GET['id'])){
    
    $stmt2 = mysqli_query($con, "SELECT * FROM `post` WHERE `id` = '".$_GET['id']."'");
    $data = mysqli_fetch_assoc($stmt2);

}else{
    echo "<script>window.location.href = './blog.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edit Article - Admin Panel</title>
  
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
          <li class="breadcrumb-item"><a href="index.php">Blogs</a></li>
          <li class="breadcrumb-item active">Edit Article</li>
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
                        <label><b>Blog Title</b></label>                       
                        <input type="text" name="title" class="form-control" placeholder="Blog Title" value="<?php echo $data['title']; ?>">
                        
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label><b>Short Title</b></label>                       
                        <input type="text" name="short_title" class="form-control" placeholder="Short Title" value="<?php echo $data['short_title']; ?>">
                        
                    </div>

                </div>
              <div class="row mt-2">
                    <div class="col">
                        <label><b>Choose Category</b></label>    
                        <select name="category" class="form-control" value="<?php echo $data['category']; ?>">
                            <option>--- Choose Category ---</option>
                            <?php 
                            
                                if($stmt){
                                    if(mysqli_num_rows($stmt) > 0){
                                        while($ro = mysqli_fetch_assoc($stmt)){
                                        
                                        if($ro['cat_name'] == $data['category']){
                                            
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
                        <label><b>Blog Description</b></label>

                        <textarea id="texteditor" name="description"  class="form-control"><?php echo $data['body']; ?></textarea>
                    </div>
			<!-- <script>CKEDITOR.replace('descr');</script> -->
            </div>  
            
            
            <hr>
            
            <div class="row mt-2">
                    <div class="col">
                        <label><b>Image Title</b></label>    
                        <input type="text" value="<?php echo $data['img_title']; ?>" name="img_title" class="form-control" placeholder="Image Title">
                    </div>
                    
                    <div class="col">
                        <label><b>Image Link</b></label>
                        <input type="text" value="<?php echo $data['img_link']; ?>" name="img_link" class="form-control" placeholder="Image Link">
                    </div>

            </div>
            <hr>
            <div class="row mt-2">
                    <div class="col">
                        <label><b>Meta Title</b></label>    
                        <input type="text" value="<?php echo $data['meta_title']; ?>" name="meta_title" class="form-control" placeholder="Meta Title">
                    </div>
                    
                    <div class="col">
                        <label><b>Meta Keywords</b></label>
                        <input type="text" value="<?php echo $data['meta_keywords']; ?>" name="meta_keywords" class="form-control" placeholder="Meta Keywords">
                    </div>

            </div>
            <div class="row my-3">
                    <div class="col">
                        <label><b>Meta Description</b></label>
                        <textarea name="meta_description" rows="5" class="form-control" placeholder="Meta Description"><?php echo $data['meta_description']; ?></textarea>
                    </div>
            </div>
            <hr>
            <div class="row my-3">
                <div class="col">
                    <label><b>Author Name</b></label>
    
                    <select name="author" class="form-control">
                        
                    <?php $stm = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '0'"); 

                    if($stm){
                        if(mysqli_num_rows($stm) > 0){
                            while($ro = mysqli_fetch_assoc($stm)){
                                if($ro['name'] == $data['username']){
                                    print_r('<option value="'.$ro['name'].'" selected>'.$ro['name'].'</option>');    
                                }else{
                                    print_r('<option value="'.$ro['name'].'">'.$ro['name'].'</option>');
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
                        <label><b>Author Link</b></label>
                        <input type="text" name="authorlink" class="form-control" placeholder="Type Author Link" value="<?php echo $data['authorlink']; ?>">
                    </div>
            </div>
            
            <hr>
            <div class="row my-3">
                <div class="col">
                    <label>Positions</label>
                    <?php  
                    
                    if($data['slider'] == '1') { 
                        echo '<input name="slider" type="checkbox" class="mx-2" checked> Slider';
                    }else{ 
                        echo '<input name="slider" type="checkbox" class="mx-2"> Slider';
                    }
                    
                    if($data['feature'] == '1') { 
                        echo '<input name="feature" type="checkbox" class="mx-2" checked> Feature';
                    }else{ 
                        echo '<input name="feature" type="checkbox" class="mx-2"> Feature';
                    }
                    
                    if($data['popular'] == '1') { 
                        echo ' <input name="popular" type="checkbox" class="mx-2" checked> Popular';
                    }else{ 
                        echo ' <input name="popular" type="checkbox" class="mx-2"> Popular';
                    }
                    
                    if($data['advisor'] == '1') { 
                        echo '<input name="advisor" type="checkbox" class="mx-2" checked> Latest';
                    }else{ 
                        echo '<input name="advisor" type="checkbox" class="mx-2"> Latest';
                    }
                    
                    
                    ?>
  
                </div>
            </div> 
            <hr>

             <div class="row my-3">
                <div class="col">
                    <input type="submit" class="btn btn-primary px-4" name="add_article" value="Update Article">   
                </div>
            </div> 
            
            
            
          </form>
          
          
          
          <hr>
          <?php 
          
//updateImageCodingStartHere
          
if(isset($_POST['addimage'])){
  
$target_dir = "../assets/img/blog/";

$temp = explode(".", $_FILES["file"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);

$target_file = $target_dir . $newfilename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!is_dir($target_dir)) {
    mkdir($target_dir);
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $error = "Sorry, your file was not uploaded.";
  echo "<script>alert('".$error."');</script>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        
        $sql_old_image = mysqli_query($con, "SELECT * FROM `post` WHERE `id` = '".$_GET['id']."'");
        if($sql_old_image){
            if(mysqli_num_rows($sql_old_image) > 0){
                $oldimage = mysqli_fetch_assoc($sql_old_image);
                
                if(unlink('../'.$oldimage['picture'])){
                    
                    $update=mysqli_query($con, "UPDATE `post` SET `picture`='$target_file' WHERE `id` = '".$_GET['id']."'");
                    if($update){
                        echo "<script>alert('Update Successful'); window.location.href='./blog.php';</script>";
                    }else{
                        echo "<script>alert('Update Failed: ".$error."'); window.location.href='./blog.php';</script>";
                        
                    }
                }else{
                    
                    $update=mysqli_query($con, "UPDATE `post` SET `picture`='$target_file' WHERE `id` = '".$_GET['id']."'");
                    if($update){
                        echo "<script>alert('Update Successful'); window.location.href='./blog.php';</script>";
                    }else{
                        echo "<script>alert('Update Failed: ".$error."'); window.location.href='./blog.php';</script>";
                        
                    }

                }
                
            }else{
                echo "<script>alert('No Article Found');</script>";
            }
            
        }else{
            echo "<script>alert('Server Error');</script>";
        }
        
        
  } else {
    $error= "Sorry, there was an error uploading your file.";
    echo "<script>alert('Update Failed: ".$error."'); window.location.href='blog.php';</script>";
  }
  
}


}
          
          
          ?>
          <form enctype="multipart/form-data" method="POST">
          
            <div class="row my-3">
                <div class="col">
                    <label>Update Image</label>
                    <input type="file" class="form-control" name="file">   
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-primary px-4 mt-4" name="addimage" value="Update Image">   
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
  <!-- <script src="assets/vendor/tinymce/tinymce.min.js"></script> -->
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="tinymce/js/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: 'textarea#texteditor',
      placeholder: 'Type your message here',
      plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons file',
      menubar: 'file edit view insert format tools table help',
      toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks',
      toolbar_sticky: true,
      autosave_ask_before_unload: true,
      autosave_interval: '30s',
      autosave_prefix: '{path}{query}-{id}-',
      autosave_restore_when_empty: false,
      autosave_retention: '2m',
      image_advtab: true,
      link_list: [{
          title: 'My page 1',
          value: 'https://www.codexworld.com'
        },
        {
          title: 'My page 2',
          value: 'http://www.codexqa.com'
        }
      ],
      image_list: [{
          title: 'My page 1',
          value: 'https://www.codexworld.com'
        },
        {
          title: 'My page 2',
          value: 'http://www.codexqa.com'
        }
      ],
      image_class_list: [{
          title: 'None',
          value: ''
        },
        {
          title: 'Some class',
          value: 'class-name'
        }
      ],
      importcss_append: true,
      file_picker_callback: (callback, value, meta) => {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
          callback('https://www.google.com/logos/google.jpg', {
            text: 'My text'
          });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
          callback('https://www.google.com/logos/google.jpg', {
            alt: 'My alt text'
          });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
          callback('movie.mp4', {
            source2: 'alt.ogg',
            poster: 'https://www.google.com/logos/google.jpg'
          });
        }
      },
      template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
      template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
      height: 400,
      image_caption: true,
      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
      noneditable_class: 'mceNonEditable',
      toolbar_mode: 'sliding',
      contextmenu: 'link image table',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
  </script>

</body>

</html>