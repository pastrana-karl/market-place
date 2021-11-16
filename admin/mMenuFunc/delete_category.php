<?php 
	include('../../includes/constants.php');
	//Get ID of admin to be deleted
	$id = $_GET['id'];

// Create Query to Delete Admin 
	$sql = "DELETE FROM tbl_category WHERE id=$id";

//Run query
	$res = mysqli_query($conn, $sql);
	
//Check if query successful
	if($res == TRUE){
		//echo "SUCCESS";
//Session variable for message
		$_SESSION['delete'] = "<div class='success'>Category Deleted</div>";
		header('location:'.SITEURL.'admin/manage_category.php');
	
	}
	else {	
		
		$_SESSION['delete'] = "<div class='error'>Category Not Deleted</div>";
		header('location:'.SITEURL.'admin/manage_category.php');
	}

?>