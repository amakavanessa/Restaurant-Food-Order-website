<?php
include_once "partials/menu.php"

?>
<?php
$id = $_GET['id'];
?>

<div class="main_content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br><br>
        <form action="#" METHOD="POST">
            <table class="tbl_30">
                <tr>
                    <td>Current password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn_secondary">
                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>



<?php
//check whether submit button is clicked
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //check whether the user data exists or not

    $sql = "SELECT * FROM admin_table WHERE id= $id AND passcode = '$current_password'";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        //check whether data is available or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {

            //check if new password and confirm oassword match

            if ($new_password == $confirm_password) {
                //Update password
                $sql2 = "UPDATE admin_table SET passcode='$new_password' WHERE id= $id";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2) {
                    $_SESSION['change_pword'] = "<div class='success'>Password successfully changed</div>";


                    header("location:" . SITEURL . '../Backend/manage_admin.php');
                } else {
                    $_SESSION['change_pword'] = "<div class='error'>Failed to change Password</div>";


                    header("location:" . SITEURL . '../Backend/manage_admin.php');
                }
            } else {
                $_SESSION['not_matched'] = "<div class='error'>Password not matched</div>";


                header("location:" . SITEURL . '../Backend/manage_admin.php');
            }
        } else {
            //if the password doesnt match with the corresponding id
            $_SESSION['no_user'] = "<div class='error'>User does not exist</div>";

            header("location:" . SITEURL . '../Backend/manage_admin.php');
        }
    }
}
?>




<?php
include_once "partials/footer.php"

?>