<?php

namespace AuthenticationBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;
use AuthenticationBundle\Validators\Constraints\Services;

/**
 * @Annotation
 */
class DuplicateUser extends Constraint {
    
    public $message = "User: %value% already exists.";
    
    public function validateBy() {
        return "authentication_validator_duplicate_user";
    }
    
}