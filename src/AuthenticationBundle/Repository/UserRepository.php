<?php

namespace AuthenticationBundle\Repository;

use AppBundle\Repository\BaseRepository;

class UserRepository extends BaseRepository {
    
    public function findOneByUsername($username) {
        return $this->findOneBy(array('username' => $username));
    }
    
    public function findOneByEmail($email) {
        return $this->findOneBy(array('email' => $email));
    }
    
}
