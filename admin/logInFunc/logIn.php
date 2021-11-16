<?php 
	include('../../includes/constants.php'); 

	if (isset($_SESSION["username"])){

	}
	else{
		header("location: ../../index.php");
		exit();
	}
?>

<head>
    <link rel="stylesheet" href="../../styles/login.css">
	<title>Online Marketplace Administrator Page</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>

<body>
	<h2>Administrator Login Page</h2><br>

	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="../../includes/signUp.inc.php" method="POST">	
				<h2>Welcome New Administrator</h2>
				<br>
				<input type="text" name="name" placeholder="Full Name..." required>
				<input type="email" name="email" placeholder="Email..." required>
				<input type="password" name="passwrd" placeholder="Password..." required>
				<input type="password" name="repasswrd" placeholder="Confirm Password..." required>
				<br>
				<button type="submit" name="sbmtSignUp">Sign Up</button>
			</form><br>
		</div>

		<div class="form-container sign-in-container">
			<form action="../../includes/logIn.inc.php" method="POST">
				<h2>Log In</h2>
				<br>
				<input type="email" name="usr_mail"placeholder="Email" required>
				<input type="password" name="pwd" placeholder="Password" required>
				<a href="forgot.php">Forgot your password?</a>
				<button type="submit" name="sbmtLogIn">Sign In</button>
				<?php
					if (isset($_SESSION["username"])){
						echo "<a href='../../includes/logOut.inc.php'>Back</a>";
					}
            	?>
				<?php
					if (isset($_GET["newPwd"])){
						if ($_GET["newPwd"] == "passwordUpdated"){
							echo "<p>Your password has been reset!</p>";
						}
						
					}

					if (isset($_GET["error"])){
						if ($_GET["error"] == "none"){
							echo "<p>You have signed up!</p>";
						}
						  
					}
				?>
			</form>
		</div>

		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p style = "color: white;">Login with existing account</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello There!</h1>
					<p style = "color: white;">Sign up now and register your account</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
	<script src="../../scripts/login.js"></script>
</body>
</html>