<?php

namespace App\Http\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use System\Config\Config;

class MailService
{
    // https://stackoverflow.com/questions/72113637/how-to-use-phpmailer-after-30-may-2022-when-less-secure-app-is-no-longer-an-o
    // https://github.com/PHPMailer/PHPMailer/wiki/Using-Gmail-with-XOAUTH2
    // https://github.com/PHPMailer/PHPMailer/blob/master/examples/gmail_xoauth.phps
    public function send($emailAddress, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->CharSet = Config::get('mail.SMTP.CharSet');
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = Config::get('mail.SMTP.Host');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = Config::get('mail.SMTP.SMTPAuth');                                   //Enable SMTP authentication
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = Config::get('mail.SMTP.Port');
            $mail->AuthType = Config::get('mail.SMTP.AuthType');                                   //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId' => Config::get('mail.SMTP.clientId'),
                    'clientSecret' => Config::get('mail.SMTP.clientSecret'),
                ]
            );

            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => Config::get('mail.SMTP.clientId'),
                        'clientSecret' => Config::get('mail.SMTP.clientSecret'),
                        'refreshToken' => Config::get('mail.SMTP.refreshToken'),
                        'userName' => Config::get('mail.SMTP.setFrom.mail'),
                    ]
                )
            );

            //Recipients
            $mail->setFrom(Config::get('mail.SMTP.setFrom.mail'), Config::get('mail.SMTP.setFrom.name'));
            $mail->addAddress($emailAddress);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body  = $body;


            $result = $mail->send();

            return $result;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
