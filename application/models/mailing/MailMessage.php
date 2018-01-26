<?php
require_once("MailAddress.php");
require_once("MailException.php");

/**
 * Encapsulates mail sending on top of PHP mail function
 */
class MailMessage
{
    private $subject;
    private $message;
    private $to = array();
    private $from;
    private $sender;
    private $replyTo;
    private $cc = array();
    private $bcc = array();
    private $customHeaders = array();

    /**
     * MailMessage constructor.
     * @param $subject Subject of email.
     * @param $body Email body.
     */
    public function __construct($subject, $body) {
        $this->subject = $subject;
        $this->message = $body;
    }

    /**
     * Adds address to send mail to
     *
     * @param string $email Value of email address.
     * @param string $name Name of person who holds email address (optional).
     */
    public function addTo($email, $name=null) {
        $this->to[] = new MailAddress($email, $name);
    }

    /**
     * Sets sender's address.
     *
     * @param string $email Value of email address.
     * @param string $name Name of person who holds email address (optional).
     */
    public function setFrom($email, $name=null) {
        $this->from = new MailAddress($email, $name);
    }

    /**
     * Sets message submitter, in case mail agent is sending on behalf of someone else.
     *
     * @param string $email Value of email address.
     * @param string $name Name of person who holds email address (optional).
     */
    public function setSender($email, $name=null) {
        $this->sender = new MailAddress($email, $name);
    }

    /**
     * Sets address recipients must use on replies to message.
     *
     * @param string $email Value of email address.
     * @param string $name Name of person who holds email address (optional).
     */
    public function setReplyTo($email, $name=null) {
        $this->replyTo = new MailAddress($email, $name);
    }

    /**
     * Adds address to publicly send a copy of message to
     *
     * @param string $email Value of email address.
     * @param string $name Name of person who holds email address (optional).
     */
    public function addCC($email, $name=null) {
        $this->cc[] = new MailAddress($email, $name);
    }

    /**
     * Adds address to discreetly send a copy of message to (invisible to others)
     *
     * @param string $email Value of email address.
     * @param string $name Name of person who holds email address (optional).
     */
    public function addBCC($email, $name=null) {
        $this->bcc[] = new MailAddress($email, $name);
    }

    /**
     * Sets email content type (useful when it's different from text/plain) and charset (useful when it's different from ISO).
     * NOTE: if defaults are used, makes mail message HTML and UTF8.
     *
     * @param string $contentType
     * @param string $charset
     */
    public function setContentType($contentType="text/html", $charset="UTF-8") {
        $this->customHeaders[] = 'Content-Type: '.$contentType.'; charset="'.$charset.'";';
    }

    /**
     * Adds custom mail header
     *
     * @param $name Value of header name.
     * @param $value Value of header content.
     */
    public function addCustomHeader($name, $value) {
        $this->customHeaders[] = $name.": ".$value;
    }

    /**
     * Sends mail to recipients
     */
    public function send() {
        if(empty($this->to)) throw new MailException("You must add at least one recipient to mail message!");

        $headers = $this->customHeaders;
        if(!empty($this->from)) {
            $headers[] = "From: ".$this->from;
        }
        if(!empty($this->sender)) {
            $headers[] = "Sender: ". $this->sender;
        }
        if(!empty($this->replyTo)) {
            $headers[] = "Reply-To: ".$this->replyTo;
        }
        if(!empty($this->cc)) {
            $headers[] = "Cc: ".implode(",", $this->cc);
        }
        if(!empty($this->bcc)) {
            $headers[] = "Bcc: ".implode(",", $this->bcc);
        }

        $result = mail(implode(",",$this->to), $this->subject, $this->message, implode("\r\n", $headers));
        if(!$result) throw new MailException("Send failed!");
    }
}

