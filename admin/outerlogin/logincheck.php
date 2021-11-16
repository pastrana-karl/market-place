<?php
require_once('../../includes/constants.php');

if(isset($_POST['but_submit'])) {

    $uname = mysqli_real_escape_string($conn,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($conn,$_POST['txt_pwd']);

    function exist($conn, $uname){
        $sql = "SELECT * FROM securitylog WHERE username = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: loginerror.php?error=stmtFailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    if ($uname != "" && $password != ""){
        $Exist = exist($conn, $uname);

        if ($Exist === false){
            header("location: loginerror.php?error=wrongLogIn");
            exit();
        }

        $pwdHashed = $Exist["password"];
        $checkPwd = password_verify($password, $pwdHashed);

        if ($checkPwd === false){
            header("location: loginerror.php?error=wrongPassword");
            exit();
        }
        elseif ($checkPwd === true){
            if(!isset($_SESSION)) { 
                session_start(); 
            } 

            $_SESSION["username"] = $Exist["username"];

            //User logIn url
            header("location: ../logInFunc/logIn.php");
            exit();
        }
    }
}
else
{
    header("location: securitylogin.php");
    exit();
}