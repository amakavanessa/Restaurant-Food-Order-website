<?php include_once 'partials/menu.php'; ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!-- Add Category form starts here -->
        <form action="#" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" value="Add Category" class="btn_secondary" name="submit">
                    </td>
                </tr>
            </table>

        </form>

        <!-- Add Category form ends here -->

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];

            //check whether the radio button is selected
            if (isset($_POST['featured'])) {
                //get the value from form if true
                $featured = $_POST['featured'];
            } else {
                //set defaualt
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                //get the value from form if true
                $active = $_POST['active'];
            } else {
                //set defaualt
                $active = "No";
            }
            //check whether image is selected or not and set the value for image name
            // print_r($_FILES['image']);
            // die();//breaks the code here
            if (isset($_FILES['image']['name'])) {

                //to upload image we need image name,source path and destination path
                $image_name = $_FILES['image']['name'];

                //ony when an image is selected that you will attempt to upload
                if ($image_name != "") {
                    //Session to auto rename our image instead of replacing it
                    //get the file extension of image
                    $ext = end(explode('.', $image_name));

                    //Rename the image
                    $image_name = "food_category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../Images/category/" . $image_name;

                    //upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether image is uploaded
                    if (!$upload) {
                        //set message
                        $_SESSION['upload'] = '<div class="error">Failed to upload image</div>';

                        //Redirect to add category page
                        header("location:" . SITEURL . '../Backend/add_category.php');
                        //stop the process
                        die();
                    }
                }
            } else {
                //dont upload the image and set the image_name value as blank 
                $image_name = "";
            }
            //create sql query to insert category into database

            $sql = "INSERT INTO category_table SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

            //executing the query and save into database
            $res = mysqli_query($conn, $sql);

            if ($res) {
                //category successfully addded
                $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                header("location:" . SITEURL . "../Backend/manage_category.php");
            } else {
                // failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to add Category  </div>";
                header("location:" . SITEURL . "../Backend/add_category.php");
            }
        }
        ?>
    </div>
</div>


<?php include_once 'partials/footer.php'; ?>