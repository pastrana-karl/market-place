<?php 
	include('../includes/constants.php'); 
	include('../includes/adminheader.php'); 
?>
<link rel="stylesheet" href="../styles/managehome.css">
<head>
	<title>Marketplace Administration</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>
	
<body>
	<?php
	if (isset($_SESSION["usersName"])){

	}
	else{
		header("location: ../index.php");
		exit();
	}
	?>
	<div class="welcome">
		<h1>Welcome To The Administrator Page</h1>
	</div>

	<br><br>

	<div class="row">
		<div class="column">
			<div class="card">
				<h2>Categories</h2>
				<?php 
				$sql = "SELECT * FROM tbl_category";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				?>
				<h4>Numbers: <?php echo $count; ?></h4>
			</div>
		</div>

		<div class="column">
			<div class="card">
				<h2>Products</h2>
				<?php 
					$sql2 = "SELECT * FROM tbl_product";
					$res2 = mysqli_query($conn, $sql2);
					$count2 = mysqli_num_rows($res2);

					$sqla = "SELECT * FROM tbl_product WHERE active = 'Yes'";
					$resa = mysqli_query($conn, $sqla);
					$counta = mysqli_num_rows($resa);

					$sqlf = "SELECT * FROM tbl_product WHERE featured = 'Yes'";
					$resf = mysqli_query($conn, $sqlf);
					$countf = mysqli_num_rows($resf);
				?>
				<h4>Numbers: <?php echo $count2; ?></h4>
				<h4>Featured: <?php echo $countf; ?></h4>
				<h4>Active: <?php echo $counta; ?></h4>
			</div>
		</div>

		<div class="column">
			<div class="card">
			<h2>Orders</h2>
			<?php 
				$sqlo = "SELECT * FROM tbl_order";
				$reso = mysqli_query($conn, $sqlo);
				$counto = mysqli_num_rows($reso);
				
				$sqlp = "SELECT * FROM tbl_order WHERE order_status = 'Pending'";
				$resp = mysqli_query($conn, $sqlp);
				$countp = mysqli_num_rows($resp);
				
				$sqlc = "SELECT * FROM tbl_order WHERE order_status = 'Catering'";
				$resc = mysqli_query($conn, $sqlc);
				$countc = mysqli_num_rows($resc);
				
				$sqlp = "SELECT * FROM tbl_order WHERE order_status = 'Pending'";
				$resp = mysqli_query($conn, $sqlp);
				$countp = mysqli_num_rows($resp);
				
				$sqldg = "SELECT * FROM tbl_order WHERE order_status = 'Delivering'";
				$resdg = mysqli_query($conn, $sqldg);
				$countdg = mysqli_num_rows($resdg);
				
				$sqldd = "SELECT * FROM tbl_order WHERE order_status = 'Delivered'";
				$resdd = mysqli_query($conn, $sqldd);
				$countdd = mysqli_num_rows($resdd);
				
				$sqlcd = "SELECT * FROM tbl_order WHERE order_status = 'Cancelled'";
				$rescd = mysqli_query($conn, $sqlcd);
				$countcd = mysqli_num_rows($rescd);
			?>
			<h4>Numbers: <?php echo $counto; ?></p>
			<h4>Pending: <?php echo $countp; ?></h4>
			<h4>Catering: <?php echo $countc; ?></h4>
			<h4>Delivering: <?php echo $countdg; ?></h4>
			<h4>Delivered: <?php echo $countdd; ?></h4>
			<h4>Cancelled: <?php echo $countcd; ?></h4>
			</div>
		</div>

		

	</div>
</body>