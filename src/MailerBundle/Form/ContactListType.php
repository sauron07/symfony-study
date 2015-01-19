<?php

namespace MailerBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactListType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName ()
    {
        return 'mailerbundle_contact_list';
    }
}