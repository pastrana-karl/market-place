<?php 
	include('../../includes/constants.php');


	if(isset($_GET['id']) AND isset($_GET['image_name'])){
		//delete
		//echo "Process to Delete";
		
		//get id and img name
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
		
		
		//remove image if available
		//check if there is an image
		if($image_name != ""){
			//has image
			//get image pathinfo
			$path = "../../img/".$image_name;
			
			//remove file from folder
			$remove = unlink($path);
			
			//check if removal successful
			if($remove == False){
				//failed to remove
				$_SESSION['imgupload'] = "<div class='error'>Failed to Remove Image</div>";
				header('location:'.SITEURL.'admin/manage_product.php');
				die();
			}
		}
		
		
		//delete product from database
		$sql = "DELETE FROM tbl_product WHERE id=$id";
		$res = mysqli_query($conn, $sql);
		
		//check if query successful
		if($res == True){
			//product deleted
			$_SESSION['delete'] = "<div class='success'>Product Deleted</div>";
			header('location:'.SITEURL.'admin/manage_product.php');
		}
		else{
			//failed to delete product
			$_SESSION['delete'] = "<div class='error'>Product Not Deleted</div>";
			header('location:'.SITEURL.'admin/manage_product.php');
		}
		
	}
	else{
		//redirect to manage product
		//echo "Redirect";
		$_SESSION['unauthorized'] = "<div class = 'error'>Unauthorized Access</div>";
		header('location:'.SITEURL.'admin/manage_product.php');
	}
	
?>