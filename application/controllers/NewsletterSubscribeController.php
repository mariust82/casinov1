<?php
require_once("application/models/mailing/MailMessage.php");

class NewsletterSubscribeController extends Controller
{
    const SUBJECT = "User wants to be added to newsletter";
    const MESSAGE = "Please add me to newsletter";
    const EMAIL = "support@casinoslists.com";

    public function run() {
        $message = new MailMessage(self::SUBJECT, self::MESSAGE.": ".$_POST["email"]);
        $message->setReplyTo($_POST["email"]);
        $message->addTo(self::EMAIL);
        $message->send();
    }
}