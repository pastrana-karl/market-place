<head>
    <link rel="stylesheet" href="../../styles/logInSubFunc.css">
    <title>Authentication Error</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <?php
                if (isset($_GET["error"])){
                    if ($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all input fields!</p>";
                    }
                    elseif ($_GET["error"] == "invalidUid"){
                        echo "<p>Choose a proper username!</p>";
                    }
                    elseif ($_GET["error"] == "invalidEmail"){
                        echo "<p>Choose a proper email!</p>";
                    }
                    elseif ($_GET["error"] == "passwordMisMatch"){
                        echo "<p>Password mismatch!</p>";
                    }   
                    elseif ($_GET["error"] == "NameTaken"){
                        echo "<p>Name taken!</p>";
                    }   
                    elseif ($_GET["error"] == "stmtFailed"){
                        echo "<p>Something went wrong, try again!</p>";
                    }   
                }

                if (isset($_GET["error"])){
                    if ($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all input fields!</p>";
                    }
                    elseif ($_GET["error"] == "wrongLogIn"){
                        echo "<p>Incorrect login information!</p>";
                    }
                    elseif ($_GET["error"] == "wrongPassword")
                    {
                        echo "<p>Incorrect Password!</p>";
                    }
                }
            ?>
            <button><a href="securitylogin.php">Return</a></button>
        </div>
    </div>
</body>