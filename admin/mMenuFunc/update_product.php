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
	//check if id is set 
	if(isset($_GET['id'])){
		//get data
		$id = $_GET['id'];
		//sql to get all data from selected product
		$sql2 = "SELECT * FROM tbl_product WHERE id = $id";
		
		//run query
		$res2 = mysqli_query($conn, $sql2);
		
		$row2 = mysqli_fetch_assoc($res2);
		
		//get individual values
		$oldtitle = $row2['title'];
		$oldprice = $row2['price'];
		$olddesc = $row2['description'];
		$current_image = $row2['image_name'];
		$current_category = $row2['category_id'];
		$featured = $row2['featured'];
		$active = $row2['active'];
	}
	else{
		//redirect to Manage product
		header('location:'.SITEURL.'admin/manage_product.php');
	}
?>

<head>
	<title>Update Product</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
	<link rel="stylesheet" href="../../styles/manage.css">
</head>

<div class ="maincontent">
	<div class="wrapper">
		<div class="column">
			<div class="card">
				<h2>Update Product</h2>
				<form action="" method="POST" enctype="multipart/form-data">
					<table class="tbl-full">
						<tr>
							<td>Current Product Name: </td>
							<td><?php echo $oldtitle; ?></td>
						</tr>
						<tr>
							<td>New Product Name: </td>
							<td><input type="text" name="title" placeholder="Product Name"></td>
						</tr>
						<tr>
                            <td>Current Description: </td>
                            <td><?php echo $olddesc; ?></td>
                        </tr>
                        <tr>
                            <td>New Description: </td>
                            <td><input type="text" name="desc" maxlength='50' placeholder="Brief Description"></td>
                        </tr>
						<tr>
							<td>Current Price: </td>
							<td>₱ <?php echo $oldprice; ?></td>
						</tr>
						<tr>
							<td>Price: </td>
							<td><input type="number" name="price" min = "1" placeholder="₱1,000,000.00"></td>
						</tr>
						<tr>
							<td>Current Image</td>
							<td>
								<?php 
									if($current_image == ""){
										//image not available
										echo "<div class='error'>Image Not Available</div>";
									}
									else{
										//Image Available
										?>
										<img src="<?php echo SITEURL; ?>img/<?php echo $current_image; ?>" alt ="<?php echo $current_image?>" width = "100px">
										<?php
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Select New Image</td>
							<td>
								<input type="file" name="image">
							</td>
						</tr>
						<tr>
							<td>Category</td>
							<td>
								<select name="category">
									<?php 
										$sql = "SELECT * FROM tbl_category";
										$res = mysqli_query($conn, $sql);
										
										$count = mysqli_num_rows($res);
										
										//check if category is available
										if($count > 0){
											while($row = mysqli_fetch_assoc($res)){
												$category_title = $row['title'];
												$category_id = $row['id'];
												//echo "<option value='$category_id'>$category_title</option>";
												?>
													<option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id?>"><?php echo $category_title; ?></option>
												<?php 
											}
										}
										else{
											?>
												<option value="0">No Category</option>
											<?php
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Featured</td>
							<td><input <?php if($featured =="Yes"){ echo "checked";}?> type="checkbox" name="featured"></td>
						</tr>
						<tr>
							<td>Active</td>
							<td><input <?php if($active =="Yes"){ echo "checked";}?> type="checkbox" name="active"></td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
								<input type="submit" name="submit" value ="Update Product" class="btn-secondary">
								<input type="submit" name = "cancel" value = "Cancel" class="btn-tertiary">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>	
		<?php
			if(isset($_POST['cancel'])){
				header('location:'.SITEURL.'admin/manage_product.php');
			}
			if(isset($_POST['submit'])){
				//echo "Clicked";
				
				//get all details
				$id = $_POST['id'];
				$title = $_POST['title'];
				$price = $_POST['price'];
				$current_image = $_POST['current_image'];
				$desc = $_POST['desc'];
				$category = $_POST['category'];
				
				if($title == ""){
					$title = $oldtitle;
				}
				if($desc == ""){
                    $desc = $olddesc;
                }
				if($price == ""){
					$price = $oldprice;
				}
				
				
				
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

				//upload image if selected
				//check if upload button is clieked
				if(isset($_FILES['image']['name'])){
					$image_name = $_FILES['image']['name']; //new image name
					
					//check if there is a file after clicking
					if($image_name !=""){
						//available uploading new Image
						
						//rename
						$ext = end(explode('.', $image_name));
						$image_name = "Product-".rand(0000, 9999).'.'.$ext; //new renamed name
						
						//get src and dst
						$src = $_FILES['image']['tmp_name'];
						$dst = "../../img/".$image_name;
						
						//upload image
						$upload = move_uploaded_file($src, $dst);
						
						//check if image uploaded
						if($upload == False){
							//failed
							$_SESSION['upload'] = "<div class = 'error'>Failed to Upload New Image</div>";
							header('location:'.SITEURL.'admin/manage_product.php');
							die();
						}
						
						//remove current image if available
						if($current_image != ""){
							//there is an image already. remove it
							$remove_path = "../../img/".$current_image;
							
							$remove = unlink($remove_path);
							
							//check if img is removed
							if($remove == False){
								//failed to remove
								$_SESSION['remove-failed'] = "<div class = 'error'>Failed to Upload New Image</div>";
								header('location:'.SITEURL.'admin/manage_product.php');
								die();
							}
						}
					}
					else{
						$image_name = $current_image;
					}
				}
				else{
					$image_name = $current_image;
				}
				
				
				//update product in database
				$sql3 = "UPDATE tbl_product SET
					title = '$title',
					price = $price,
					image_name = '$image_name',
					category_id = '$category',
					description = '$desc',
					featured = '$featured',
					active = '$active'
					WHERE id = $id
				";
				
				$res3 = mysqli_query($conn, $sql3);
				
				//check if query is successful
				if($res3 == True){
					//product updated
					$_SESSION['update'] = "<div class = 'success'>Product Updated</div>";
					header('location:'.SITEURL.'admin/manage_product.php');
				}
				else{
					$_SESSION['update'] = "<div class = 'error'>Update Failed</div>";
					header('location:'.SITEURL.'admin/manage_product.php');
				}
			}
		?>
		
