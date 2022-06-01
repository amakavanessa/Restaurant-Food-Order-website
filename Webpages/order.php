<?php
include_once "partials_front/nav.php";
?>

<?php
// check whether food id is set
if (isset($_GET['food_id'])) {
    //get the food id and get the selected food
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM food_table WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //food available
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //food not available
        header("location:" . SITEURL);
    }
} else {
    //redirect to homepage
    header('location:' . SITEURL);
}



?>

<section class='food_search'>
    <div class="container">
        <h2 class="text_center text_black">Fill this form to confirm your order</h2>

        <form action="" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food_menu_img">
                    <?php
                    // check whether the image is available or not

                    if ($image_name == "") {
                        //image not available
                        echo "<div class='error'>image not available.</div>";
                    } else {
                    ?>
                        <img src="<?php echo SITEURL ?>../images/food/<?php echo $image_name; ?>" class="img_responsive img_curve">
                    <?php
                    }

                    ?>

                </div>
                <div class="food_menu_desc">
                    <h2><?php echo $title ?></h2>

                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <p class="food_price"><?php echo $price ?></p>

                    <div class="order_label">Quantity</div>
                    <input type="number" name="quantity" class="input_responsive" value="1" min="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Precious Nnam" class="input_responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="text" name="contact" placeholder="E.g. 080xxxxxxxx" class="input_responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. pn@gmail.com" class="input_responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" cols="30" rows="5" placeholder="No 8 lenz street,shingashina District Paradis island" class="input_responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn_primary">
            </fieldset>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //get all the form details using extract
            extract($_POST);

            //total amount of money
            $total = $price * $quantity;

            $order_date = date("Y-m-d h:m:s");

            $status = "ordered";
            //ordered,on delivery, delivered, cancelled

            echo $food . $price . $contact . $total . $full_name . $contact . $address;
            //save the order in database
            $sql2 = "INSERT INTO order_table SET
                    food = '$food',
                    price = $price,
                    quantity = '$quantity',
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$full_name',
                    customer_contact = '$contact',
                    customer_email = '$email',
                    customer_address = '$address'
                 
                 ";
            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //check whether query is executed
            if ($res2) {
                //query executed
                $_SESSION['order'] = '<div class ="success text_center">Food ordered successfully</div>';

                header('location:' . SITEURL);
            } else {
                //Not executed
                $_SESSION['order'] = '<div class ="error text_center">Failed to order food</div>';

                header('location:' . SITEURL);
            }
        }



        ?>









    </div>
</section>


<?php
include_once "partials_front/footer.php";
?>