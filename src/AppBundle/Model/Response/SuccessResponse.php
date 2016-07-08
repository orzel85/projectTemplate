<?php

namespace AppBundle\Model\Response;

class SuccessResponse {
    
    public $type = 'success';
    
    public $data;
    
    public function __construct($data = null) {
        $this->data = $data;
    }
    
}
