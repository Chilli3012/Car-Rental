<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
    // $_SESSION['loggedin']=false;
    session_unset();
    session_destroy();
}  
header("location: login.php");
exit;
?>