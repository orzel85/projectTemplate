<?php

namespace AppBundle\Model\Response;

class ErrorResponse {
    
    public $type = 'error';
    
    public $code;
    
    public $errors = array();
    
    public function __construct($code, $errors) {
        $this->code = $code;
        if(!is_array($errors)) {
            $errors = array($errors);
        }
        $this->errors = $errors;
    }
    
}
