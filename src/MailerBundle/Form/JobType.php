<?php

namespace MailerBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class JobType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder->add('template', 'entity', [
            'class' => 'MailerBundle:Template',
            'property' => 'alias'
        ])
            ->add('contact_list', 'entity', [
                'class' => 'MailerBundle\Entity\ContactList',
                'property' => 'title'
            ])
            ->add('name')
            ->add('started_at', 'datetime');
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName ()
    {
        return 'mailerbundle_job';
    }
}