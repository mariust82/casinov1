<?php
require_once("application/models/mailing/MailMessage.php");
require_once("application/models/dao/Subscriptions.php");

class NewsletterSubscribeController extends Lucinda\MVC\STDOUT\Controller
{
    const SUBJECT = "User wants to be added to newsletter";
    const MESSAGE = "Please add me to newsletter";
    const EMAIL = "support@casinoslists.com";

    public function run() {
        $this->sendMail();
        $this->saveSubscription();
    }

    private function sendMail() {
        $message = new MailMessage(self::SUBJECT, self::MESSAGE.": ".$_POST["email"]);
        $message->setReplyTo($_POST["email"]);
        $message->addTo(self::EMAIL);
        $message->send();
    }


    private function saveSubscription() {
        $object = new Subscriptions();
        $object->save($_POST["email"], $this->request->attributes("ip"), $this->request->attributes("country"));
    }
}