<?php include_once ('partials/menu.php');?>
<!-- main content starts here -->
    <div class="main_content">
        <div class="wrapper">
            <h1>Manage category</h1>
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
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            } 
            if(isset($_SESSION['unauthorized'])){
                echo  $_SESSION['unauthorized'] ;
                unset ($_SESSION['unauthorized']);
            }
            if(isset($_SESSION['no_category'])){
                echo  $_SESSION['no_category'] ;
                unset ($_SESSION['no_category']);
            }
            if(isset($_SESSION['update'])){
                echo  $_SESSION['update'] ;
                unset ($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo  $_SESSION['upload'] ;
                unset ($_SESSION['upload']);
            }
            if(isset($_SESSION['remove_fail'])){
                echo  $_SESSION['remove_fail'] ;
                unset ($_SESSION['remove_fail']);
            }
          ?>
        <br><br>
            <!-- button to add admin -->
            <a href="<?php echo SITEURL.'../Backend/add_category.php'; ?>" class="btn_primary">Add Category</a>
            <br><br>
            <table class="tbl_full">
                <tr>
                    <th>S/N</th>
                    <th>Title</th>
                    <th>Image Name</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
    
                    <?php
                        //QUERY TO EXTRACT FROM category_table database
                        $sql = "SELECT * FROM category_table";

                        $res = mysqli_query($conn,$sql);
                        //create s/no
                        $sn = 1;
                        //count Rows
                        $count = mysqli_num_rows($res);
                        //check whether there is data in the database

                        if($count>0){
                            while($DataRow = mysqli_fetch_assoc($res)){
                                $id= $DataRow['id'];
                                $title= $DataRow['title'];
                                $image_name= $DataRow['image_name'];
                                $featured= $DataRow['featured'];
                                $active= $DataRow['active'];

                    ?>
                            <tr>
                                <td><?php echo $sn++; ?></td> 
                                <td><?php echo $title ?></td>

                                <td>
                                    <?php 
                                    //check whether imagename is available
                                        if($image_name!=""){
                                            //display the image
                                            ?>
                                            <img src="<?php echo SITEURL?>../Images/category/<?php echo $image_name;?>" width="50px">                                      
                                    <?php

                                        }
                                        else{
                                            //display error msg
                                            echo "<div class='error'>image not added.</div>";
                                        }
                                    ?>
                                </td> 

                                <td><?php echo $featured ?></td> 
                                <td><?php echo $active ?></td>  
                                <td>
                                    <a href="<?php echo SITEURL;?>../Backend/update_category.php?id=<?php echo $id?>" class="btn_secondary">Update Category</a>
                                    <a href="<?php echo SITEURL;?>../Backend/delete_category.php?id=<?php echo $id?>&image_name=<?php echo $image_name; ?>" class="btn_danger">Delete Category</a>
                                </td> 
                            </tr>
                    <?php
                            }
                        }
                        else{
                            //no data in database
                    ?>
                        <tr>
                            <td colspan="6">
                                <div class="error">
                                    No Category Available
                                </div>
                            </td>  
                        </tr> 
                    <?php
                        }
                    ?>
                </tr>
              
            </table>
        </div>
    </div>
<!-- main content ends here -->

<?php include_once 'partials/footer.php'?>