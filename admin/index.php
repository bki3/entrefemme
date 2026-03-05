<?php 
session_start();
include '../config/config.php';

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// Redirect if not admin
if (!isset($_SESSION['admin'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

// ✅ Optimized: Update countries.visits in one efficient query
$updateVisitsSQL = "
  UPDATE countries c
  JOIN (
    SELECT country, COUNT(*) AS visits
    FROM visitors
    GROUP BY country
  ) v ON c.country = v.country
  SET c.visits = v.visits
";
mysqli_query($con, $updateVisitsSQL);


// ---------------------------------------- //
//-------- Visitors Section Coding -------- //
// ---------------------------------------- //

$v_records = [];
$stmt = mysqli_query($con, "SELECT * FROM `countries` ORDER BY `visits` DESC LIMIT 10");
if ($stmt && mysqli_num_rows($stmt) > 0) {
    while ($ro = mysqli_fetch_assoc($stmt)) {
        $v_records[] = ['label' => $ro['country'], 'y' => (int)$ro['visits']];
    }
}
$dataPoints = $v_records;


// --------------------------------------------------- //
//----- Start of Categories Visits Section Coding ---- //
// --------------------------------------------------- //

$c_records = [];
$cstmt = mysqli_query($con, "SELECT * FROM `categories` WHERE `visits` != '0' ORDER BY `visits` DESC");
if ($cstmt && mysqli_num_rows($cstmt) > 0) {
    while ($cro = mysqli_fetch_assoc($cstmt)) {
        $c_records[] = ['label' => $cro['cat_name'], 'y' => (int)$cro['visits']];
    }
}
$dataPoints2 = $c_records;


// ------------------------ //
//----- Top Products ------ //
// ------------------------ //

$p_records = [];
$pstmt = mysqli_query($con, "SELECT * FROM `products` ORDER BY `views` DESC LIMIT 7");
if ($pstmt && mysqli_num_rows($pstmt) > 0) {
    while ($pro = mysqli_fetch_assoc($pstmt)) {
        $p_records[] = ['label' => $pro['name'], 'y' => (int)$pro['views']];
    }
}
$dataPoints3 = $p_records;
?>

<!DOCTYPE html>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Admin Panel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  
<?php include 'links.php';?>

<style>
    .canvasjs-chart-credit{
        display:none;
    }
    
    /* width */
::-webkit-scrollbar {
  width: 7px;
  height:7px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: gray; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}

</style>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,

	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]

});

chart.render();
 
 
 

var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	
	showInLegend: "true",
	theme: "light1", // "light1", "light2", "dark1", "dark2"
    
    axisX: {
		title: "Categories"
	},
	
	axisY: {
		title: "Views"
	},

    legend:{
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },

	data: [{
        //startAngle: 45,
        indexLabelFontSize: 20,
        indexLabelFontFamily: "times",
        indexLabelFontColor: "black",
        indexLabelLineColor: "red",
        indexLabelPlacement: "outside",
		type: "column",
        indexLabel: "{y}",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]

});
chart2.render();
 
 

 
var chart3 = new CanvasJS.Chart("chartContainer3", {
// 	animationEnabled: true,

	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 12,
// 		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0 Visitors",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]

});

chart3.render();

 

}

</script>

<style>
    .bg-unique{
        background-color: #4154f1;
    }
</style>
</head>

