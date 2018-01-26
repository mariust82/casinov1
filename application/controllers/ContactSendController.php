<?php
require_once("application/models/mailing/MailMessage.php");

class ContactSendController extends Controller
{
    const SUBJECT = "User has sent a message";
    const EMAIL = "support@casinoslists.com";

    public function run() {
        $_POST["email"] = "lucian@hliscorp.com";
        $_POST["name"] = "Lucian Popescu";
        $_POST["message"] = "Testing shit!";

        $message = new MailMessage(self::SUBJECT, $_POST["message"]);
        $message->setReplyTo($_POST["email"], $_POST["name"]);
        $message->addTo(self::EMAIL);
        if($_POST["message"]!=strip_tags($_POST["message"])) {
            $message->setContentType("text/html","UTF-8");
        }
        $message->send();
    }
}