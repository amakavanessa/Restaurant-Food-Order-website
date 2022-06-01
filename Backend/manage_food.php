<?php include_once ('partials/menu.php');?>
<!-- main content starts here -->
    <div class="main_content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br><br>
            <!-- button to add admin -->
            <a href="<?php echo SITEURL;?>../Backend/add_food.php" class="btn_primary">Add Food</a>
            <br><br>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['remove_fail'])){
                    echo $_SESSION['remove_fail'];
                    unset($_SESSION['remove_fail']);
                }

                if(isset($_SESSION['unauthorize'])){
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['image_remove_fail'])){
                    echo $_SESSION['image_remove_fail'];
                    unset($_SESSION['image_remove_fail']);
                }
        
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <table class="tbl_full">
                <tr>
                    <th>S/N</th>
                    <th>Food title</th>
                    <th>Food price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //create a query to get data from database
                    $sql = "SELECT * FROM food_table";
                    $res = mysqli_query($conn,$sql);
                    
                    //count rows to know if food is available
                    $count=mysqli_num_rows($res);
                    $sno = 1;
                    if($count>0){
                        //food available in database
                        while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            $category_id = $rows['category_id'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                    ?>
                    <tr>
                        <td><?php echo $sno++;?></td>
                        <td><?php echo $title?></td>
                        <td><?php echo $price;?></td>
                        <td><?php
                                if($image_name != ""){
                                    //display the image
                            ?>
                                    <img src="<?php echo SITEURL?>../Images/food/<?php echo $image_name;?>" width="50px"> 
                            <?php
                                }
                                else{
                                    echo "<div class='error'>image not added.</div>";
                                }
                            ?>
                            
                        </td>
                        <td><?php echo $category_id?></td>
                        <td><?php echo $featured?></td>
                        <td><?php echo $active?></td>
                        <td>
                            <a href="<?php echo SITEURL?>../Backend/update_food.php?id=<?php echo $id;?>" class="btn_secondary">Update Food</a>  
                            <a href="<?php echo SITEURL?>../Backend/delete_food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn_danger">Delete Food</a>
                        </td>
                    </tr>
                    <?php
                        }


                    }
                    else{
                        // food not avilable
                        echo "<tr><td colspan='7' class='error'>No food available</td></tr>";
                    }
                
                
                ?>
            </table>
        </div>
    </div>
<!-- main content ends here -->

<?php include_once 'partials/footer.php'?>