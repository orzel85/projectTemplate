<?php

namespace AuthenticationBundle\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class User {
    
    public $id;
    
    public $username;
    
    public $email;
    
    /**
     *
     * @var string
     * @Type("string")
     * @SerializedName("creationDate")
     */
    public $creationDate;
    
    /**
     *
     * @var string
     * @Type("string")
     * @SerializedName("lastLogin")
     */
    public $lastLogin;
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
    }
    
    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public static function createFromEntity(\AuthenticationBundle\Entity\User $user) {
        $obj = new User();
        $obj->setId($user->getId());
        $obj->setUsername($user->getUsername());
        $obj->setEmail($user->getEmail());
        $lastLogin = ( $user->getLastLogin() !== null ) ? $user->getLastLogin()->format("Y-m-d H:i:s") : null ;
        $creationDate = ( $user->getCreationDate() !== null ) ? $user->getCreationDate()->format("Y-m-d H:i:s") : null ;
        $obj->setCreationDate($creationDate);
        $obj->setLastLogin($lastLogin);
        return $obj;
    }
    
}
