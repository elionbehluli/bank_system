<?php

namespace system;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../PHPMailer-master/src/Exception.php';
require __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer-master/src/SMTP.php';

class SmtpClass
{

    public $mailConn;

    public function __construct() {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
    
        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "ssl";
        $mail->Port       = 465;
        $mail->Host       = "ssl://mail.spinpagency.com";
        $mail->Username   = "elion.behluli@spinpagency.com";
        $mail->Password   = "";

        $this->mailConn = $mail;

    }
}
