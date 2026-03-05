<?php 
session_start();
include '../config/config.php';
// if(!isset($_SESSION['admin'])){
//     echo "<script>window.location.href= './login.php';</script>";
// }

if(isset($_GET['trash'])){
    $stmt = mysqli_query($con, "SELECT * FROM `post` WHERE `status` = '1' ORDER BY `id` DESC");
}else{
$stmt = mysqli_query($con, "SELECT * FROM `post` WHERE `status` = '0' ORDER BY `id` DESC");
}



if(isset($_POST['deleted'])){
    
    $id = $_POST['deleted'];
    
    $stmt = mysqli_query($con, "SELECT * FROM `post` WHERE `id` = '$id'");
    if($stmt){
        if(mysqli_num_rows($stmt) > 0){
            $file = mysqli_fetch_assoc($stmt);
            
            if(unlink('../'.$file['picture'])){
                $sql = mysqli_query($con, "DELETE FROM `post` WHERE `id` = '$id'");
                if($sql){
                    echo "<script>alert('Deleted Successful'); window.location.href='./blog.php?trash=1';</script>";
                }
            }else{
                $sql = mysqli_query($con, "DELETE FROM `post` WHERE `id` = '$id'");
                if($sql){
                    echo "<script>alert('Deleted Successful'); window.location.href='./blog.php?trash=1';</script>";
                }
            }
            
        }
    }
    
}

if(isset($_POST['delete'])){
    
    $id = $_POST['delete'];
    $stmt = mysqli_query($con, "UPDATE `post` SET `status` = '1' WHERE `id` = '$id' ");
    if($stmt){ 
        echo "<script> alert('Moved to Trash !'); window.location.href= './blog.php';</script>";  
    }
}   



if(isset($_POST['restore'])){
    
    $id = $_POST['restore'];
    
    $stmt = mysqli_query($con, "UPDATE `post` SET `status` = '0' WHERE `id` = '$id' ");
      echo "<script> alert('Restored Deleted!'); window.location.href= './blog.php';</script>";
} 


if(isset($_POST['deleteall'])){
    
    $sql = "DELETE FROM `post`";
    $query = mysqli_query($con, $sql);
    
    if($query){
        echo "<script>alert('Successfully Deleted!');</script>";
    }else{
        echo "<script>alert('Failed to Delete!');</script>";
    }
    
}

?>
<!DOCTYPE php>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blogs - Admin Panel</title>
  
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Admin Panel</a></li>
          <li class="breadcrumb-item active">Blogs</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            
            <div class="row">
                <div class="col-lg-6 col-6">
                    <input id="myInput" type="text" class="form-control col-md-12 float-start" placeholder="Search..">
                </div>
            <div class="col-lg-6 col-6 mb-3">
                <!-- Button to Open the Modal -->
            <a href="blog.php?trash=1">
                <button type="button" class="btn btn-info mx-1 btn-sm float-end">
                <i class="fa fa-trash"></i> Trash Bin
                </button>
            </a>    
            <a href="new_article.php">
            
            <button type="button" class=" mx-1 btn btn-primary btn-sm float-end">
                <i class="fa fa-plus"></i> Add New Article
            </button>
            </a>
            <button type="button" class=" mx-1 btn btn-danger btn-sm float-end" data-bs-toggle="modal" data-bs-target="#allposts">
                <i class="fa fa-trash"></i> Delete All Posts
            </button>
            </div>
            </div>
            
            
<!-- The Modal -->
<div class="modal" id="allposts">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Confirm Delete All Posts?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h5>Are you sure you want to delete all posts?</h5>
        <small><i>Unable to revert</i></small>
      </div>
      
            <!-- Modal footer -->
      <div class="modal-footer">
      <form method="POST">
        <button type="button" name="deleteall" value="1" class="btn btn-danger">Yes</button>
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">No</button>
      </form>
      </div>


    </div>
  </div>
</div>

<table class="table table-bordered table-striped table-condensed table-hover">
<thead>
    <th>Id</th>
    <th>Picture</th>
    <th>Title</th>
    <th>Category</th>
    <th>Views</th>
    <th>Date</th>
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


    $total_pages_sql = "SELECT COUNT(*) FROM `post`";
    $result = mysqli_query($con,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $sql = "SELECT * FROM `post` ORDER BY `id` DESC LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($con,$sql);

if(mysqli_num_rows($res_data) > 0){
    while($row = mysqli_fetch_assoc($res_data)){


        if($row['status'] == 0){
            $btn = "<button type='submit' class='btn btn-danger btn-sm' name='delete' value='".$row['id']."'><i class='fa fa-trash'></i></button>";
        }else{
             $btn = "<button type='submit' class='btn btn-warning btn-sm' name='restore' value='".$row['id']."'><i class='fa fa-undo'></i></button><button type='submit' class='mx-1 btn btn-danger btn-sm'  name='deleted' value='".$row['id']."'><i class='fa fa-trash'></i></button>";
             
        }
        print_r("
        
        <tr>
            <td>".$row['id']."</td>
            <td><img src='../".ltrim($row['picture'], './')."' width='100vw' alt='No image'></td>
            <td>".$row['title']."</td>
            <td>".$row['category']."</td>
            <td>".$row['views']."</td>
            <td>".$row['date']."</td>
            <td><a style='display:inline;' href='view_blog.php?id=".$row['id']."'><button class='btn btn-primary btn-sm mr-1'><i class='fa fa-eye'></i></button></a>  <form method='post' style='display:inline;'>".$btn."</form></td>
        </tr>
        ");
    }

}else{
    print_r("<tr><td colspan='5' class='text-center'><b>No Records Found</b></td></tr>");
}

    mysqli_close($con);

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
    <?php 

        // for($i=1; $i <= $total_pages; $i++){
        //     if(isset($_GET['pageno']) and $_GET['pageno'] == $i){
        //         echo '<li class="page-item active"><a class="page-link" href="?pageno='.$i.'">'.$i.'</a></li>';
        //     }else{
        //         echo '<li class="page-item"><a class="page-link" href="?pageno='.$i.'">'.$i.'</a></li>';
        //     }

        // }

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