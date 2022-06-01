<?php
    include_once "../Config/constant.php";
    //destroy all the session
    session_destroy(); //unsets $_SESSION['user'] also

    // Redirect to Login Page
    header('location:'.SITEURL.'../backend/login.php');
?>