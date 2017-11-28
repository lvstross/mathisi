<?php 
namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config;

class Mail
{
    /**
    * Sets config and mail objects
    * @return void
    */
    public static function newEmail(string $subject, string $body, array $addresses)
    {   
        try{
            $config = new Config();
            $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = $config->settings['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config->settings['MAIL_USERNAME'];
            $mail->Password = $config->settings['MAIL_PASSWORD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($config->settings['MAIL_FROM_ADDRESS'], $config->settings['MAIL_FROM_NAME']);
            for($i=0;$i<count($addresses);$i++){
                $mail->addAddress($addresses[$i]);
            }
            $mail->addReplyTo($config->settings['MAIL_REPLY_TO'], $config->settings['MAIL_REPLY_TO_NAME']);

            //Contents
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);

            // Send the Email
            $mail->send();
            echo "Message has been sent.";
        }catch(Exception $e){
            echo "Error message: " . $mail->ErrorInfo;
        }
    }
}