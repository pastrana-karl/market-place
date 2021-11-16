<head>
    <link rel="stylesheet" href="../../css/securitylogin.css">
    <title>Marketplace Authentication</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>
<body>
    <div class="vertical-center">
        <div class="container">
            <form method="post" action="logincheck.php">
                <div id="div_login">
                    <h1>Security Check</h1>
                    <div>
                        <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" required/>
                    </div>
                    <div>
                        <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password" required/>
                    </div>
                    <div class = "btn" style = 'text-align:center;'>
                        <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                    </div>
                    <div style = 'text-align:center;'>
                        <a href="reqReset/securityForgot.php">Forgot your password?</a>
                    </div>
                    <div style = 'text-align:center;'>
                        <?php
                            if (isset($_GET["newPwd"]))
                            {
                                if ($_GET["newPwd"] == "passwordUpdated")
                                {
                                    echo "<p>Your password has been reset!</p>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>