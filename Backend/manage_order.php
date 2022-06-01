<?php include_once ('partials/menu.php');?>
<!-- main content starts here -->
    <div class="main_content">
        <div class="wrapper">
            <h1>Manage Order</h1>
            <br><br>
            <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
            ?>
            <table class="tbl_full">
                <tr>
                    <th>S/no</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order_date</th>
                    <th>Status</th>
                    <th>Customer name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
              
                <?php
                    //get all orders from database
                    //display the latest orders first
                    $sql = "SELECT * FROM order_table ORDER BY id DESC";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);
                    $sno=1;
                    if($count>0){
                        //order available
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $quantity = $row['quantity'];
                            $total= $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $contact = $row['customer_contact'];
                            $email = $row['customer_email'];
                            $address = $row['customer_address'];
                            
                    ?>
                    <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>
                            <?php  
                                //ordered, On delivery, delivered, Cancelled
                                if($status=="ordered")
                                {
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="On delivery")
                                {
                                    echo "<label style='color:orange'>$status</label>";
                                }
                                elseif($status=="Delivered")
                                {
                                    echo "<label style='color:green'>$status</label>";
                                }
                                elseif($status=="Cancelled")
                                {
                                    echo "<label style='color:red'>$status</label>";
                                }
                            
                            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $contact; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL?>../Backend/update_order.php?id=<?php echo $id ?>" class="btn_secondary">Update order</a>  
                        </td>
                    </tr>
                    <?php   
                        }
                    }
                    else{
                        //order not available
                        echo "<tr><td colspan='12' class='error'>No order available</td></tr>";
                    }
                
                ?>
            </table>
        </div>
    </div>
<!-- main content ends here -->

<?php include_once 'partials/footer.php'?>