<?php

namespace AuthenticationBundle\Service\User;

use \Doctrine\ORM\EntityManager;

class UserService {
    
    /*
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function checkIfUsernameExists($username) {
        /* @var $userRepository AuthenticationBundle\Repository\UserRepository */
        $userRepository = $this->em->getRepository(\AuthenticationBundle\Entity\User::$__CLASS__);
        $result = $userRepository->findOneByUsername($username);
        if(!empty($result)) {
            return true;
        }
        return false;
    }
    
    public function checkIfEmailExists($email) {
        /* @var $userRepository AuthenticationBundle\Repository\UserRepository */
        $userRepository = $this->em->getRepository(\AuthenticationBundle\Entity\User::$__CLASS__);
        $result = $userRepository->findOneByEmail($email);
        if(!empty($result)) {
            return true;
        }
        return false;
    }
}
