<?php
    
    ob_start();
    //Start Session

    session_start(); 
    //create constants to store non repeating value
    define('SITEURL','http://localhost/tummytown/webpages/');
    define('SERVER','localhost',$case_insensitive = false);

    define('DB_USERNAME','root',$case_insensitive = false);

    define('PASSWORD','');

    define('DB_NAME','tummyorders');

    //connects to the local host server and database
    $conn = mysqli_connect(SERVER,DB_USERNAME,PASSWORD,DB_NAME) or die(mysqli_connect_error());
