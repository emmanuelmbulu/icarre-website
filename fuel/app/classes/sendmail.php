<?php
/**
 * Classe créé pour contourner le problème causé par fuel;
 */

use Fuel\Core\Config;
use Fuel\Core\View;

require (APPPATH . 'classes/PHPMailer/src/PHPMailer.php');
require (APPPATH . 'classes/PHPMailer/src/SMTP.php');

class Sendmail {
     static $MailsAdmin = array(
          array("mail" => "divine_kiengi@yahoo.fr", "name" => "Divine KIENGI"),
          array("mail" => "emmanuel.mbulu@icarre-rdc.com", "name" => "Emmanuel MBULU"),
     );

     /**
      * Function that creates an PHPMailer Object
      * @param null
      * @return PHPMailer
      */
     static function createMailObject() {
          Config::load("icarre-data-config.json");
          $smtp = Config::get("smtp");
          $email = Config::get("mail");

          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->CharSet = $smtp["charset"];
          $mail->Encoding = $smtp["encoding"];
          
          $mail->Debugoutput = $smtp["output"];
          $mail->SMTPDebug = $smtp["debug"];
          $mail->Host = $smtp["host"];
          $mail->SMTPAuth = $smtp["auth"];
          $mail->Username = $smtp["username"];
          $mail->Password = $smtp["password"];
          $mail->SMTPSecure = $smtp["secure"];
          $mail->Port = $smtp["port"];
          $mail->setFrom($email, "iCarré - Des idées intelligentes");
          $mail->isHTML(true);
          
          return $mail;
     }

     /**
     * Function that sends mail
     * @param array $destinataire : An assoc "mail" => "example@domain.com", "name" => "NAME"
     * @param string $subject : The subject of the mail
     * @param string $html_body : The HTML content that describes the mail
     * @param array $attachments : An array of Assoc "path" => "", "name" => ""
     * @param array $bcc : An array of Assoc "mail" => "", "name" => ""
     * @return float : The vat amount value
     */
     static public function Send($destinataire, $subject, $html_body, $attachments = [], $bcc = []) {
          try {
		     set_time_limit(180);
               $mail = self::createMailObject();

               $mail->Subject = html_entity_decode($subject);
               $mail->addAddress($destinataire["mail"], $destinataire["name"]);
               
               foreach ($bcc as $item) {
                    $mail->addBCC($item["mail"], $item["name"]);
               }

               foreach ($attachments as $item) {
                    $mail->addAttachment($item["path"], $item["name"]);
               }

               $mail->Body = $html_body;              
               return $mail->send();

          } catch(Exception $e) {
               Helper::archiverErreur($e);
               return $mail->ErrorInfo;
          }
     }

     /**
     * Function that sends mail
     * @param string $subject : The subject of the mail
     * @param string $html_body : The HTML content that describes the mail
     * @param array $bcc : An array of Assoc "mail" => "", "name" => ""
     * @return float : The vat amount value
     */
     static public function AutoNotify($subject, $html_body, $attachments = [], $bcc = []) {
          try {
		     set_time_limit(180);
               $mail = self::createMailObject();
               $mail->Subject = html_entity_decode($subject);
               
               foreach (self::$MailsAdmin as $item) {
                    $mail->addAddress($item["mail"], $item["name"]);
               }
               
               foreach ($bcc as $item) {
                    $mail->addBCC($item["mail"], $item["name"]);
               }

               foreach ($attachments as $item) {
                    $mail->addAttachment($item["path"], $item["name"]);
               }
               
               $mail->Body = $html_body;              
               return $mail->send();

          } catch(Exception $e) {
               Helper::archiverErreur($e);
               return $mail->ErrorInfo;
          }
     }
}
