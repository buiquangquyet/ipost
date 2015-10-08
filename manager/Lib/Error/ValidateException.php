<?php
 
class ValidateException extends Exception {
 
    public function __construct($message = null, $code = 2) {
        if (empty($message)) {
            $message = 'validate error.';
        }
        parent::__construct($message, $code);
    }
}

