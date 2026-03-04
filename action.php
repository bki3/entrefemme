<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config/config.php';

if(isset($_POST['vote'])){
    
    $stmt = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_name` = '".ucfirst($_POST['cat'])."'");
    if($stmt){
        if(mysqli_num_rows($stmt) > 0){
            $r = mysqli_fetch_assoc($stmt);
            $count = $r['votes']+1;
            
    $stmt2 = mysqli_query($con, "UPDATE `categories` SET `votes` = '$count' WHERE `cat_name` = '".ucfirst($_POST['cat'])."'");
    
    if($stmt2){
        echo "<script>alert('Thank you for vote !!'); window.location.href='index.php';</script>";
    }
    
            
        }
    }
}




if(isset($_GET['like'])){
    
    $stmt = mysqli_query($con, "SELECT * FROM `post` WHERE `id` = '".$_GET['like']."'");
    
    if($stmt){
        if(mysqli_num_rows($stmt) > 0){
            
    $r = mysqli_fetch_assoc($stmt);
    $count = $r['likes']+1;
            
    $stmt2 = mysqli_query($con, "UPDATE `post` SET `likes` = '$count' WHERE `id` = '".$_GET['like']."'");
    
    if($stmt2){
        echo "<script>window.location.href='blog_details.php?id=".$_GET['like']."';</script>";
    }
    
            
        }
    }
}






if(isset($_POST['addcomment'])){
      
    extract($_POST);

    $date=date('Y-m-d h:i:s');
$stmt = mysqli_query($con, "SELECT * FROM `comment` ORDER BY `comment_id` DESC");

if($stmt){
    if(mysqli_num_rows($stmt) > 0){
        $cid= mysqli_fetch_assoc($stmt)['comment_id'];
        $cid+=1;
    }else{
        $cid = 1;
    }


    $stmt2 = mysqli_query($con, "INSERT INTO `comment` (`comment_id`, `post_id`, `name`,`email`, `body`,`date`) VALUES('$cid', '$id','$name','$email', '$comment','$date')");
    
    if($stmt2){
        echo "<script>window.location.href='blog_details.php?id=".$_POST['id']."';</script>";
    }else{
        echo mysqli_error($con);
    }
    
}



    
}



?>