<body>
<?php include 'top_nav.php';?>
<?php include 'sidebar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-4 col-6">
            <div class="card border border-dark text-center">
                <div class="card-body p-2">
                    <h4>Visitors</h4>
                    <hr>
                    <h5>
                        <?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM `visitors`")); ?>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card border border-dark text-center">
                <div class="card-body p-2">
                    <h4>Blog Posts</h4>
                    <hr>
                    <h5>
                        <?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM `post`"));  ?>
                    </h5>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="card border border-dark text-center">
                <div class="card-body p-2">
                    <h4>Authors</h4>
                    <hr>
                    <h5>
                        <?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE `type` != '1'"));  ?>
                    </h5>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="card border border-dark text-center">
                <div class="card-body p-2">
                    <h4>Products</h4>
                    <hr>
                    <h5>
                        <?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM `products`"));  ?>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card border border-dark text-center">
                <div class="card-body p-2">
                    <h4>Subscriptions</h4>
                    <hr>
                    <h5>
                        <?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM `subscriptions`"));  ?>
                    </h5>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="card border border-dark text-center">
                <div class="card-body p-2">
                    <h4>Shop Users</h4>
                    <hr>
                    <h5>
                        <?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM `shop_users`"));  ?>
                    </h5>
                </div>
            </div>
        </div>
      </div>
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

             <!--Sales Card -->
            <div class="col-xxl-12 col-md-12 p-2">
                <h4 class="text-center bg-secondary text-light">Visitors</h4>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <!--<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>-->

            </div>
             <!--End Sales Card -->



            <!-- Revenue Card -->
            <div class="col-xxl-12 col-md-12 p-2">
                <h4 class="text-center bg-secondary text-light">Top Categories Views</h4>
                <div id="chartContainer2" style="height: 370px; width: 100%;"></div>

            </div>
            <!-- End Revenue Card -->
    </div>
    
    <div class="row mt-4">
            <!-- Customers Card -->
            <div class="col-xxl-12 col-xl-12 col-md-12 col-12" style="height:370px;overflow-y:scroll;">
            <h4 class="text-center bg-secondary text-light">Latest Visitors</h4>
                <table class="table table-bordered table-striped table-sm table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Ip</th>
                            <th>Country</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        $countries = mysqli_query($con, "SELECT * FROM `visitors` ORDER BY `id` DESC LIMIT 50");
                        if($countries){
                            if(mysqli_num_rows($countries) > 0){
                                
                                while($roo = mysqli_fetch_assoc($countries)){
                                if($roo['country'] == '(Unknown Country?)'){
                                    $roo['country'] = 'Crawler Bot';
                                }
                                    print_r('
                                    <tr>
                                        <td>'.$roo['ip'].'</td>
                                        <td>'.$roo['country'].'</td>
                                        <td>'.$roo['date'].'</td>
                                    </tr>
                                    ');
                                }
                            }
                        }else{
                            print_r(mysqli_error($con));
                        }

                        
                        
                        ?>
                        
                    </tbody>
                    
                </table>
              
            </div>
            <div class="col-xxl-6 col-xl-6 col-md-6 col-12" style="height:370px;overflow-y:scroll;">
                <h4 class="text-center bg-secondary text-light">Most Visits Categories</h4>
                <table class="table table-bordered table-striped table-sm table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Visits</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        $cat_visits = mysqli_query($con, "SELECT * FROM `categories` ORDER BY `visits` DESC");
                        if($cat_visits){
                            if(mysqli_num_rows($cat_visits) > 0){
                                
                                while($rooo = mysqli_fetch_assoc($cat_visits)){
                                    print_r('
                                    <tr>
                                        <td>'.$rooo['cat_name'].'</td>
                                        <td>'.$rooo['visits'].'</td>
                                    </tr>
                                    ');
                                }
                            }
                        }else{
                            print_r(mysqli_error($con));
                        }
                        
                        
                        
                        ?>
                        
                    </tbody>
                    
                </table>
            </div>
            <div class="col-xxl-6 col-xl-6 col-md-6 col-12" style="height:370px;overflow-y:scroll;">

                <h4 class="text-center bg-secondary text-light">Top Products</h4>
                <table class="table table-bordered table-striped table-sm table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Visits</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        $prod_visits = mysqli_query($con, "SELECT * FROM `products` ORDER BY `views` DESC");
                        if($prod_visits){
                            if(mysqli_num_rows($prod_visits) > 0){
                                
                                while($prow = mysqli_fetch_assoc($prod_visits)){
                                    print_r('
                                    <tr>
                                        <td><b>'.$prow['name'].'</b> - '.$prow['category'].'</td>
                                        <td>'.$prow['views'].'</td>
                                    </tr>
                                    ');
                                }
                            }
                        }else{
                            print_r(mysqli_error($con));
                        }
                        
                        ?>
                        
                    </tbody>
                    
                </table>
            </div>
            <!-- End Customers Card -->
          </div>
          
          <hr>
          
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-md-12 col-12">
               
                <h4 class="text-center bg-secondary text-light">Overview Products</h4>
                <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
                 
            </div>
            
          </div>
          
        <hr>
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-md-12 col-12" style="height:370px;overflow-y:scroll;">
               
                <h4 class="text-center bg-secondary text-light">Top Search Blog</h4>
                <table class="table table-bordered table-striped table-sm table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        $sr_visits = mysqli_query($con, "SELECT * FROM `searches` ORDER BY `id` DESC LIMIT 50");
                        if($sr_visits){
                            if(mysqli_num_rows($sr_visits) > 0){
                                
                                while($srrow = mysqli_fetch_assoc($sr_visits)){
                                    print_r('
                                    <tr>
                                        <td>Keyword: "<b>'.$srrow['title'].'</b>" - '.$srrow['ip'].'</td>
                                        <td>'.$srrow['date'].'</td>
                                    </tr>
                                    ');
                                }
                            }
                        }else{
                            print_r("<script> alert('".mysqli_error($con)."'); </script> ");
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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</php>