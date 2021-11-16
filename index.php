<?php include('includes/constants.php'); ?>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href="styles/index.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Online Marketplace</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>

<body>
    <script src="scripts/unload.js"></script>
    <?php include('includes/header.php'); ?>

    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://miro.medium.com/max/1400/0*Cnrh1I4837nka_7I.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://fullstop360.com/blog/wp-content/uploads/2020/12/What-is-Merchandise-Branding_.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.chaindrugreview.com/app/uploads/2015/08/TSE-2015-Product-Showcase_featured.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.westend61.de/images/0001562773pw/fresh-merchandise-food-in-display-at-retail-store-PNAF01634.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        
        <a class="carousel-control-prev" href="#homeCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#homeCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <div class="mustTry2">
        <p>
            <?php
                if(isset($_SESSION['completion']))
                {
                    echo $_SESSION['completion'];
                    unset($_SESSION['completion']);
                }
                if(isset($_SESSION['order']))
                {
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                }
                if(isset($_SESSION['delivery']))
                {
                    echo $_SESSION['delivery'];
                    unset($_SESSION['delivery']);
                }
                if(isset($_SESSION['back']))
                {
                    echo $_SESSION['back'];
                    unset($_SESSION['back']);
                }
                if(isset($_SESSION['test'])){
                    echo $_SESSION['test'];
                    unset($_SESSION['test']);
                }
            ?>
          </p>
      </div>

    <section class="categories">
        <div class="container">
            <div class="mustTry">
                <h1>Look Out For These <span>Products</span></h1>
            </div>
			<?php //sql to tbl_product where featured = 'yes'
				$sql = "SELECT * FROM tbl_product WHERE featured = 'Yes'";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				
				if($count > 0){
					while($row = mysqli_fetch_assoc($res)){
						$category_id = $row['id'];
						$prod_title = $row['title'];
						$image_name = $row['image_name'];
						?>
						<a href="<?php echo SITEURL; ?>menu.php#<?php echo $category_id; ?>" id="popular">
							<div class="box-3 float-container">
								<?php 
									if($image_name ==""){
										echo "<div style='color:red;'>No Image Available</div>";
									}
									else{
										?>
										<img src="<?php echo SITEURL; ?>img/<?php echo $image_name?>" alt="<?php echo $prod_title; ?>" class="img-responsive img-curve">

										<?php
									}
								?>
								<h3 class="float-text text-white"><?php echo $prod_title; ?></h3>
							</div>
						</a>
						<?php
					}
				}
				else{
					echo "<div style='color:red;'> No Featured Product</div>";
				}
			?>
            <div class="clearfix"></div>
        </div>
    </section>

    <section class="food-menu">
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>menu.php">See All Products</a>
        </p>
    </section>

    <?php include('./includes/footer.php'); ?>
</body>

