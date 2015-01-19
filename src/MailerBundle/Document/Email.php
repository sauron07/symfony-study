<?php

namespace MailerBundle\Document;

use MongoId;


/**
 * Email
 */
class Email
{    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var int $contact_list
     */
    protected $contact_list;


    /**
     * Get id
     *
     * @return MongoId $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contactList
     *
     * @param int $contactList
     * @return self
     */
    public function setContactList($contactList)
    {
        $this->contact_list = $contactList;
        return $this;
    }

    /**
     * Get contactList
     *
     * @return int $contactList
     */
    public function getContactList()
    {
        return $this->contact_list;
    }
}
