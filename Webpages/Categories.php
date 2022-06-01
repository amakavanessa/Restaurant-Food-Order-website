<?php
include_once "partials_front/nav.php";
?>

<section class="explore_food">
    <div class="container">
        <h2 class="text_center">
            Explore Food
        </h2>

        <?php
        //sql to display categery

        $sql = "SELECT * FROM category_table WHERE active='Yes'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //category available
            while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $image_name = $rows['image_name'];

        ?>


                <a href="<?php echo SITEURL; ?>category_food.php?category_id=<?php echo $id; ?>">
                    <div class="box_3 float_container">
                        <?php
                        //check whether email is available or not to avoid error
                        if ($image_name == "") {
                            echo "<div class = 'error'>Image not available</ div>";
                        } else {

                        ?>
                            <img src="<?php echo SITEURL ?>../images/category/<?php echo $image_name ?>" class="img_responsive img_curve">
                            <h3 class="float_text text_white"><?php echo $title ?></h3>
                    </div>
                </a>

    <?php
                        }
                    }
                } else {

                    //category not available
                    echo '<div class ="error">No Category available</div>';
                }


    ?>

    <div class="clearfix"></div>
    </div>
</section>



<?php include_once "partials_front/footer.php" ?>