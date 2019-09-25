<?php

require_once 'application/models/dao/CasinoReviews.php';

class UserPost {

    protected $db_table = '';
    private $errors = []; //store errors here
    protected $parameters = []; //store necessary parameters
    protected $filled_parameters = [];
    protected $post_error_msg = '';

    /**
     * @param string $error
     */
    public function setError($error) {
        $this->errors[] = (string) $error;
    }
    
    public function __construct() {
        $this->fillParameters();
        if (isset($this->parameters['ip'])) {
            $this->filled_parameters['ip'] = is_null($ip = IPDetection::getInstance()->getIP()) ? '127.0.0.1' : $ip;
        }
    }

    /**
     * @return array
     */
    protected function getErrors() {
        return $this->errors;
    }

    public function canPost() {
        $can_post = true;
        foreach ($this->parameters as $parameter => $settings) {
            if (is_array($settings) && !empty($settings['check'])) {
                foreach ($settings['check'] as $check => $check_settings) {
                    if (method_exists($this, $function_name = 'check' . ucfirst($check))) {
                        if (!$this->$function_name($parameter, $check_settings)) {
                            $can_post = false;
                        }
                    }
                }
            }
        }
        return $can_post;
    }

    private function fillParameters() {
        foreach ($this->parameters as $parameter => $settings) {
            $default_value = is_array($settings) ? (!empty($settings['default']) ? $settings['default'] : '') : $settings;
            $this->filled_parameters[$parameter] = !isset($_POST[$parameter]) ? $default_value : $_POST[$parameter];
        }
    }

    protected function post() {
        if ($this->canPost()) {
            try {
                $dao = new UserPostDao($this->db_table, $this->filled_parameters);
                $item = $dao->getPostQuery();
                $insertId = $item->getInsertId();
                return $insertId;
            } catch (Exception $e) {
                $this->setError($this->post_error_msg);
                return false;
            }
        }
        return false;
    }

}

class UserPostException extends Exception {
    
}

class Warning extends Exception {
    
}
