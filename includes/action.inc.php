<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    include('constants.php');

    //Catch Errors
    function myCustomErrorHandler(int $errNo, string $errMsg, string $file, int $line) {
        // echo "Wow my custom error handler got #[$errNo] occurred in [$file] at line [$line]: [$errMsg]";
        echo '';
        }
        
    set_error_handler('myCustomErrorHandler');


    //Catches error caused by shoppingcart array not created yet
    try{
        // Get no.of items available in the cart table
        if (isset($_GET['shoppingCart']) && isset($_GET['shoppingCart']) == 'shopping_cart') {

            if(count($_SESSION['shopping_cart'])>0)
            {
                //Display # of items in cart
                $count = count($_SESSION['shopping_cart']);
                echo $count;
            }
        }
    } catch (Throwable $e) {
        // echo 'And my error is: ' . $e->getMessage();
        echo '';
    }

    //Check if Shoppipng Cart exists or has items
    if (isset($_GET['checkcart']) && isset($_GET['checkcart']) == 'check_cart') {
        try
        {
            if(count($_SESSION['shopping_cart'])>0)
            {
                $cart = "TRUE";
                echo $cart;
            }
        }catch (Throwable $e) {
            // echo 'And my error is: ' . $e->getMessage();
            $cart = "FALSE";
            echo $cart;
        }
    }

    if(isset($_POST['itemAdded']) && isset($_POST['itemAdded']) == 'item_Added')
    {
        $data = '<div class="alert alert-success alert-dismissible mt-2">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Item added to your cart!</strong>
        </div>';
    }

    // Empty the Cart after checkout
    if(isset($_GET['emptycart']) && isset($_GET['emptycart']) == 'empty_cart'){
        $total = 0;
        foreach($_SESSION['shopping_cart'] as $key => $product){
            session_unset();
        }
    }

    // Input user information to DB, Display Thankyou message, Empty Cart
    if(isset($_POST['action']) && isset($_POST['action']) == 'order')
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];;
        $region = $_POST['region'];
        $products = $_POST['products'];
        $pmode = $_POST['pmode'];
        $tz = 'Asia/Singapore';
        $timestamp = time();
        $dateTime = new DateTime("now", new DateTimeZone($tz));
        $dateTime->setTimestamp($timestamp);
        $order_date = $dateTime->format("Y-m-d h:i:s");
        $order_status = "Pending";
        $cart_total = $_POST['cart_total'];
        // $deliveryfee = "";//*Remove
        $data = '';


        //Input User Information to DB
        $sql = 'INSERT INTO tbl_order (name, email, phonenumber, address, city, region, order_items, paymentmode, order_date, cart_total, order_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
             $_SESSION['test'] = "<div class ='error'>Order Failed</div>";
             header('location:'.SITEURL.'../index.php');
             exit();
         }
         
         mysqli_stmt_bind_param($stmt, 'sssssssssss', $name, $email, $phone, $address, $city, $region, $products, $pmode, $order_date, $cart_total, $order_status);
         mysqli_stmt_execute($stmt);
         
         
         mysqli_stmt_close($stmt);
        // Thankyou Message
          $data .= '<div class="text-center">
                            <h1 class="display-4 mt-2 header-text">Thank You!</h1>
                            <h2 class="text-success">Your Order Placed Successfully!</h2>
                            <h4 class="product-txt-color rounded-pill p-2 m-4">Items Purchased : ' . $products . '</h4>
                            <h4>Your Name : ' . $name . '</h4>
                            <h4>Your E-mail : ' . $email . '</h4>
                            <h4>Your Phone : ' . $phone . '</h4>
                            <h4>Payment Mode : ' . $pmode . '</h4>
                            <h4><a href="../includes/orderEmail.inc.php?email='.$email.'"><div class="btn-success rounded-pill p-2 m-4">Continue Shoppping</div></a></h4>
                    </div>';
        echo $data;
    
    // $sql = "INSERT INTO tbl_orders SET
    //             name = '$name',
    //             email = '$email',
    //             phonenumber = $phone,
    //             address = '$address',
    //             city = '$city',
    //             postalcode = $postalcode,
    //             region = '$region',
    //             order_items = '$products',
    //             paymentmode = '$pmode',
    //             order_date = '$order_date',
    //             grand_total = $grand_total,
    //             order_status = '$order_status'
    //             ";

    //     $res = mysqli_query($conn, $sql);

    //     if($res == true){
    //         //Thankyou Message
    //         $data .= '<div class="text-center">
    //                             <h1 class="display-4 mt-2 text-secondary">Thank You!</h1>
    //                             <h2 class="text-success">Your Order Placed Successfully!</h2>
    //                             <h4 class="bg-secondary text-light rounded p-2">Items Purchased : ' . $products . '</h4>
    //                             <h4>Your Name : ' . $name . '</h4>
    //                             <h4>Your E-mail : ' . $email . '</h4>
    //                             <h4>Your Phone : ' . $phone . '</h4>
    //                             <h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
    //                             <h4>Payment Mode : ' . $pmode . '</h4>
    //                             <h4><a href="../includes/orderEmail.inc.php?email='.$email.'"><div class="btn-success rounded p-2">Continue Shoppping</div></a></h4>
    //                     </div>';
    //         echo $data;

    //     }
    //     else{
    //         $_SESSION['test'] = "<div class ='error'>Order Failed</div>";
    //         header('location:'.SITEURL.'../index.php');
    //     }
        
        // Empty the Cart after checkout
        if(!empty($_SESSION['shopping_cart'])){
            $total = 0;
            foreach($_SESSION['shopping_cart'] as $key => $product){
                session_unset();
            }
        }
    }
?>