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
	<title>Manage Category</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
	<link rel="stylesheet" href="../styles/manage.css">
</head>


<div class="maincontent">
	<div class="wrapper">
		<h1> Manage Category </h1><br>
	
		<div class="column">
			<div class="card">
			<h3>Add Category</h3>
			<?php 
				if(isset($_SESSION['add'])) {
					echo $_SESSION['add']; // display session message
					unset($_SESSION['add']); //removing session message
				}
			?>
			<br>
				<form action="" method="POST">
					<table class="tbl-full">
						<tr>
							<td>Category Name: </td>
							<td><input type="text" name="title" required></td>
							<td>
								<input type="reset" value="Cancel" class="btn-tertiary">
								<input type="submit" name="AddCategory" value="Add Category" class="btn-secondary">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<?php
			//process value from form and save in database
			//check whether buttons are clicked or not
			if(isset($_POST['AddCategory'])){
				
				//get data from form
				$title = $_POST['title'];
			
				
				//query to save data into database left side is name on table made in database columns
				$sql = "INSERT INTO tbl_category SET
					title = '$title'";
					
				//TO see if query is working
				//echo $sql;
				
				
				// Run query to save data into database
				$res = mysqli_query($conn, $sql) or die(mysqli_error());
				
				//Checking if data is inserted or not
				if($res == TRUE){
					//echo 'IT WORKS MOTHERFUCKER';
					
					//Create session variable to Display Message
					$_SESSION['add'] = "<div class = 'success'>Category Added Successfully</div>";
					
					//Redirect to manage admin
					header("location:".SITEURL.'admin/manage_category.php');
				}
				else {
					//echo 'PIECE OF SHIT';
					//Create session variable to Display Message
					$_SESSION['add'] = "<div class = 'error'>Failed to Add Category</div>";
					
					//Redirect to manage admin
					header("location:".SITEURL.'admin/manage_category.php');
				}
			}
		?>
		<div class="column">
			<div class="card">
				<h3>View/Update/Delete Category</h3>
				<?php 
					if(isset($_SESSION['delete'])) {
						echo $_SESSION['delete']; // display session message
						unset($_SESSION['delete']); //removing session message
					}
					if(isset($_SESSION['update'])) {
						echo $_SESSION['update']; // display session message
						unset($_SESSION['update']); //removing session message
					}
				?>
				<br>
				<table class="tbl-full">
					<tr>
						<th>Category Name</th>
						<th>Options</th>
					</tr>
						
					<?php
						//query to get admin from db
						$sqla = "SELECT * FROM tbl_category ORDER BY tbl_category.title ASC";
						
						//execute query
						$resa = mysqli_query($conn, $sqla);
						
						//check if query is executed
						if($resa == TRUE) {
							//Count Rows to check for data
							$count = mysqli_num_rows($resa); //function to get all rows
							//Check the num of rows
							if($count > 0) {
								//have rows
								
								//use while loop to get all data
								while($rows = mysqli_fetch_assoc($resa)){
									//get indiv data on the right is coumn names
									$id = $rows['id'];
									$category_name = $rows['title'];
									
									//display vals in table
								?>
								<tr>
									<td><?php echo $category_name; ?></th>
									<td>
										<a href="<?php echo SITEURL; ?>admin/mMenuFunc/update_category.php?id=<?php echo $id; ?>" ><button class="btn-secondary">Update</button></a> 
										<a href="<?php echo SITEURL; ?>admin/mMenuFunc/delete_category.php?id=<?php echo $id; ?>" ><button class="btn-tertiary">Delete</button></a>
									</td>
								</tr>
					
							<?php
								}
							}
							else {
								?>
								<tr>
									<td colspan="6"><div class="error">No Category Found</div></td>
								</tr>
								<?php
							}
						}
					?>
				</table>
			</div>
		</div>
	</div>
</div>
