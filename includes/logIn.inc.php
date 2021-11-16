<?php
if (isset($_POST["sbmtLogIn"])){
    $uNE = $_POST["usr_mail"];
    $pwd = $_POST["pwd"];

    require_once('constants.php');
    require_once('functions.inc.php');

    if (emptyInputLogIn($uNE, $pwd) !== false)
    {
        header("location: ../admin/logInFunc/error.php?error=emptyinput");
        exit();
    }

    logInUser($conn, $uNE, $pwd);
}
else 
{
    header("location: ../admin/logInFunc/logIn.php");
    exit();
}