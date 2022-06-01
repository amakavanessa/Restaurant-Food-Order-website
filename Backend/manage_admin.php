<?php include_once ('partials/menu.php');?>
<!-- main content starts here -->
    <div class="main_content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
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

                if(isset($_SESSION['no_user'])){
                    echo $_SESSION['no_user'];

                    unset($_SESSION['no_user']);
                }
            
                if(isset($_SESSION['not_matched']))
                {
                    echo $_SESSION['not_matched'];

                    unset($_SESSION['not_matched']);
                }
            
                if(isset($_SESSION['change_pword']))
                {
                    echo $_SESSION['change_pword'];

                    unset($_SESSION['change_pword']);
                }
            ?>
            <br><br>
            <!-- button to add admin -->
            <a href="add_admin.php" class="btn_primary">Add admin</a>
            <br><br>
            <table class="tbl_full">
                <tr>
                    <th>S/N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>   

                <?php
                    //query
                    $sql = "SELECT * FROM admin_table";

                    //Execute Query
                    $res = mysqli_query($conn,$sql);

                    //check if the query is exceuted or not
                    if($res){
                        $sno = 1 ;//creates a value to curb the issue of braeking the id nos

                        //count rows to ensure there is data in the database
                        $count = mysqli_num_rows($res) ;//get all rows in database

                       if($count>0){
                        //data in data
                        while($DataRows = mysqli_fetch_assoc($res)){
                            //using while loop to get all data from the database

                            //get individual data from database
                            $id = $DataRows['id'];
                            $full_name = $DataRows['full_name'];
                            $username = $DataRows['username'];
   
                ?>

                        <tr>
                            <td><?php echo $sno++?></td>
                            <td><?php echo $full_name?></td>
                            <td><?php echo $username?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>../Backend/change_password.php?id=<?php echo $id?>" class="btn_primary">Change password</a>
                                <a href="<?php echo SITEURL;?>../Backend/update_admin.php?id=<?php echo $id?>" class="btn_secondary">Update Admin</a>  
                                <a href="<?php echo SITEURL;?>../Backend/delete_admin.php?id=<?php echo $id?>" class="btn_danger">Delete Admin</a>
                            </td>
                        </tr>
                        <?php
                            //closing the while loop, if statement from the other php scope
                                     }
                                    } 
                                    
                                    else{
                                        //no data in database
                                     }
                                 }
                        ?>
            </table>
        </div>
    </div>
<!-- main content ends here -->

<?php include_once 'partials/footer.php'?>