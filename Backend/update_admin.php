<?php
    include_once "partials/menu.php";
?>


<div class="main_content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
            $id_update = $_GET['id'];

            $sql = "SELECT * FROM admin_table WHERE id=$id_update";

            $res = mysqli_query($conn,$sql);

            //check query status
            if($res){
                //check whether data is available

                $count = mysqli_num_rows($res);

                //check whether we have admin data or not
                if($count==1){
                    //get the details
                    echo "Admin available";
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to manage admin
                    header("location:".SITEURL.'../Backend/manage_admin.php');
                }
            }
        ?>
        <form action="#" method="POST">
        <table class="tbl_30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value ="<?php echo $id_update; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
    //check whether submit button is clicked or not
    if(isset($_POST['submit'])){
    
        //get all the values from form to update;
        extract($_POST);

        //create sql query to update admin
        $sql = "UPDATE admin_table SET 
        full_name = '$full_name',
        username = '$username'
        WHERE id = $id_update;
        ";

        //Executing the query
        $res = mysqli_query($conn,$sql);
            if($res){
                //create session variable for when update is successful
                $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
                //redirect to manage admin page
                header("location:".SITEURL.'../Backend/manage_admin.php');
            }
            else{
                //create session variable for when update is unsuccessful
                $_SESSION['update'] = "<div class='error'> Failed to update Admin </div>";
                //redirect to manage admin page
                header("location:".SITEURL.'../Backend/manage_admin.php');
            }
    }

?>




<?php
    include_once "partials/footer.php";
?>