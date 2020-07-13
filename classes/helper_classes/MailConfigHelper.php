<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';

class MailConfigHelper{
    public static function getMailer():PHPMailer{
            $mail = new PHPMailer();
            //$mail->SMTPDebug= 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '16f488053d3137';
            $mail->Password = '1ce2ef5982824f';
            $mail->Port = 2525;
            $mail->SMTPSecure = 'tls';
            $mail->isHtml(true);
            $mail->setFrom('vanshikabhavnani29@gmail.com', 'Vanshika Bhavnani');

            return $mail;
    }
}

?>