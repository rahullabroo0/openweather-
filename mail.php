<?php
session_start();
// echo $_SESSION['w'];
$to="rahullabroo0@gmail.com";
$subject="testing mail";
$body=$_SESSION['w'];
$header="From sender email";

if(mail($to,$subject,$body,$header)){
    echo "Sucessfully Email has been sent.";
}else{
    echo "Mailer Error :".error_get_last();
}

?>