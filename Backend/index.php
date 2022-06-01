<?php include_once"partials/menu.php"?>
<?php
    $sql = "SELECT * FROM admin_table";
    $res = mysqli_query($conn,$sql);
    $count_admin = mysqli_num_rows($res);


    $sql2 = "SELECT * FROM category_table";
    $res2 = mysqli_query($conn,$sql2);
    $count_category = mysqli_num_rows($res2);

    $sql3 = "SELECT * FROM food_table";
    $res3 = mysqli_query($conn,$sql3);
    $count_food = mysqli_num_rows($res3);

    $sql4 = "SELECT * FROM order_table";
    $res4 = mysqli_query($conn,$sql4);
    $count_order = mysqli_num_rows($res4);

?>
<!-- Main content starts here -->
        <div class="main_content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                   
                ?>
            <br><br>
                <h3 class="uppercase">HELLO ADMIN  <?php if(isset($_GET['username'])){echo $_GET['username'];}
                    else{
                        echo "";
                    }
                
                ?><h3>
            
                <div class="col_4 text_center">
                    <h1><?php echo $count_category ?></h1>
                    <br>
                    Categories
                </div>

                
                <div class="col_4 text_center">
                    <h1><?php echo $count_food ?></h1>
                    <br>
                    Foods
                </div>

                
                <div class="col_4 text_center">
                    <h1><?php echo $count_order ?></h1>
                    <br>
                    Orders
                </div>

                <div class="col_4 text_center">
                    <?php
                        //create sql query to calculate total revenue
                        //using aggregate fuction in sql
                        $sql5 = "SELECT SUM(total) AS Total FROM order_table WHERE status='Delivered'";

                        $res5 = mysqli_query($conn,$sql5);
                        //get the value
                        $row5 = mysqli_fetch_assoc($res5);
                        //get the total revenue
                        $total_revenue = $row5['Total'];

                    
                    ?>
                    <h1>$<?php echo $total_revenue ?></h1>
                    <br>
                    Revenue generated
                </div>


            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Main content ends here -->

<?php include_once "partials/footer.php"?>