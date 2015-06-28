<?php

namespace SolStar;

class RequestAuthorizationHandler {

    private $_headers = array();

    public function __construct() {
        $this->setInternalServerHeaders();
    }

    public function getToken() {
        $token = null;
        if (
            array_key_exists('Authorization',$this->_headers)
            && strpos($this->_headers['Authorization'],'Bearer ') == 0
        ) {
            $token = trim(substr($this->_headers['Authorization'],7));
        }
        else {
            throw new \Exception('Authorization header malformed or not present');
        }
        return $token;
    }

    private function setInternalServerHeaders() {
        if (count($_SERVER) > 0) {
            foreach ($_SERVER as $key => $value) {
                if (strpos($key, 'HTTP_') === 0) {
                    $this->_headers[str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
                }
            }
        }
    }
} 