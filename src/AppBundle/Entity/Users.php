<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Users
 */
class Users extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

}
