<?php
ob_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
function myCustomErrorHandler(int $errNo, string $errMsg, string $file, int $line) {
        echo "Wow my custom error handler got #[$errNo] occurred in [$file] at line [$line]: [$errMsg]";
        // echo '';
        }
        
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../mail/Exception.php';
require '../mail/PHPMailer.php';
require '../mail/SMTP.php';

echo($_SERVER['DOCUMENT_ROOT']);

if ($_SESSION['delivery'] = "Order Successful")
{
	$usrEmail= $_GET["email"];

	 $to = $usrEmail;
     $subject = "Thank you for shopping we received your order, MPManagement";
     $message = "<p style='text-align: justify;font-size: large;font-weight: bold;'>Thank you for shopping and supporting our store!!</p>";
     $message .= "<p style='text-align: justify;'>Good day dear customer, <br><br> We hope that you enjoyed our services, for any questions or order cancellation please contact the number below: <br><br>";
     $message .= 'Cel: 09277027997</p>';

     $headers = "From: Online Marketplace Management <marketordering69@gmail.com>\r\n";
     $headers .= "Reply-To: marketordering69@gmail.com\r\n";
     $headers .= "Content-type: text/html\r\n";

    // Load Composer's autoloader
    require '../vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer;
    $mail->isSMTP(); 
    $mail->SMTPDebug = 4; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Username = 'marketordering69@gmail.com'; // email
    $mail->Password = 'm4rk3t0rdering'; // password
    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is deprecated
    $mail->SMTPAuth = true;
    $mail->setFrom('marketordering69@gmail.com', 'Admin'); // From email and name
    $mail->addAddress($to); // to email and name
    $mail->Subject = $subject;
    $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    // $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}

    header("location: ../menu.php");
    exit();

}