<?php
    include_once "../Config/constant.php";

    //check if the id and image name is set 
    if(isset($_GET['id']) && isset($_GET['image_name']))
        {
            //get id and image name
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];
            //remove image if available
            if($image_name != ""){
                //it has image name and need to be deleted for food folder
                $path = "../Images/food/".$image_name;

                //remove image from folder
                $remove = unlink($path);
                if($remove == false){
                    //image not removed
                    $_SESSION['remove_fail'] =  "<div class='error'>Failed to remove image</div>";

                    header('location:'.SITEURL.'../Backend/manage_food.php');
                    die();
                }
                
            }
            //delete food from database
            $sql = "DELETE FROM food_table WHERE id=$id";

            $res = mysqli_query($conn,$sql);
            //check whether query is executed and set session message
            if($res){
                //food deleted
                $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
                //redirect to manage food 
                header('location:'.SITEURL."../Backend/manage_food.php");
            }
            else{
                //failed to delete
                $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
                //redirect to manage food 
                // redirect to manage food with session message
                header('location:'.SITEURL."../Backend/manage_food.php");
            }
            
        }
    else
        {
            $_SESSION['unauthorize'] = "<div class='error'>Unauthorized action</div>";
            //redirect to manage food 
            header('location:'.SITEURL."../Backend/manage_food.php");
        }
