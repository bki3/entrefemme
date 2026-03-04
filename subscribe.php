<?php


    include 'config/config.php';
    
    
    
    if(isset($_POST['subscribe'])){
        
        extract($_POST);
        $date = date('M d, Y');
        $quer = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `email` = '$email'");
        
        
        if($quer){
            if(mysqli_num_rows($query) == 0){
            $query = mysqli_query($con, "INSERT INTO `subscriptions` (`name`,`email`,`date`) VALUES ('$name','$email','$date')");
            
                if($query){
                    echo "<script>alert('Subscribed Successfully!'); window.location.href = 'index.php';</script>";   
                }
            }else{
                    echo "<script>alert('Email Already Subscribed!'); window.location.href = 'index.php';</script>";   
            }
        }
        
    }
    
    
    
    if(isset($_POST['submit'])){
        
        extract($_POST);
        $date = date('M d, Y');
        $quer = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `email` = '$email'");
        $name = $email;
        
        if($quer){
            if(mysqli_num_rows($query) == 0){
            $query = mysqli_query($con, "INSERT INTO `subscriptions` (`name`,`email`,`date`) VALUES ('$name','$email','$date')");
            
                if($query){
                    echo "<script>alert('Subscribed Successfully!'); window.location.href = 'index.php';</script>";   
                }
            }else{
                    echo "<script>alert('Email Already Subscribed!'); window.location.href = 'index.php';</script>";   
            }
        }
        
    }

?>