<?php

// For SignUp ----------------------------------------------------------------------------------------

function emptyInputSignUp($name, $email, $pwd, $rePwd){
    $result;

    if (empty($name) || empty($email) || empty($pwd) || empty($rePwd)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function invalidEmail($email){
    $result;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function pwdMatch($pwd, $rePwd){
    $result;

    if ($pwd !== $rePwd){
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function UidExist($conn, $name, $email){
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin/logInFunc/error.php?error=stmtFailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
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

function createUser($conn, $name, $email, $pwd){
    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin/logInFunc/error.php?error=stmtFailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../admin/logInFunc/logIn.php?error=none");
    exit();
}

// For LogIn ----------------------------------------------------------------------------------------

function emptyInputLogIn($uNE, $pwd){
    $result;

    if (empty($uNE) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function logInUser($conn, $uNE, $pwd){
    $uIdExist = UidExist($conn, $uNE, $uNE);

    if ($uIdExist === false){
        header("location: ../admin/logInFunc/error.php?error=wrongLogIn");
        exit();
    }

    $pwdHashed = $uIdExist["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false){
        header("location: ../admin/logInFunc/error.php?error=wrongPassword");
        exit();
    }
    elseif ($checkPwd === true){
        session_start();

        $_SESSION["userId"] = $uIdExist["usersId"];
        $_SESSION["usersName"] = $uIdExist["usersName"];

        //User logIn url
        header("location: ../admin/home.php");
        exit();
    }
}