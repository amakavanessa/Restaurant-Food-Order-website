<?php include_once 'partials/menu.php';?>

<div class="main_content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
            if(isset($_GET['id'])){
                //get all the data relating to the id passed in the url
                $id = $_GET['id'];
                $sql = "SELECT * FROM food_table WHERE id=$id";
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                if($count == 1){
                    $rows = mysqli_fetch_assoc($res);
                    $food_title = $rows['title'];
                    $description = $rows['description'];
                    $price = $rows['price'];
                    $current_image = $rows['image_name'];
                    $current_category = $rows['category_id'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];
                }
            }
            else{
                $_SESSION['unauthorize'] = '<div class="error">Unauthorized action</div>';
                // redirect to manage food page
                header('location:'.SITEURL."../Backend/manage_food.php");
            }
        
        ?>
        <form action="#" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $food_title;?>">
                    </td>

                </tr>

                <tr>

                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>

                </tr>

                <tr>

                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" min="1" value=<?php echo $price;?>>
                    </td>

                </tr>


                <tr>

                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != ""){
                        ?>
                                <img width="70px" src="<?php echo SITEURL;?>../Images/food/<?php echo $current_image;?>">
                        <?php
                            }
                            else{
                                echo "<div class='error'>Image not added</div>";
                            }

                        ?>
                    </td>

                </tr>
                <tr>

                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>

                </tr>
                <tr>

                    <td>Category</td>
                    <td>
                        <select name="category">

                            <?php

                            //display Category options from the database 
                            //create sql to get all active categories from database
                            $sql2 = "SELECT*FROM category_table WHERE active='Yes'";
                            //Exceute query
                            $res2 = mysqli_query($conn, $sql2);

                            //count rows to ensure there are categories
                            $count2 = mysqli_num_rows($res2);
                            //xhcek if no of rows is greater than 0
                            if ($count2 > 0) {
                                //category available
                                while ($row = mysqli_fetch_assoc($res2)) {
                                    //get details of category
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>
                                    <option 
                                    <?php
                                        if($current_category == $category_id){
                                            echo "selected";
                                        }
                                    ?>
                                         value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                                <?php
                                }
                            } else {
                                //No category available
                                ?>
                                <option value="#">No Category available</option>
                            <?php
                            }

                            ?>
                        </select>
                    </td>

                </tr>

                <tr>

                    <td>Featured: </td>
                    <td>
                    <input <?php    if($featured == 'Yes'){
                                echo "checked";
                                }?> type="radio" name="featured" value="Yes">Yes
                        <input <?php   if($featured == 'No'){
                            echo "checked";
                        } ?> type="radio" name="featured" value="No">No
                    </td>

                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php   if($active == 'Yes'){
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes">Yes

                        <input <?php   if($active == 'No'){
                            echo "checked";
                        } ?> type="radio" name="active" value="No">No
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" value="Update Food" class="btn_secondary" name="submit">
                    </td>
                </tr>
            </table>

        </form>
        <?php
            //check whether button is clicked
            if(isset($_POST['submit'])){
                //get details from form
                extract($_POST);
                //upload the new image
                //check if the file tag is clicked
                if(isset($_FILES['image']['name'])){
                    $image = $_FILES['image']['name'];
                    if($image != ""){
                        //image is availble 
                        //get extension of image
                        $ext = end(explode('.',$image));

                        //rename the image
                        $image = "food_".rand(0000,9999).".".$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path ="../Images/food/".$image;

                        //upload image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        if(!$upload){
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";

                            header('location:'.SITEURL.'../Backend/manage_food.php');
                            die();
                        }
                          
                        //remove current image if available
                        if($current_image != ""){
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
                            if(!$remove){
                                $_SESSION['image_remove_fail']="<div class='error'>Failed to remove image</div>";

                                header('location:'.SITEURL.'../Backend/manage_food.php');
                                die();
                            }

                        }
                    }
                    else{
                        $image = $current_image;
                    }
                }
                else{
                    $image = $current_image;
                }
                // update the food in database
                    $sql3 = "UPDATE food_table SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image',
                    category_id = '$category',
                    featured= '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";

                    $res3 = mysqli_query($conn,$sql3);

                    if($res3){
                        $_SESSION['update']="<div class='success'>Food updated successfully</div>";
                        header('location:'.SITEURL.'../Backend/manage_food.php');
                        
                
                    }
                    else{
                        $_SESSION['update']="<div class='error'>Failed to update Food</div>";
                        header('location:'.SITEURL.'../Backend/manage_food.php');
                    }
                    
                

            }
        
        
        
        ?>
    </div>
</div>




<?php include_once 'partials/footer.php';?>