<?php
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('core.php');
require '../vendor/autoload.php';
require("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
  require("../vendor/phpmailer/phpmailer/src/SMTP.php");
$name = '';
$email = '';
$comment = '';
if(isset($_POST['submit'])) {
  $name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
//Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    // $mail->Host = 'localhost';  // Specify main and backup SMTP servers
    $mail->Host = PHPMAILER_HOST;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = PHPMAILER_USER;                 // SMTP username
    $mail->Password = PHPMAILER_PASSWORD;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';


      if(!$mail->Send())
      {
      echo "el mensaje no se ha podido enviar ";
      echo "error". $mail->ErrorInfo;
      exit;
      }
      echo "mensaje enviado correctamente";


} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}


}else{
  echo "algo anda mal ";
}

?>
