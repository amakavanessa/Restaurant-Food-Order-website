<?php
    //include this file to enable connection to database
    include_once "../Config/constant.php";
    //Deleting Category

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
       //get the value and delete
       $id = $_GET['id'];
       $image_name = $_GET['image_name'];

       //remove the physical image if available
       if($image_name != '')
       {
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            
            if($remove == false){
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove image</div>";
                // redirect to manage category page
                header('location:'.SITEURL.'../Backend/manage_category.php');
                die();
            }
       }
       //create sql query to delete Category
        $sql = "DELETE FROM category_table where id=$id";

        $res = mysqli_query($conn,$sql);

        //check whether4 deletion was successful
        if($res){
            //set success message and redirect 
            $_SESSION['delete'] = "<div class = 'success'>Category deleted successfully</div>";
            header('location:'.SITEURL.'../Backend/manage_category.php');
        }
        else{
            //set error message and redirect
            $_SESSION['delete'] = "<div class ='error'>Failed to delete category</div>";
            header('location:'.SITEURL.'../Backend/manage_category.php');
        }
    }
    else{
        $_SESSION['unauthorized'] = '<div class="error">Unauthorized action</div>';
        // redirect to manage category page
        header('location:'.SITEURL.'../Backend/manage_category.php');
    }
