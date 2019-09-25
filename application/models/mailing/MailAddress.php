<?php
/**
 * Class that encapsulates a single email address field as well as its author.
 */
class MailAddress
{
    private $email;
    private $name;

    public function __construct($email, $name=null)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new MailException("Email address is invalid!");
        }
        $this->email = $email;
        $this->name = $name;
    }

    public function __toString()
    {
        if ($this->name) {
            return $this->name." <".$this->email.">";
        } else {
            return $this->email;
        }
    }
}
