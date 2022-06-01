<?php
    include_once '../Config/constant.php';
?>
<html>
    <head>
        <title>Login - Tummytown</title>
        <link rel="stylesheet" href="../css/Backend.css">
    </head>
    <body>
        <div class="login text_center">
            <h1>Login</h1><br><br>

            <?php
                if(isset($_SESSION['not_logged_in'])){
                    echo $_SESSION['not_logged_in'];
                    unset($_SESSION['not_logged_in  ']);
                }
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>
            <!-- Login form starts here -->
            <form action="#" method="POST">
                Username<br><br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password<br><br>
                <input type="password" name="password" placeholder="Enter password"><br><br>
                <input type="submit" value="Login" name="submit" class="btn_primary text_center">
            </form>
            <!-- Login form ends here -->
         
        </div>

    </body>
</html>
<?php
    if(isset($_POST['submit'])){
        //get data from login form

       $username = mysqli_real_escape_string($conn,$_POST['username']);
       $password = md5($_POST['password']);

       //check whether password matches username on the database

        $sql = "SELECT * FROM admin_table WHERE username= '$username' AND passcode='$password'";

        $res = mysqli_query($conn,$sql);
      
        $count = mysqli_num_rows($res);
        //count rows to know whether user exists
        $Datarows = mysqli_fetch_assoc($res);
        $id = $Datarows['id'];
        $username = $Datarows['username'];
        if($count == 1){
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";

            $_SESSION['user'] = $username; //checks whether the user is logged in or not
            header("location:".SITEURL."../backend/?username=$username");
           
        }
        else {
            $_SESSION['login'] = "<div class='error'>Failed to Login</div>";

            header("location:".SITEURL.'../backend/login.php');
        }

        }

?>