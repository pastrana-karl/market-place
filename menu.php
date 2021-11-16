<?php include('includes/constants.php'); ?>

<head>
    <title>Online Marketplace</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>

<body>
    <?php $product_ids = array();

		if(filter_input(INPUT_POST, 'add_to_cart')){
			if(isset($_SESSION['shopping_cart'])){
				$count = count($_SESSION['shopping_cart']); 

				$product_ids = array_column($_SESSION['shopping_cart'], 'id'); 

				
				if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
					$_SESSION['shopping_cart'][$count] = array
					(
					'id' => filter_input(INPUT_GET, 'id'),
					'name' => filter_input(INPUT_POST, 'name'),
					'price' => filter_input(INPUT_POST, 'price'),
					'quantity' => filter_input(INPUT_POST, 'quantity')
					);
				}
				else{
					for($i = 0; $i < count($product_ids); $i++){
						if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
							$_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
						}
					}
				}
			}
			else{ 
				$_SESSION['shopping_cart'][0] = array
				(
					'id' => filter_input(INPUT_GET, 'id'),
					'name' => filter_input(INPUT_POST, 'name'),
					'price' => filter_input(INPUT_POST, 'price'),
					'quantity' => filter_input(INPUT_POST, 'quantity')
				);
			}
		}

		if(filter_input(INPUT_GET, 'action') == 'delete'){
			foreach($_SESSION['shopping_cart'] as $key => $product){
				if($product['id'] == filter_input(INPUT_GET, 'id')){
					unset($_SESSION['shopping_cart'][$key]); 
				}
			}
		}
    ?>

    <?php include('includes/header.php'); ?>

    <div class="container">
        <main>
            <div class="menuSelection">
                <?php 
                    $sql = "SELECT * FROM tbl_category ORDER BY tbl_category.id ASC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $category_id = $row['id'];
                            $category_title = $row['title'];
                ?>

                <div class="table-container">
                    <h1 class="productName" id="<?php echo $category_title;?>"><?php echo $category_title; ?></h1>

                    <?php
                        $sql2 = "SELECT * FROM tbl_product WHERE category_id = $category_id AND active = 'Yes'";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);

                        if($count2 > 0){
                        while($row2 = mysqli_fetch_assoc($res2)){
                            // $prod_id = $row2['id'];
                            // $prod_title = $row2['title'];
                            // $prod_price = $row2['price'];
                            $image_name = $row2['image_name'];
                    ?>	

                    <div>									

                        <form class="product-container" method="POST" action = "<?php echo SITEURL; ?>menu.php?action=add&id=<?php echo $row2['id']; ?>" id="addtocart">
                            <div class="tableProduct" id= "<?php echo $row2['id']; ?>">
                    
                                <?php 
                                if($image_name == "")
                                echo "<div style='color:red;'>No Image Available</div>";
                                else{//tinanggal ko muna yung a href ng image di ko kasi alam para saan
                                ?>
                                <img class="productLogo" src="<?php echo SITEURL; ?>img/<?php echo $image_name;?>" >
                                <?php } ?>
                            </div>
                            <div class="product-name"><?php echo $row2['title']; ?></div>
                            <div class="product-description"><?php echo $row2['description']; ?></div>
                            <div class="product-price">₱<?php echo $row2['price']; ?></div>
                            <div class="product-quantity"><input type ="number" name="quantity" class = "form-control-numbers" value="0" min="1"/></div>
                            <div class="add-product">
                            <input type = "hidden" name = "name" value = "<?php echo $row2['title']; ?>">
                            <input type = "hidden" name = "price" value = "<?php echo $row2['price']; ?>">
                            <input type = "submit" name = "add_to_cart" value = "Add to Cart" class = 'cart-button'></input>
                            </div>								
                        </form>
                    </div>                                    
                    <?php
                            }
                        }
                        else {
                            echo "<div style='color:red;'>No Product Available</div>";
                        }
                    ?>
                </div>
                <?php
                    }
                }
                else {
                    echo "<div style='color:red;'>No Category Available</div>";
                    }
                ?>
            </div>
        </main>

        <div class="sidebarLeft">
            <div class="sideBarMenu">
                <ul>
					<?php 
						$sql3 = "SELECT * FROM tbl_category ORDER BY tbl_category.id ASC";
						$res3 = mysqli_query($conn, $sql3);
						$count3 = mysqli_num_rows($res3);
						
						if($count3 > 0 ){
							while($row3 = mysqli_fetch_assoc($res3)){
								$category_title = $row3['title'];
								?>
								<a href="#<?php echo $category_title; ?>"><li class="sideBarOptions textColorWhite"><?php echo $category_title; ?></li></a>
								<?php
							}
						}
						else{
							echo "<div style='color:red;'>No Categories Available</div>";
						}
					?>

                </ul>
            </div>
        </div>

        <a href="order/cart.php">
            <div class="cart">
                <i class="fas fa-shopping-cart"></i> 
                <span id="cart-item" class=""></span>
            </div>
		</a>

        <div class="preload">
            <div class="header">
                <button class="header__button" id="btnNav" type="button">
                    <i class="material-icons">restaurant_menu</i>
                </button>
            </div>
            <div class="nav">
                <div class="nav__links">
                    <?php //create sql to get category titles 
						$sql3 = "SELECT * FROM tbl_category ORDER BY tbl_category.id ASC";
						$res3 = mysqli_query($conn, $sql3);
						$count3 = mysqli_num_rows($res3);
						
						if($count3 > 0 ){
							while($row3 = mysqli_fetch_assoc($res3)){
								$category_title = $row3['title'];
								?>
								<a href="#<?php echo $category_title; ?>"><li class="nav__link"><?php echo $category_title; ?></li></a>
								<?php
							}
						}
						else{
							echo "<div style='color:red;'>No Categories Available</div>";
						}
					?>
                </div>
                <div class="nav__overlay"></div>
            </div>
            <script src="scripts/sidebar.js"></script>
        </div>
        <script src="scripts/addTocart.js"></script>
        <footer>Online Marketplace</footer> 
    </div>
</body>