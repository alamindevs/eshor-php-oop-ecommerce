<?php
namespace App\Mail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail {
    private $host     = 'smtp.mailtrap.io';
    private $username = '2a29818ee4c197';
    private $password = '3280c4e47b4b3f';
    private $port     = 2525;
    private $mail     = null;

    private $setMail     = "alamin@gmail.com";
    private $setMailName = "Alamin";

    public function __construct() {
        //Create an instance; passing `true` enables exceptions
        $this->mail = new PHPMailer( true );
        //Server settings
        $this->mail->SMTPDebug = 2; //Enable verbose debug output
        $this->mail->isSMTP(); //Send using SMTP
        $this->mail->SMTPAuth   = true; //Enable SMTP authentication
        $this->mail->Host       = $this->host; //Set the SMTP server to send through
        $this->mail->Username   = $this->username; //SMTP username
        $this->mail->Password   = $this->password; //SMTP password
        $this->mail->SMTPSecure = "tls"; //Enable implicit TLS encryption
        $this->mail->Port       = $this->port; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }

    public function mailSend( $to, $name, $subject = null, $body = null ) {

        //Recipients
        $this->mail->setFrom( $this->setMail, $this->setMailName );
        $this->mail->addAddress( $to, $name );

        //Content
        $this->mail->isHTML( true ); //Set email format to HTML
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body;

        $this->mail->send();

        return 'Message has been sent';

    }

}