<?php
session_start();
include '../config/config.php';

// Set a cookie valid for 1 year
setcookie('cookie', 'cookievalue', time() + (365 * 24 * 60 * 60), '/');

// Update all '(unknown country?)' entries to 'Canada'
mysqli_query($con, "UPDATE `visitors` SET `country` = 'Canada' WHERE `country` = '(unknown country?)'");

// ✅ Optimized: Update visit counts in `countries` table using JOIN
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

// Handle login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `name` = '$username' OR `email` = '$username'");

    if ($sql && mysqli_num_rows($sql) > 0) {
        $user = mysqli_fetch_assoc($sql);

        if (password_verify($password, $user['password'])) {
            $_SESSION['login'] = $user['email'];

            if ($user['type'] == '1') {
                $_SESSION['admin'] = 1;
                $_SESSION['author'] = 0;
                echo "<script>window.location.href='index.php';</script>";
            } else {
                $_SESSION['admin'] = 0;
                $_SESSION['author'] = 1;
                echo "<script>window.location.href='../author/index.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid Login. Try Again');</script>";
        }
    } else {
        echo "<script>alert('Invalid Login. Try Again');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - Admin Panel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include 'links.php';?>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Admin Panel</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 " method="POST">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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
