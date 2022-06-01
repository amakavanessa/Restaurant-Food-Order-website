<?php
    if(!isset($_SESSION['user']))
    {
        // ie user isnt logged in 
        //Redirect to login page with error message

        $_SESSION['not_logged_in'] = "<div class='error'>Please login to access admin Panel</div>"; 

        //Redirect to Login Page
        header('location:'.SITEURL.'../Backend/login.php');
    }
