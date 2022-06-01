<?php include_once 'partials_front/nav.php' ?>

<?php
//check whether id is passed or not
if (isset($_GET['category_id'])) {
  $category_id = $_GET['category_id'];

  //get the category title from databse
  $sql = "SELECT title FROM category_table WHERE id= $category_id";

  //execute the query
  $res = mysqli_query($conn, $sql);

  //get the value from database

  $row = mysqli_fetch_assoc($res);
  $category_title = $row['title'];
} else {
  //category not passed
  header("location:" . SITEURL);
}
?>

<section class="text_center">
  <div class="container">
    <h2>Foods on <a href="#" class='text_black'>"<?php echo $category_title ?>"</a></h2>
  </div>
</section>

<!-- Food Menu Section starts here -->
<section class="food_menu">
  <div class="container">
    <h2 class="text_center">Food Menu</h2>

    <?php
    //getting food from food_table database
    $sql2 = "SELECT * FROM food_table WHERE category_id=$category_id";
    $res2 = mysqli_query($conn, $sql2);

    $count2 = mysqli_num_rows($res2);

    if ($count2 > 0) {
      //food available
      while ($rows2 = mysqli_fetch_assoc($res2)) {
        $food_id = $rows2['id'];
        $food_title = $rows2['title'];
        $price = $rows2['price'];
        $description = $rows2['description'];
        $food_image_name = $rows2['image_name'];

    ?>
        <div class="food_menubox">
          <div class="food_menu_img">
            <?php
            if ($food_image_name == "") {
              //food image not uploaded
              echo '<div class ="error">Image not available</div>';
            } else {
            ?>


              <img src="<?php echo SITEURL ?>../images/food/<?php echo $food_image_name ?>" class="img_responsive img_curve">
            <?php
            }
            ?>

          </div>
          <div class="food_menu_desc">
            <h4><?php echo $food_title ?></h4>
            <p class="food_price"><?php echo $price ?></p>
            <p class="food_detail">
              <?php echo $description ?>
            </p>
            <br>
            <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $food_id; ?>" class="btn btn_primary">Order now</a>
          </div>
          <div class="clearfix"></div>
        </div>
    <?php

      }
    } else {
      //food not available
      echo "<div class='error'>Food not available</div>";
    }


    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- food Menu Section ends here -->





<?php include_once 'partials_front/footer.php' ?>