<?php

namespace AuthenticationBundle\Validators\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use AuthenticationBundle\Repository\UserRepository;

class DuplicateUserValidator extends ConstraintValidator {
    
    /**
     *
     * @var \AuthenticationBundle\Repository\UserRepository
     */
    private $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    public function validate($value, Constraint $constraint) {
        $result = $this->userRepository->findOneByUsername($value);
        if(!empty($result)) {
            $this->context->buildViolation($constraint->message, array(
                "%value%" => $value,
            ))->addViolation();
        }
    }
    
}