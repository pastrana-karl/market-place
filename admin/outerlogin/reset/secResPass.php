<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
function myCustomErrorHandler(int $errNo, string $errMsg, string $file, int $line) {
        echo "Wow my custom error handler got #[$errNo] occurred in [$file] at line [$line]: [$errMsg]";
        // echo '';
        }

if (isset($_POST["sbmtReset"]))
{
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $newPass = $_POST["newPass"];
    $reNewPass = $_POST["reNewPass"];

    if (empty($newPass) || empty($reNewPass)){
        header("location: loginerror.php?newPwd=empty");
        exit();
    }
    else if ($newPass != $reNewPass){
        header("location: loginerror.php?passwordMismatch");
        exit();
    }

    $currentDate = date("U");

    require_once('../../../includes/constants.php');

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?;";
    $stmt = mysqli_stmt_init($conn);
     
     if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error!";
        exit();
     }
     else{
         mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
         mysqli_stmt_execute($stmt);

         $result = mysqli_stmt_get_result($stmt);

         if (!$row = mysqli_fetch_assoc($result)){
            echo "You need to re-submit your reset request1.";
            exit();
         }
         else {
             $tokenBin = hex2bin($validator);
             $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

             if ($tokenCheck === false){
                echo "You need to re-submit your reset request2.";
                exit();
             }
             elseif ($tokenCheck === true){
                $tokenEmail = $row["pwdResetEmail"];

                $sql = "SELECT * FROM securitylog WHERE username = ?;";
                $stmt = mysqli_stmt_init($conn);
     
                if (!mysqli_stmt_prepare($stmt, $sql)){
                   echo "There was an error!";
                   exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, 's', $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);

                    if (!$row = mysqli_fetch_assoc($result)){
                       echo "There was an eror!";
                       exit();
                    }
                    else {
                        $sql = "UPDATE securitylog SET password = ? WHERE username = ?;";
                        $stmt = mysqli_stmt_init($conn);
     
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                           echo "There was an error!";
                           exit();
                        }
                        else{
                            $newPwdHashed = password_hash($newPass, PASSWORD_DEFAULT);

                            mysqli_stmt_bind_param($stmt, 'ss', $newPwdHashed, $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            
                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail = ?;";
                            $stmt = mysqli_stmt_init($conn);
        
                            if (!mysqli_stmt_prepare($stmt, $sql)){
                            echo "There was an error!";
                            exit();
                            }

                            else{
                                $newPwdHashed = password_hash($newPass, PASSWORD_DEFAULT);

                                mysqli_stmt_bind_param($stmt, 's', $tokenEmail);
                                mysqli_stmt_execute($stmt);

                                header("location: ../securitylogin.php?newPwd=passwordUpdated");
                            }
                        }
                    }
                }
             }
         }
     }

}
else {
    header("location: ../securitylogin.php");
    exit();    
}