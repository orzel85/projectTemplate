<?php

namespace AuthenticationBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;
use AuthenticationBundle\Validators\Constraints\Services;

/**
 * @Annotation
 */
class DuplicateEmail extends Constraint {
    
    public $message = "Email: %value% already exists.";
    
    public function validateBy() {
        return "authentication_validator_duplicate_email";
    }
    
}