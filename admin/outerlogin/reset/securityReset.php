<head>
    <link rel="stylesheet" href="../../../styles/logInSubFunc.css">
    <title>Reset Password</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">

            <?php
                $selector = $_GET["selector"];
                $validator = $_GET["validator"];

                if (empty($selector) || empty($validator)){
                    echo "Could not validate your request!!";
                }
                else {
                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false)
                {
            ?>

            <form action = "secResPass.php" method = "post">

                <input type = 'hidden' name = 'selector' value = "<?php echo $selector; ?>">
                <input type = 'hidden' name = 'validator' value = "<?php echo $validator; ?>">

                <input type = "password" name = "newPass" placeholder = "Enter new password..."><br><br>
                <input type = "password" name = "reNewPass" placeholder = "Repeat new password..."><br><br>
                <button type = "submit" name = "sbmtReset">RESET PASSWORD</button>
            </form>
                
            <?php
                    }    
                }
            ?>
        </div>
    </div>
</body>
