<?php

if (isset($_POST["sbmtSignUp"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["passwrd"];
    $rePwd = $_POST["repasswrd"];

    require_once('constants.php');
    require_once('functions.inc.php');
    
    if (emptyInputSignUp($name, $email, $pwd, $rePwd) !== false)
    {
        header("location: ../admin/logInFunc/error.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !== false)
    {
        header("location: ../admin/logInFunc/error.php?error=invalidEmail");
        exit();
    }

    if (pwdMatch($pwd, $rePwd) !== false)
    {
        header("location: ../admin/logInFunc/error.php?error=passwordMisMatch");
        exit();
    }

    if (UidExist($conn, $name ,$email) !== false)
    {
        header("location: ../admin/logInFunc/error.php?error=NameTaken");
        exit();
    }

    createUser($conn, $name, $email, $pwd);
}
else{
    header("location: ../admin/logInFunc/logIn.php");
    exit();
}