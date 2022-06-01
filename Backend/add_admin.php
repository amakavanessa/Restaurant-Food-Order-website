<?php
include_once "partials/menu.php";

?>

<div class="main_content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>


        <?php
        //to check if the session is set or not
        if (isset($_SESSION['add'])) {
            //displays session message
            echo $_SESSION['add'];
            //removes the session message after you refresh page
            unset($_SESSION['add']);
        }



        ?>
        <br><br>

        <form action="#" method="POST">

            <table class="tbl_30">
                <tr>
                    <td class="label">Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td class="label">Username</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td class="label">Password</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
include_once "partials/footer.php";
?>
<?php
// process the value form and save it in the database

//checks when the submit button is clicked

if (isset($_POST["submit"])) {
    // carry ot this action if the element with name 'submit' is clicked

    //Extract the form data
    extract($_POST);

    // encrypt password
    $password = md5($password);
    echo $password;
    //SQL query to save the data into database
    $sql = "INSERT INTO admin_table SET full_name='$full_name',
        username = '$username',
        passcode = '$password'
        ";

    //Execute query to save data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //check whether data is inserted or not

    if ($res) {
        //create a session variable to display message
        $_SESSION['add'] = '<div class="success">admin added successfully</div>';

        //redirect page
        header("location:" . SITEURL . '../Backend/manage_admin.php');
    } else {
        $_SESSION['add'] = '<div class="error">admin  not added successfully please try again</div>';

        //redirect page
        header("location:" . SITEURL . '../Backend/manage_admin.php');
    }
}



?>