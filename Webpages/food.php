<?php
include_once "partials_front/nav.php";
?>

<!-- Food search Section starts here -->
<section class="food_search text_center">
  <div class="container">
    <form action="<?php SITEURL ?>food_search.php" method="POST">
      <input type="search" name="search" placeholder="Search for food...">
      <input type="submit" value="Search" class="btn btn_primary">
    </form>
  </div>
</section>
<!-- food search Section ends here -->
<!-- Food Menu Section starts here -->
<section class="food_menu">
  <div class="container">
    <h2 class="text_center">Food Menu</h2>

    <?php
    //getting food from food_table database
    $sql = "SELECT * FROM food_table WHERE active='yes'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
      //food available
      while ($rows = mysqli_fetch_assoc($res)) {
        $food_id = $rows['id'];
        $food_title = $rows['title'];
        $price = $rows['price'];
        $description = $rows['description'];
        $food_image_name = $rows['image_name'];

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
            <a href="#" class="btn btn_primary">Order now</a>
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
<?php
include_once "partials_front/footer.php";

?>