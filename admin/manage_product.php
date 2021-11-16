<?php 
	include('../includes/constants.php'); 
	include('../includes/adminheader.php'); 
?>
<?php
	if (isset($_SESSION["usersName"])){

	}
	else{
		header("location: ../index.php");
		exit();
	}
?>

<head>
	<title>Manage Product</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
	<link rel="stylesheet" href="../styles/manage.css">
</head>

<div class="maincontent">
	<div class="wrapper">
		<h1> Manage Product </h1>
		<br>
		<div class="column">
			<div class="card">
				<h3>Add Product</h3>
				<?php
					
					if(isset($_SESSION['add'])){
						echo $_SESSION['add'];
						unset($_SESSION['add']);
					}
				?>
				
				<form action="" method="POST" enctype="multipart/form-data">
					<table class="tbl-full">
						<tr>
							<td>Product Name</td>
							<td><input type="text" name="title" placeholder="Product Name" required></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><input type="text"  maxlength='50' name="desc" placeholder="Brief Description"></td>
						</tr>
						<tr>
							<td>Price</td>
							<td>
								<input type="number" name="price" min="1" placeholder="₱1,000,000.00" required>
							</td>
						</tr>
						<tr>
							<td>Select Image</td>
							<td><input type="file" name="image"></td>
						</tr>
						<tr>
							<td>Category</td>
							<td>
								<select name="category">
									<?php 
										//Get Categories from tbl_category
										$sql = "SELECT * FROM tbl_category ORDER BY tbl_category.title ASC";
										$res = mysqli_query($conn, $sql);
										
										//count rows to find if have categories
										$count = mysqli_num_rows($res);
										
										//if count > 0 categories available
										if($count > 0){
											while($row = mysqli_fetch_assoc($res)){
												//get details of category
												$id = $row['id'];
												$title = $row['title'];
												?>
												<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
												<?php
											}
										}
										else{
											?>
											<option value="0">No Category Available</option>
											<?php
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Featured:</td>
							<td>
								<input type="checkbox" name="featured">
								
							</td>
						</tr>
						<tr>
							<td>Active:</td>
							<td>
								<input type="checkbox" name="active">
								
							</td>
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								<input type="reset" class="btn-tertiary" value="Cancel">
								<input type="submit" name="submit" class="btn-secondary" value="Add Product">
							</td>
						</tr>
					</table>
				</form>	
			</div>
		</div>
	</div>
		<?php 
			if(isset($_POST['submit'])){
				//echo "Clicked";
				
				//get data from form
				$title = $_POST['title'];
				$price = $_POST['price'];
				$category = $_POST['category'];
				$desc = $_POST['desc'];

				//check if radio is chechked or not
				if(isset($_POST['featured'])){
					$featured = "Yes";
				}
				else{
					$featured = "No";
				}
				if(isset($_POST['active'])){
					$active = "Yes";
				}
				else{
					$active = "No";
				}
				
				
				//check if select image is clicked then upload only if image is selected
				if(isset($_FILES['image']['name'])){
					//get details
					$image_name = $_FILES['image']['name'];
					
					//check whether image is selected
					if($image_name!=""){
						//image is selected
						//Rename
						//Get extension 
						$ext = end(explode('.',$image_name));
						//create new name
						$image_name = "Product-".rand(0000,9999).".".$ext;
						//Upload
						//get soruce and destination
						//source is current location, destination is target folder
						$src = $_FILES['image']['tmp_name'];
						$dst ="../img/".$image_name;
						
						$upload = move_uploaded_file($src, $dst);
						
						//check img uploaded
						if($upload == False){
							//failed to upload
							$_SESSION['imgupload'] = "<div class='error'>Failed to upload Image</div>";
							header('location'.SITEURL.'admin/manage_product.php');
							die();
						}
					}
				}
				else {
					$image_name = "";
				}
				//insert into database
				//query 
				$sql2 = "INSERT INTO tbl_product SET 
					title ='$title',
					price = $price,
					image_name = '$image_name',
					category_id = $category,
					description ='$desc',
					featured = '$featured',
					active = '$active'
				";
				
				//execute
				$res2 = mysqli_query($conn, $sql2);
				
				//check whether data is inserted
				if($res2 == true){
					//data inserted
					$_SESSION['add'] = "<div class ='success'>Product Added</div>";
					header('location:'.SITEURL.'admin/manage_product.php');
				}
				else{
					$_SESSION['add'] = "<div class ='error'>Product Not Added</div>";
					header('location:'.SITEURL.'admin/manage_product.php');
				}
			}
		?>
			
		
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		
				
		<div class="card">
			<h3>View/Update/Delete Product</h3>
			<?php
				if(isset($_SESSION['imgupload'])){
					echo $_SESSION['imgupload'];
					unset($_SESSION['imgupload']);
				}
				if(isset($_SESSION['unauthorized'])){
					echo $_SESSION['unauthorized'];
					unset($_SESSION['unauthorized']);
				}
				if(isset($_SESSION['delete'])){
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}
				if(isset($_SESSION['remove-failed'])){
					echo $_SESSION['remove-failed'];
					unset($_SESSION['remove-failed']);
				}
				if(isset($_SESSION['update'])){
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}
			?>
			<table class="tbl-full">
				<tr>
					<th>Product</th>
					<th>Description</th>
					<th>Category</th>
					<th>Pricing</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Options</th>
				</tr>
				<?php 
					//query to get data 
					$sql3 = "SELECT * FROM tbl_product ORDER BY tbl_product.title ASC";
					$res3 = mysqli_query($conn, $sql3);
					
					$counta = mysqli_num_rows($res3);
					if($counta > 0){
						//get product then display
						while($row = mysqli_fetch_assoc($res3)){
							//get value from columns
							$id = $row['id'];
							$title = $row['title'];
							$category_num = $row['category_id'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];
							$desc = $row['description'];

							$sql4 = "SELECT * FROM tbl_category WHERE $category_num = id";
							$res4 = mysqli_query($conn, $sql4);
							$count2 = mysqli_num_rows($res4);
							
							if($count2 > 0 ){
								while($row2 = mysqli_fetch_assoc($res4)){
									$catname = $row2['title'];
								?>
								
							<tr>
								<td><?php echo $title; ?></td>
								<td><?php echo $desc; ?></td>
								<td><?php echo $catname; ?></td>
								<td>₱<?php echo $price; ?></td>
								<td>
									<?php
										if($image_name ==""){
											//No Image
											echo "<div class ='error'>No Image</div>";
											
										}
										else {
											//Img Available
											?>
											<img src="<?php echo SITEURL;?>img/<?php echo $image_name; ?>" width ="60px">
											<?php
										}
									?>
								</td>
								<td><?php echo $featured; ?></td>
								<td><?php echo $active; ?></td>
								<td colspan="2">
									<a href="<?php echo SITEURL;?>admin/mMenuFunc/update_product.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
								
									<a href="<?php echo SITEURL;?>admin/mMenuFunc/delete_product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-tertiary">Delete</a> 	
								</td>
							</tr>
								
								<?php
								
								
								}
							}
							
						}
					}
					else{
						//no product in db
						echo "<tr><td colspan='7' class='error'>No Product Yet</td></tr>";
					}
				?>

			</table>
		</div>
	</div>
</div>

