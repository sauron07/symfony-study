<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Users
 */
class Users extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * User Login
     *
     * @var string
     *
     * @Assert\Length(
     *      min="3",
     *      max="255",
     *      minMessage="The login is too short",
     *      maxMessage="The login is too long",
     *      groups={"Registration", "Profile"}
     * )
     */
    private $login;

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

    /**
     * Set login
     *
     * @param string $login
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }
}
