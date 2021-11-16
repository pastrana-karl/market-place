<?php 
    include('../includes/constants.php'); 
    $cart_total = 0.0;
    $allItems = '';
    $items = [];
   // $deliveryfee = 50; 
    $total = 0.0;
   // $grand_total += $deliveryfee;
    $pname = '';
    $pqty = '';
    $total = '';

    if(!empty($_SESSION['shopping_cart'])){
        foreach($_SESSION['shopping_cart'] as $key => $product){
            $id = $product['id'];
            $pname = $product['name'];
            $pqty = $product['quantity'];
            $cart_total += floatval($product['quantity']) * floatval($product['price']);
            $items[] = "$pname($pqty)";
        }
    }
    $allItems = implode(', ', $items);
?>

<head>
            <title>Online Marketplace</title>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
            <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>
<body>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>

    <div class="container2 row justify-content-center">
        <div class="col-lg-5 px-0 pb-1" id="order">
            <h4 class="text-center text-secondary p-2">Complete your order!</h4>
            <div class="jumbotron p-3 mb-2 text-center">
                <h1 class="lead"><b>Product(s): </b><?= $allItems;?></h6>
                <h1 class="lead"><b>Cart Total: ₱</b><?= $cart_total;?></h6>
                <!-- <h1 class="lead"><b>Delivery Fee: ₱</b><?= $deliveryfee;?></h6> -->
                <!--<h1 class="lead"><b>Please Note that the Delivery Fee is not included in the Grand Total </b></h6>-->
            </div>
            <form action="" method="post" id="placeOrder" class= "m-4">
                <input type="hidden" name="products" value="<?= $allItems; ?>">
                <input type="hidden" name="cart_total" value="<?= $cart_total; ?>">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                </div>
                <div class="form-group">
                    <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
                </div>
                <div class="form-group">
                    <input type="text" name="city" class="form-control" placeholder="Enter City" required>
                </div>
                <div class="form-group">
                    <input type="text" name="region" class="form-control" placeholder="Enter Region" required>
                </div>
                <div class="form-group">
                    <select name="pmode" class="form-control">
                        <option value="" hidden>-Select Payment Mode-</option>
                        <option value="Cash On Delivery" selected>Cash On Delivery</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Place Order" class="btn btn-success btn-block rounded-pill">
                </div>
            </form>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Sending Form data to the server
            $("#placeOrder").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '../includes/action.inc.php',
                method: 'post',
                data: $('form').serialize() + "&action=order",
                success: function(response) {
                $("#order").html(response);
                }
            });
            });
        });
    </script>
</body>