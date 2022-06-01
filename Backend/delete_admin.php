<?php
    //include this file to enable connection to database
    include_once "../Config/constant.php";
    //get the id of admin to be deleted
    $del_id = $_GET['id'];
    //create sql query to delete admin
    $sql = "DELETE FROM admin_table where id=$del_id";

    //Execute above query
    $res = mysqli_query($conn,$sql);
 
    //check if query is executed
    if($res){

        //create session variable to display message
        $_SESSION['delete'] = '<div class="success">Admin deleted successfully</div>';

        //redirect to manage admin page
        header('location:'.SITEURL.'../Backend/manage_admin.php');
    }
    else{
        $_SESSION['delete'] = '<div class="error">failed to delete Admin</div>';

        //redirect to manage admin page
        header('location:'.SITEURL.'../Backend/manage_admin.php');
       
    }
