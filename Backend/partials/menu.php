<?php
include_once('../Config/constant.php ');
include_once('logincheck.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Food Order website - Homepage</title>
   <link rel="stylesheet" href="../css/backend.css">
</head>

<body>
   <!-- Menu section starts here -->
   <div class="menu text_center">
      <div class="wrapper">
         <ul>
            <li>
               <a href="index.php">Home</a>
            </li>
            <li>
               <a href="manage_admin.php">Admin </a>
            </li>
            <li>
               <a href="manage_category.php">Category</a>
            </li>
            <li>
               <a href="manage_food.php">Food</a>
            </li>
            <li>
               <a href="manage_order.php">Order</a>
            </li>
            <li>
               <a href="logout.php" class="btn_primary">Logout</a>
            </li>
         </ul>
      </div>
   </div>
   <!-- Menu section ends here -->