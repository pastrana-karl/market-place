<?php include('../includes/constants.php'); ?>

<head>
    <title>Online Marketplace</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <link rel="stylesheet" href="../styles/cart.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>

<body>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                    echo $_SESSION['showAlert'];
                    } 
                    else {
                        echo 'none';
                    } 
                    unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    } 
                        unset($_SESSION['showAlert']);?></strong>
                </div>

                <div class="table-title">
                <p>Products in your cart!</p>
                </div>

                <?php
                    if(!empty($_SESSION['shopping_cart'])){
                        $total = 0;
                        foreach($_SESSION['shopping_cart'] as $key => $product){
                ?>

                        <div class="product-details">
                            
                            <div class="product-name">
                                <span>Product Name</span>
                                <?php echo $product['name']; ?>
                            </div>

                            <div class="product-quantity">
                                <span>Quantity</span>
                                <?php echo $product['quantity']; ?>
                            </div>

                            <div class="product-price">
                                <span>Price</span>
                                ₱<?php echo $product['price']; ?>
                            </div>

                            <div class="subtotal-mbl">
                                <p>Subtotal</p>
                            </div>
                                
                            <div class="product-subtotal">
                                <span class = 'hidden'>Subtotal</span>
                                ₱<?php echo number_format($product['quantity'] * $product['price'], 2); ?>
                            </div>
                                
                            <div class="product-remove">
                                <a href = "<?php echo SITEURL; ?>menu.php?action=delete&id=<?php echo $product['id']; ?>">
                                <div class="remove-btn" onclick="return confirm('Are you sure want to remove this item?');">Remove</div>
                                </a>
                            </div>

                        </div>

                        <div class="table-footer">
                        <?php
                            $total = $total + ($product['quantity'] * $product['price']);
                            }
                        ?>

                        <div class="product-total">
                            <span>Total: ₱<?php echo number_format($total, 2); ?></span>
                        </div>                  

                        <div class="product-checkout">
                            <?php
                                if(isset($_SESSION['shopping_cart'])){
                                    if(count($_SESSION['shopping_cart']) > 0){//only show checkout if shopping cart is not empty
                            ?>
                                <?php 
                                    if(isset($_SESSION['ordercomplete'])){
                                        $delete = $_SESSION['ordercomplete'];
                                    }
                                ?>
                                    <a href="checkout.php" class ="checkout-btn">Checkout</a>
                                <?php
                                }
                            }
                                ?>
                        </div>                  

                
                <?php } 
                    else {          
                    }
                ?>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: '../includes/action.inc.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

    // // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();
    checkcart();

    function load_cart_item_number() {
      $.ajax({
        url: '../includes/action.inc.php',
        method: 'get',
        data: {
          shoppingCart: "shopping_cart"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }

         window.onunload = function () {
        emptycart();
         };

// 			$(function () {
// 				$("a").not('#lnkLogOut').click(function () {
// 					window.onbeforeunload = null;
// 				});
// 				$(".btn").click(function () {
// 					window.onbeforeunload = null;
// 				});
// 			});
			/*UNDER CONSTRUCTION*/

			function emptycart() {
				$.ajax({
					url: '../includes/action.inc.php',
					method: 'get',
					data: {
					emptycart: "empty_cart"
					}
				});
			}


      function checkcart() {
			$.ajax({
				url: '../includes/action.inc.php',
				method: 'get',
				data: {
          checkcart: "check_cart"
				},
				success: function(response) {
          console.log(response);
				}
			});
			}
  });

  
    </script>
</body>