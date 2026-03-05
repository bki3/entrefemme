
<?php

// Expire the cookie
setcookie("user", "", time() - 3600, "/");

session_start();
session_destroy();

// Redirect to login page
echo "<script>window.location.href = 'login.php';</script>";

?>
