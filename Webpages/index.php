<?php
include_once "partials_front/nav.php";
?>

<!-- Food search Section starts here -->
<section class="food_search text_center">
  <div class="container">
    <form action="<?php SITEURL ?>food_search.php" METHOD="POST">
      <input type="search" name="search" placeholder="Search for food...">
      <input type="submit" value="Search" class="btn btn_primary">
    </form>
  </div>
</section>
<!-- food search Section ends here -->

<?php
if (isset($_SESSION['order'])) {
  echo $_SESSION['order'];
  unset($_SESSION['order']);
}

?>
<!-- Categories Section starts here -->
<section class="explore_food">
  <div class="container">
    <h2 class="text_center">
      Explore Food
    </h2>

    <?php
    //sql to display categery

    $sql = "SELECT * FROM category_table WHERE active='Yes' AND featured='Yes' LIMIT 3";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
      //category available
      while ($rows = mysqli_fetch_assoc($res)) {
        $id = $rows['id'];
        $title = $rows['title'];
        $image_name = $rows['image_name'];

    ?>
        <a href="<?php echo SITEURL; ?>category_food.php?category_id=<?php echo $id ?>">
          <div class="box_3 float_container">
            <?php
            //check whether email is available or not to avoid error
            if ($image_name == "") {
              echo "<div class = 'error'>Image not available</div>";
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
<!-- Categories Section ends here -->

<!-- Food Menu Section starts here -->
<section class="food_menu">
  <div class="container">
    <h2 class="text_center">Food Menu</h2>

    <?php
    //getting food from food_table database
    $sql2 = "SELECT * FROM food_table WHERE active='yes' AND featured = 'Yes' LIMIT 6";
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
<?php include_once "partials_front/footer.php" ?>