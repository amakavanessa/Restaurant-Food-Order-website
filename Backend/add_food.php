<?php include_once "partials/menu.php" ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['incomplete'])) {
            echo $_SESSION['incomplete'];
            unset($_SESSION['incomplete']);
        }

        ?>
        <form action="#" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>

                </tr>

                <tr>

                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>

                </tr>

                <tr>

                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" min="1">
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
                            $sql = "SELECT*FROM category_table WHERE active='Yes'";
                            //Exceute query
                            $res = mysqli_query($conn, $sql);

                            //count rows to ensure there are categories
                            $count = mysqli_num_rows($res);
                            //xhcek if no of rows is greater than 0
                            if ($count > 0) {
                                //category available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get details of category
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id ?>"><?php echo $title ?></option>
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
                        <input type="radio" name="featured" value="Yes">Yes

                        <input type="radio" name="featured" value="No">No
                    </td>

                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes

                        <input type="radio" name="active" value="No">No
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Food" class="btn_secondary" name="submit">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        //check whether submit button is clicked
        if (isset($_POST['submit'])) {
            //add data into database when submit is clicked
            //Get data from form
            $food_title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether radio button of fetured and active is check
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                // default value incase radio button isnt selected
                $featured = 'No';
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                // default value incase radio button isnt selected
                $active = 'No';
            }

            //check whether select image button is click or not

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                //ony when an image is selected that you will attempt to upload
                if ($image_name != "") {
                    //Session to auto rename our image instead of replacing it
                    //get the file extension of image
                    $ext = end(explode('.', $image_name));

                    // move to another folder
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../Images/food/" . $image_name;

                    //uplaod image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether image uploaded or not
                    if (!$upload) {
                        //redirect to manage food page and die process

                        $_SESSION['upload'] = '<div class="error">Failed to upload Image</div>';
                        header('location:' . SITEURL . "../Backend/add_food.php");

                        // die();
                    }
                }
            } else {
                $image_name = "";
            }
            //insert into database
            //create sql query if $data is complete
            if ($food_title != "" and $price != "") {
                $sql2 = "INSERT INTO food_table SET
                    title = '$food_title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured= '$featured',
                    active ='$active' 
                ";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2) {
                    //data inserted successfully
                    $_SESSION['add'] = '<div class="success">Food inserted successfully</div>';
                    //redirect to manage food
                    header('location:' . SITEURL . '../Backend/manage_food.php');
                } else {
                    $_SESSION['add'] = '<div class="error">Failed to add food</div>';
                    //redirect to manage food
                    header('location:' . SITEURL . '../Backend/manage_food.php');
                }
            } else {
                $_SESSION['incomplete'] = '<div class="error">Please complete the form</div>';
                //redirect to manage food
                header('location:' . SITEURL . '../Backend/add_food.php');
            }
        }

        ?>
    </div>
</div>









<?php include_once "partials/footer.php" ?>