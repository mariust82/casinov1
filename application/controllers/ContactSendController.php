<?php
require_once("application/models/mailing/MailMessage.php");

class ContactSendController extends Lucinda\MVC\STDOUT\Controller
{
    const SUBJECT = "New message from ";
    const EMAIL = "support@casinoslists.com";

    public function run() {
        $message = new MailMessage(self::SUBJECT.$_POST["email"], $_POST["message"]);
        $message->setReplyTo($_POST["email"], $_POST["name"]);
        $message->addTo(self::EMAIL);
        if($_POST["message"]!=strip_tags($_POST["message"])) {
            $message->setContentType("text/html","UTF-8");
        }
        $message->send();
    }
}