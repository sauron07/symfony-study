<?php

namespace MailerBundle\Controller;


use MailerBundle\Entity\ContactList;
use MailerBundle\Form\ContactListType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactListController extends Controller
{
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MailerBundle:ContactList')->findAll();

        $paginator = $this->container->get('knp_paginator');
        $entities = $paginator->paginate($entities, $page, $this->container->getParameter('max_templates_on_page'));

        return $this->render('MailerBundle:ContactList:index.html.twig', [
            'contact_list' => $entities,
        ]);
    }

    public function newAction()
    {
        $entity = new ContactList();
        $form = $this->createCreateForm($entity);

        return $this->render('MailerBundle:ContactList:new.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);

    }

    public function createAction(Request $request)
    {
        $entity = new ContactList();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_list_main_page'));
        }

        return $this->render('MailerBundle:ContactList:new.html.twig', [
            'entity' => $entity,
            'form' => $form,
        ]);

    }

    private function createCreateForm ($entity)
    {
        $form = $this->createForm(new ContactListType(), $entity, [
            'action' => $this->generateUrl('contact_list_create_page'),
            'method' => 'post'
        ]);
        $form->add('submit', 'submit');
        return $form;
    }

}