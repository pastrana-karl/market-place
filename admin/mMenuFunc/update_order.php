<?php 
	include('../../includes/constants.php'); 
	include('../../includes/adminheader.php'); 
?>
<?php
	if (isset($_SESSION["usersName"])){

	}
	else{
		header("location: ../index.php");
		exit();
	}
?>

<?php
    //Check whether if id is set or not
    if(isset($_GET['order_ID'])){
        //Get Order Details
        $order_ID = $_GET['order_ID'];

        //Get all other details based on this id
        //SQL query to get order details
        $sql = "SELECT * FROM tbl_order WHERE order_ID=$order_ID";
        //Execute Query
        $res = mysqli_query($conn,$sql);
        //Count Rows
        $count = mysqli_num_rows($res);

        if($count==1){
            //Details Available
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $email = $row['email'];
            $phonenumber = $row['phonenumber'];
            $address = $row['address'];
            $city = $row['city'];
            $region = $row['region'];
            $order_items = $row['order_items'];
            $paymentmode = $row['paymentmode'];
            $order_date = $row['order_date'];
            $cart_total = $row['cart_total'];
            $order_status = $row['order_status'];
        }
        else{
            //Details not Available
            //Redirect to Manage Order
            header('location:'.SITEURL.'admin/manage_order.php');
        }
    }
    else{
        //Redirect to Manage Order
        header('location:'.SITEURL.'admin/manage_order.php');
    }
?>

<head>
	<title>Update Order</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
	<link rel="stylesheet" href="../../styles/manage.css">
</head>



<div class="maincontent">
    <div class="wrapper">
        <div class="column">
            <div class="card">
                <h1>Update Order</h1>
                <br><br>
                <form action="" method="POST">
                    <table class="tbl-full">
                        <tr>
                            <td>Name</td>
                            <td><?php echo $name;?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $email;?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php echo $phonenumber;?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $address;?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><?php echo $city;?></td>
                        </tr>
                        <tr>
                            <td>Region</td>
                            <td><?php echo $region;?></td>
                        </tr>
                        <tr>
                            <td>Items</td>
                            <td><?php echo $order_items;?></td>
                        </tr>
                        <tr>
                            <td>Payment Mode</td>
                            <td><?php echo $paymentmode;?></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><?php echo $order_date;?></td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td><?php echo $cart_total;?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                <select name = "status">
                                    <option <?php if($order_status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                                    <option <?php if($order_status=="Catering"){echo "selected";}?> value="Catering">Catering</option>
                                    <option <?php if($order_status=="Delivering"){echo "selected";}?> value="Delivering">On Delivery</option>
                                    <option <?php if($order_status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                                    <option <?php if($order_status=="Cancelled"){echo "selected";}?> value="Cancelled">Canelled</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="update" value="Update order" class="btn-secondary">
                    <input type="submit" name = "cancel" value = "Cancel" class="btn-tertiary">
                </form>

                <?php
                	if(isset($_POST['cancel'])){
        				header('location:'.SITEURL.'admin/manage_order.php');
        			}
                    //Check whether update button is clicked or not
                    if(isset($_POST['update'])){                        
                        //Get all values from the form
                        $order_status = $_POST['status'];

                        //Update values
                        $sql2 = "UPDATE tbl_order SET
                            order_status = '$order_status'
                            WHERE order_ID=$order_ID
                        ";

                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);

                        if($res2 == true){
                            //Update Successful
                            $_SESSION['update'] = "<div class='success text-center'>Order Updated.</div>";
                            //Email for status update
                            if(strval($order_status)=='Catering'){
                                header('location:'.SITEURL.'includes/cateringEmail.inc.php?email='.$email);
                                exit();
                            }
                            elseif(strval($order_status)=='Delivering'){
                                header('location:'.SITEURL.'includes/deliverEmail.inc.php?email='.$email);
                                exit();
                            }
                            elseif(strval($order_status)=='Cancelled'){
                                header('location:'.SITEURL.'includes/cancelEmail.inc.php?email='.$email);
                                exit();
                            }
                            else{
                                header('location:'.SITEURL.'admin/manage_order.php');
                            }
                        }
                        else{
                            //Update Failed
                            $_SESSION['update'] = "<div class='error'>Order Update Failed.</div>";
                            header('location:'.SITEURL.'admin/manage_order.php');
                        }
                    }
                ?>


            </div>
        </div>
    </div>
</div>
