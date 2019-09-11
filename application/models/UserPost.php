<?php

require_once 'application/models/dao/CasinoReviews.php';

class UserPost
{
    protected $db_table = '';
    private $errors = []; //store errors here
    protected $parameters = []; //store necessary parameters
    protected $filled_parameters = [];
    protected $post_error_msg = '';

    /**
     * Check if an ip can be used
     * Settings:
     * * max => how many times can be used
     * * time_limit => period of time in which it is allowed to have that maximum post from this ip
     * * error_msg => error message
     * @param string $parameter
     * @param array $settings
     * @return bool
     */
    final protected function checkIpCanBeUsed($parameter, $settings = [])
    {
        $value = $this->getParamValue($parameter);
        $query = "SELECT COUNT(*) FROM `" . $this->db_table . "` WHERE `ip`=:ip ";
        $query_vars = [":ip" => $value];
        if (!empty($settings['time_limit']) && !!$settings['time_limit']) {
            $time_limit = $settings['time_limit'];
            $query .= " AND `date`>=:date ";
            $query_vars[":date"] = strtotime("now -$time_limit seconds");
        }
        $found = SQL($query, $query_vars)->toValue();
        if (!empty($settings['max']) && !!$settings['max']) {
            $allowed = $found < $settings['max'];
        } else {
            $allowed = !$found;
        }
        if (!$allowed) {
            $this->setError($this->getDefaultErrorMsg($settings, "IP not allowed to post in this section!"));
        }
        return $allowed;
    }

    /**
     * Check if a string has the specified length
     * Settings:
     * * min => min length
     * * max => max length
     * * error_msg => error message
     * @param string $parameter
     * @param string|boolean $settings
     * @return bool
     */
    final private function checkStringLength($parameter, $settings)
    {
        $allowed = true;
        $value = $this->getParamValue($parameter);
        if (!empty($settings['min']) && strlen((string)$value) < (int)$settings['min']) {
            $allowed = false;
        }
        if (!empty($settings['max']) && strlen((string)$value) > (int)$settings['max']) {
            $allowed = false;
        }
        if (!$allowed) {
            $error_msg = !empty($error = $settings['error_msg']) ? $settings['error_msg'] : false;
            if (!$error_msg) {
                if (!empty($settings['min']) && !empty($settings['max'])) {
                    $error_msg = "$parameter must have between " . $settings['min'] . " and " . $settings['max'] . " characters!";
                } elseif (!empty($settings['min'])) {
                    $error_msg = "$parameter must have at least " . $settings['min'] . " characters!";
                } elseif (!empty($settings['max'])) {
                    $error_msg = "$parameter must have a maximum of " . $settings['max'] . " characters!";
                }
            }
            $this->setError($error_msg);
        }
        return $allowed;
    }

    /**
     * Check if the email is valid
     * @param string $parameter
     * @param string|boolean $settings
     * @return bool
     */
    final private function checkValidEmail($parameter, $settings)
    {
        $valid = filter_var($this->getParamValue($parameter), FILTER_VALIDATE_EMAIL);
        if (!$valid) {
            $this->setError($this->getDefaultErrorMsg($settings, "$parameter is not a valid email!"));
        }

        return $valid;
    }

    /**
     * @param string $parameter
     * @param string|boolean $settings
     * @return bool
     */
    final private function checkParentDbRowExists($parameter, $settings)
    {
        if ($this->getParamValue($parameter) == 0) {
            return true;
        }
        $exists = !!(SQL("SELECT id FROM `" . $this->db_table . "` WHERE id=:parent_id", [":parent_id" => $this->getParamValue($parameter)])->toValue());
        if (!$exists) {
            $this->setError($this->getDefaultErrorMsg($settings, "Parent item does not exists!"));
        }
        return $exists;
    }

    /**
     * @param string $parameter
     * @param string|boolean $settings
     * @return bool
     */
    final private function checkDbRowExists($parameter, $settings)
    {
        $exists = !!(SQL("SELECT id FROM `" . $this->db_table . "` WHERE id=:id", [":id" => $this->getParamValue($parameter)])->toValue());
        if (!$exists) {
            $this->setError($this->getDefaultErrorMsg($settings, "Item does not exists!"));
        }
        return $exists;
    }

    /**
     * @param array|string $settings
     * @param string $default
     * @return string
     */
    protected function getDefaultErrorMsg($settings, $default)
    {
        $error_msg = (string)$default;
        if (is_string($settings)) {
            $error_msg = $settings;
        } elseif (!empty($settings['error_msg'])) {
            $error_msg = $settings['error_msg'];
        }
        return $error_msg;
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->errors[] = (string)$error;
    }

    /**
     * @return array
     */
    protected function getErrors()
    {
        return $this->errors;
    }

    public function canPost()
    {
        $can_post = true;
        foreach ($this->parameters as $parameter => $settings) {
            if (is_array($settings) && !empty($settings['check'])) {
                foreach ($settings['check'] as $check => $check_settings) {
                    if (method_exists($this, $function_name = 'check' . ucfirst($check))) {
                        if (!$this->$function_name($parameter, $check_settings)) {
                            echo $function_name;
                            die();
                            $can_post = false;
                        }
                    }
                }
            }
        }
        return $can_post;
    }

    public function getParamValue($parameter = false)
    {
        if (!$parameter) {
            return null;
        }
        if (!empty($this->filled_parameters[$parameter])) {
            return $this->filled_parameters[$parameter];
        }
        return null;
    }

    public function fillParameter($paramater, $value)
    {
        $this->filled_parameters[$paramater] = $value;
    }

    protected function fillParameters()
    {
        foreach ($this->parameters as $parameter => $settings) {
            $default_value = is_array($settings) ? (!empty($settings['default']) ? $settings['default'] : '') : $settings;
            $this->filled_parameters[$parameter] = !isset($_POST[$parameter]) ? $default_value : $_POST[$parameter];
        }
    }

    public function __construct()
    {
        $this->fillParameters();
        if (isset($this->parameters['ip'])) {
            $this->filled_parameters['ip'] = is_null($ip = IPDetection::getInstance()->getIP()) ? '127.0.0.1' : $ip;
        }
    }

    protected function post()
    {
        if ($this->canPost()) {
            $query = "INSERT INTO `" . $this->db_table . "` SET ";
            $query_vars = [];
            foreach ($this->filled_parameters as $parameter => $value) {
                $query .= "`" . $parameter . "`=:value_of_$parameter, ";
                $query_vars[":value_of_$parameter"] = $value;
            }
            $query = substr($query, 0, strlen($query) - 2);
            try {
                $item = SQL($query, $query_vars);
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

class UserPostException extends Exception
{
}

class Warning extends Exception
{
}
