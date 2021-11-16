<?php include('../../includes/constants.php'); ?>
<?php
	if (isset($_SESSION["username"])){

	}
	else{
		header("location: ../../index.php");
		exit();
	}
?>
<head>
    <link rel="stylesheet" href="../../styles/logInSubFunc.css">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <h2>Reset your password</h2>
            <p>An e-mail will be send to you with instructions on how to reset your password.</p>

            <form action = "../../includes/resetReq.inc.php" method = "POST">

                <input type = "text" name = "frgtEmail" placeholder = "Enter your email address..."><br><br>
                   
                <button type = "submit" name = "sbmtForgot">RECEIVE NEW PASSWORD BY MAIL</button>
            </form><br>

            <?php
                if (isset($_GET["reset"])){
                    if ($_GET["reset"] == "success")
                    {
                        echo "<p>Check your e-mail account!</p>";
                    }
                }
            ?>

            <button><a href="logIn.php">Back</a></button>
        </div>
    </div>
</body>
</html>

