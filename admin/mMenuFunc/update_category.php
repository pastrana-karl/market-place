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
	//get the id of selected admin
	$id = $_GET['id'];
	
	
	//query to get data
	$sql = "SELECT * FROM tbl_category WHERE id=$id";
	
	//run query
	$res=mysqli_query($conn, $sql);
	
	//check if query runs
	if($res==TRUE) {
		$count = mysqli_num_rows($res); //check if data available
		if($count==1){ //check if have data
			//echo "Admin Available";
			$row = mysqli_fetch_assoc($res);
			$oldcategory_name = $row['title'];
			$category_name = $row['title'];
		}
		else {
			//redirect to admin page
			header('location:'.SITEURL.'admin/manage_category.php');
		}
	}
?>
<head>
	<title>Update Category</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
	<link rel="stylesheet" href="../../styles/manage.css">
</head>

<div class ="maincontent">
	<div class="wrapper">
		<div class="column">
			<div class="card">
				<h2>Update Category</h2>
				
				<form action="" method = "POST">
					<table class ="tbl-full">
						<tr>
							<td>Current Category Name: </td>
							<td><?php echo $category_name; ?></td>
						</tr>
						<tr>
							<td>New Category Name: </span></td>
							<td>
								<input type="text" name ="newcatname">
							</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2">
								<input type ="hidden" name ="id" value = "<?php echo $id?>">
								<input type="submit" name = "submit" value = "Update" class="btn-secondary">
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
		header('location:'.SITEURL.'admin/manage_category.php');
	}
	if(isset($_POST['submit'])) {
		//echo "Clicked Button";
		
		//get all values from form to update
		
		$id = $_POST['id'];
		$newcatname = $_POST['newcatname'];
		if($newcatname == ""){
			$newcatname = $oldcategory_name;
		}
		
		//query to update admin Left Side Database column name right side is variable name 
		$sql = "UPDATE tbl_category SET
		title='$newcatname' WHERE id='$id'";
		
		//run query 
		$res = mysqli_query($conn, $sql);
		
		//checking
		if($res==TRUE) {
			$_SESSION['update'] = "<div class='success'> Update Successful</div>";
			//redirect to admin page
			header('location:'.SITEURL.'admin/manage_category.php');
		}
		else {
			$_SESSION['update'] = "<div class='error'> Update Failed</div>";
			//redirect to admin page
			header('location:'.SITEURL.'admin/manage_category.php');
		}
	}
?>
	
			
		