<?php
    include_once "partials/menu.php";
?>


<div class="main_content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php

            //check whether id is set or not
            if(isset($_GET['id'])){
                // get id and other details
                $id = $_GET['id'];

                //create sql query to get other details from database
                $sql = "SELECT * FROM category_table WHERE id=$id";

                
                $res = mysqli_query($conn,$sql);

                //count the rows to check whether there is data
                $count = mysqli_num_rows($res);

                if($count ==1){
                    //Get all the data
        
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    //redirect to manage category
                    $_SESSION['no_category'] = "<div class='error'>No Category available</div>";
                    header("location:".SITEURL.'../Backend/manage_category.php');
                }

            }
            else{
                 //Redirect to manage category
                 $_SESSION['unauthorized'] = '<div class="error">Unauthorized action</div>';
                 header("location:".SITEURL.'../Backend/manage_category.php');
            }

       

     ?>
        <!-- Add Category form starts here -->
        <form action="#" method="POST" enctype="multipart/form-data">
                <table class="tbl_30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Category Title" value="<?php echo $title ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image != ""){
                                    //display the image?>
                                    <img src="<?php echo SITEURL;?>../images/category/<?php  echo $current_image?>" width="70px">
                                    <?php
                                }
                                else{
                                    //display message
                                    echo "<div class='error'>Image not added</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php    if($featured == 'Yes'){
                                echo "checked";
                                }?> type="radio" name="featured" value="Yes">Yes
                            <input <?php    if($featured == 'No'){
                                echo "checked";
                                }?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php    if($active == 'Yes'){
                                echo "checked";
                                }?> type="radio" name="active" value="Yes">Yes
                            <input <?php    if($active == 'No'){
                                echo "checked";
                                }?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                  
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value ="<?php echo $id?>">
                            <input type="submit" name="submit" value="Update Category" class="btn_secondary">
                        </td>
                    </tr>
                </table>

            </form>

        <!-- Add Category form ends here -->
    <?php 
    //check whether submit button is clicked or not
    if(isset($_POST['submit'])){
        //get values from form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $image_name = $_POST['image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //update the image if selected
        //check whether the image is selected or not
        if(isset($_FILES['image']['name'])){
           //get the image details 
           $image_name = $_FILES['image']['name'];

           //check whether image is available
           if($image_name != ""){
               //image is available
               //upload the new image
               //Session to auto rename our image instead of replacing it
                //get the file extension of image
                    $ext = end(explode('.',$image_name));

                    //Rename the image
                    $image_name = "food_category_".rand(000,999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../Images/category/".$image_name;

                    //upload image
                    $upload = move_uploaded_file($source_path,$destination_path);

                    //check whether image is uploaded
                    if(!$upload){
                        //set message
                        $_SESSION['upload'] = '<div class="error">Failed to upload image</div>';

                        //Redirect to add category page
                        header("location:".SITEURL.'../Backend/manage_category.php');
                        //stop the process
                            die();
                        }
               //remove the current image if available
               if($current_image != ""){
                    $remove_path = "../Images/category/".$current_image;
                    $remove = unlink($remove_path);

                    //check whether image is removed or not
                    if(!$remove){
                    //failed to remove image
                        $_SESSION['remove_fail'] = "<div class = 'error'>Failed to remove image</div>";
                        //Redirect to add category page
                        header("location:".SITEURL.'../Backend/manage_category.php');
                        die();
                    }
                }
           }
           else{
               $image_name = $current_image;
           }
        }
        else{
            $image_name = $current_image;
        }
        
        //update the database
        $sql2 = "UPDATE category_table SET 
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id=$id 
            ";

        $res2 = mysqli_query($conn, $sql2);
            if($res2){
                //Category updated
                $_SESSION['update'] = '<div class="success">Category updated successfully</div>';
                header("location:".SITEURL.'../Backend/manage_category.php');
            }
            else{
                //failed to update category
                $_SESSION['update'] = '<div class="error">Failed to update category</div>';
                header("location:".SITEURL.'../Backend/manage_category.php');
            }
        // Redirect to manage category
    }
        
?>




<?php
    include_once "partials/footer.php";
?>