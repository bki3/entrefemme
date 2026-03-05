<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');


session_start();
include '../config/config.php';
if (!isset($_SESSION['login'])) {
  echo "<script>window.location.href= './login.php';</script>";
}




$stmt = mysqli_query($con, "SELECT * FROM `subscriptions` ORDER BY `id` DESC");

$subscribers = array();
if ($stmt) {
  if (mysqli_num_rows($stmt) > 0) {
    while ($row = mysqli_fetch_assoc($stmt)) {
      $data = array('name' => $row['name'], 'email' => $row['email']);
      array_push($subscribers, $data);
    }
  }
}



if (isset($_POST['add_article'])) {



  if ($_FILES['FileToUpload']['error'] == 0 and isset($_FILES['FileToUpload']['name'])) {



    extract($_POST);
    $date = date('M d, Y');

    $temp = explode(".", $_FILES["FileToUpload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $filename = './assets/img/blog/' . $_FILES['FileToUpload']['name'];

    $sadmin = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '" . $_SESSION['login'] . "'"));

    if (isset($_POST['advisor']) and $advisor == 'on') {
      $advisor = '1';
    } else {
      $advisor = '0';
    }

    if (isset($_POST['slider']) and $slider == 'on') {
      $slider = '1';
    } else {
      $slider = '0';
    }

    if (isset($_POST['feature']) and $feature == 'on') {
      $feature = '1';
    } else {
      $feature = '0';
    }

    if (isset($_POST['popular']) and $popular == 'on') {
      $popular = '1';
    } else {
      $popular = '0';
    }


    $target_dir = "../assets/img/blog/";
    $target_file = $target_dir . $newfilename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $error = '';

    $imgfile = str_replace("../", "", $target_dir);
    $img = $imgfile . $newfilename;

    if (!is_dir($target_dir)) {
      mkdir($target_dir);
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<script>alert('" . $error . "');</script>";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["FileToUpload"]["tmp_name"], $target_file)) {

        $title = str_replace("'", "\'", $title);
        $short_title = str_replace("'", "\'", $short_title);
        $description = str_replace("'", "\'", $description);

        $meta_title = str_replace("'", "\'", $meta_title);
        $meta_keywords = str_replace("'", "\'", $meta_keywords);
        $meta_description = str_replace("'", "\'", $meta_description);

        $sql = mysqli_query($con, "INSERT INTO `post`( `title`, `short_title`, `body`, `picture`, `category`, `meta_title`, `meta_keywords`, `meta_description`, `username`, `authorlink`, `date`, `likes`, `views`, `slider`, `feature`, `popular`, `advisor`, `img_title`, `img_link`, `status`) VALUES ('$title', '$short_title', '$description', '$target_file', '$category', '$meta_title', '$meta_keywords', '$meta_description', '$author', '$authorlink', '$date', '0', '0', '$slider', '$feature', '$popular', '$advisor', '$image_title', '$image_link', '0')");

        if ($sql) {

          foreach ($subscribers as $key => $value) {

            $sub_name = $subscribers[$key]['name'];
            $sub_email = $subscribers[$key]['email'];

            // $mail = new PHPMailer(true);

            // try {
            //   $mail->SMTPDebug = 2;
            //   $mail->isSMTP();
            //   $mail->Host       = 'smtp.ionos.com';
            //   $mail->SMTPAuth   = true;
            //   $mail->Username   = 'support_team@entrefemme.com';
            //   $mail->Password   = 'UnlockSuccesswithOurGuide2024@$';
            //   $mail->SMTPSecure = 'ssl/tls';
            //   $mail->Port       = 587;

            //   $mail->setFrom('support_team@entrefemme.com', 'Entre Femme');
            //   $mail->addAddress("$sub_email");
            //   $mail->addAddress("$sub_email", "$sub_name");

            //   $mail->isHTML(true);
            //   $mail->Subject = "$title";
            //   $mail->Body    = "<h1 style='text-align:center;'>$title</h1><img src='https://entrefemme.com/$img' width='100%'><br>$description<a href='https://entrefemme.com/'><button style='border:0px; color: white; padding:2%; background-color: #DF678B; text-align:center; '> Read more </button></a>";
            //   $mail->AltBody = '';
            //   $mail->send();
            // } catch (Exception $e) {
            //   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // }
          }
          echo "<script>alert('Article Added Successful'); window.location.href = './blog.php';</script>";
        }
      } else {
        $error = "Sorry, there was an error uploading your file.";
        echo "<script>alert('" . $error . "'); </script>";
      }
    }
  } else {
    echo "<script>alert('Please Select Image File'); window.location.href = './new_article.php';</script>";
  } // testing file bracket

}



$stmt = mysqli_query($con, "SELECT * FROM `categories` WHERE `status` = '0' AND `id` != '1'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>New Article - Admin Panel</title>

  <?php include 'links.php'; ?>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>


  <!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->
  <script src="editor/ckeditor.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <?php include 'top_nav.php'; ?>
  <?php include 'sidebar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Admin Panel</a></li>
          <li class="breadcrumb-item active">Add Article</li>
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
                <label><b>Article Title</b></label>
                <input type="text" name="title" class="form-control" placeholder="Blog Title" required>
              </div>

            </div>
            <div class="row mt-2">
              <div class="col">
                <label><b>Short Title</b></label>
                <input type="text" name="short_title" class="form-control" placeholder="Short Title" required>
              </div>
            </div>

            <div class="row mt-2">

              <div class="col">
                <select name="category" class="form-control">
                  <option>--- Choose Category ---</option>
                  <?php
                  if ($stmt) {
                    if (mysqli_num_rows($stmt) > 0) {
                      while ($ro = mysqli_fetch_assoc($stmt)) {
                        print_r('
                                            
                                            <option value="' . $ro['cat_name'] . '">' . $ro['cat_name'] . '</option>
                                            ');
                      }
                    }
                  }
                  ?>
                </select>
              </div>

            </div>
            <div class="row my-3">
              <div class="col">
                <label><b>Article Description</b></label>
                <!-- <div id="editor"></div> -->
                <!-- <textarea id="editor-content" name="description" class="d-none"></textarea> -->

                <div class="form-group my-2">
                  <textarea name="description" id="texteditor" rows="4" class="form-control" placeholder="Type description" required></textarea>
                </div>


                <script>
                                    CKEDITOR.replace('texteditor');
                                </script>




              </div>
            </div>
            <br>
            <br>
            <br>


            <!--<script>-->
            <!--    CKEDITOR.replace('texteditor');-->
            <!--</script>-->

            <hr>

            <div class="row mt-2">

              <div class="col">
                <select name="author" class="form-control">
                  <option>--- Choose Author ---</option>
                  <?php
                  $stmt = mysqli_query($con, "SELECT * FROM `users`");
                  if ($stmt) {
                    if (mysqli_num_rows($stmt) > 0) {
                      while ($ro = mysqli_fetch_assoc($stmt)) {
                        print_r('
                                            
                                            <option value="' . $ro['name'] . '">' . $ro['name'] . '</option>
                                            ');
                      }
                    }
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <label><b>Author Link</b></label>
                <input type="text" name="authorlink" class="form-control" placeholder="Type author link">
              </div>
            </div>

            <hr>

            <div class="row mt-2">
              <div class="col">
                <label><b>Image Title</b></label>
                <input type="text" name="image_title" class="form-control" placeholder="Type image title">
              </div>
              <div class="col">
                <label><b>Image Link</b></label>
                <input type="text" name="image_link" class="form-control" placeholder="Type image link">
              </div>
            </div>

            <hr>
            <div class="row mt-2">
              <div class="col">
                <label><b>Meta Title</b></label>
                <input type="text" name="meta_title" class="form-control" placeholder="Meta Title">
              </div>

              <div class="col">
                <label><b>Meta Keywords</b></label>
                <input type="text" name="meta_keywords" class="form-control" placeholder="Meta Keywords">
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <label><b>Meta Description</b></label>
                <textarea name="meta_description" rows="5" class="form-control" placeholder="Meta Description"></textarea>
              </div>
            </div>
            <hr>
            <div class="row my-3">
              <div class="col">
                <label>Positions</label>
                <input name="slider" type="checkbox" class="mx-2"> Slider
                <input name="feature" type="checkbox" class="mx-2"> Feature
                <input name="popular" type="checkbox" class="mx-2"> Popular
                <input name="advisor" type="checkbox" class="mx-2"> Advisor
              </div>
            </div>
            <hr>
            <div class="row my-3">
              <div class="col">
                <label>Choose Image</label>
                <input type="file" name="FileToUpload" class="form-control" required>
              </div>
            </div>

            <div class="row my-3">


              <div class="col">
                <input type="submit" class="btn btn-primary px-4" name="add_article" value="Add Article">
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

  <script>
    document.querySelector("form").addEventListener("submit", function(event) {
        // Ensure TinyMCE content is updated in textarea
        tinymce.triggerSave();
        
        var description = document.querySelector("#texteditor");
        if (!description.value.trim()) {
            alert("Please enter a description.");
            event.preventDefault(); // Stop form submission
            return false;
        }
    });
</script>

<!-- 
  <script src="tinymce/js/tinymce/tinymce.min.js"></script> -->
  <!-- <script>
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
  </script> -->

</body>

</html>