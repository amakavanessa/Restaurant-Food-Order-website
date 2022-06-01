<?php include 'partials/menu.php'?>

<div class="main_content">
    <div class="wrapper">
        <h1>Update Order</h1>  
        <br><br>
        <?php
            //check whether id isset or not
            if(isset($_GET['id']))
            {
                //get the order details
                $id= $_GET['id'];

                $sql ="SELECT * FROM order_table WHERE id=$id";

                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);

                if($count == 1){
                    //detail available
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    
                }
                else{
                    header("location:".SITEURL.'../Backend/manage_order.php');
                }

            }
            else{
                header("location:".SITEURL.'../Backend/manage_order.php');
            }
        
        ?>
        <form action="" method="POST">
            <table class='tbl-30'>
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food;?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>$<?= $price ?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity;?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option 
                                <?php 
                                    if($status=="ordered"){
                                        echo "selected";
                                    }
                                ?>
                            value="ordered">Ordered</option>
                            <option 
                                <?php 
                                    if($status=="On delivery"){
                                        echo "selected";
                                    }
                                ?>
                            value="On delivery">On delivery</option>
                            <option 
                                <?php 
                                    if($status=="Delivered"){
                                        echo "selected";
                                    }
                                ?>
                            value="Delivered">Delivered</option>
                            <option 
                                <?php 
                                    if($status=="Cancelled"){
                                        echo "selected";
                                    }
                                ?>
                            value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="10"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value='Update Order' class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
               extract($_POST);
               $total = $price * $quantity;

               $sql2 = "UPDATE order_table SET
                	quantity=$quantity,
                    total=$total,
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address' 
                    WHERE id=$id";
                $res2=mysqli_query($conn,$sql2);

                if($res2){
                    $_SESSION['update']="<div class='success'>Order Updated Successfully</div>";
                    header('location:'.SITEURL.'../Backend/manage_order.php');
                }
                else{
                    //failed to update
                    $_SESSION['update']="<div class='error'>Failed to update order</div>";
                    header('location:'.SITEURL.'../Backend/manage_order.php');
                }
            }
  
        ?>
    </div>
</div>






<?php include 'partials/footer.php'?>