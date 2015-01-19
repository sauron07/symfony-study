<?php

namespace MailerBundle\Controller;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmailController extends Controller
{
    public function indexAction($page)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $entities = $this->get('doctrine_mongodb')->getManager()->getRepository('MailerBundle:Email')->findAll();

        $paginator = $this->container->get('knp_paginator');
        $entities = $paginator->paginate($entities, $page, $this->container->getParameter('max_templates_on_page'));
        /** @var \MailerBundle\Document\Email $email */
        foreach ($entities as $email){
            $email->setContactList($em->getRepository('MailerBundle:ContactList')->findOneBy(['id' => $email->getContactList()]));
        }


        return $this->render('MailerBundle:Email:index.html.twig', [
            'emails' => $entities,
        ]);
    }
}