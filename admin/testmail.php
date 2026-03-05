<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php'); 

include '../config/config.php';



$mail = new PHPMailer(true);
 
      try {
      $mail->SMTPDebug = 2;                                       
        $mail->isSMTP();                                            
        $mail->Host       = $smtpHost;                    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = $smtpUsername;                 
        $mail->Password   = $smtpPassword;                        
        $mail->SMTPSecure = $smtpSecure;                              
        $mail->Port       = $smtpPort;  
     
        $mail->setFrom($smtpUsername, 'Entre Femme');              
          $mail->addAddress("miracleknown@gmail.com");
          $mail->addAddress("miracleknown@gmail.com", "Arshad");
            
          $mail->isHTML(true);                                  
          $mail->Subject = "Hello";
          $mail->Body    = "<h1 style='text-align:center;'>Hello</h1>How are you this is test message";
          $mail->AltBody = '';
          $mail->send();
            
          echo "<script>alert('Email sent Successfully'); </script>";

      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
      }
      





?>