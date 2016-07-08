<?php
// src/AppBundle/Entity/User.php

namespace AuthenticationBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AuthenticationBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    
    public static $__CLASS__ = __CLASS__;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=true)
     */
    protected $creationDate;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }


    
}