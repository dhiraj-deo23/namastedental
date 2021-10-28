<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use function PHPSTORM_META\type;

require './vendor/autoload.php';


function send_email($email, $subject, $message)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = '';
    $mail->SMTPAuth   = true;
    $mail->Username   = '';
    $mail->Password   = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; //465
    $mail->setFrom('.....');
    $mail->addAddress($email);

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    if (!$mail->send()) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}




function redirect($result)
{
    return header("location: {$result}");
}


function escape($result)
{
    global $connection;
    return mysqli_real_escape_string($connection, $result);
}

function query($result)
{
    global $connection;
    return mysqli_query($connection, $result);
}

function get_announcement()
{
    $sql = "SELECT * FROM announcements where active = 1 ";
    $res = query($sql);
    $row = mysqli_fetch_assoc($res);
    $content = $row['short_desc'];
    echo $content;
}
