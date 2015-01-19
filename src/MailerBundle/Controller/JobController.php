<?php

namespace MailerBundle\Controller;

use MailerBundle\Entity\Job;
use MailerBundle\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class JobController extends Controller
{
    /**
     * @param $jobs_type
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($jobs_type, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository('MailerBundle:Job')->getJobs($jobs_type);

        $paginator = $this->container->get('knp_paginator');
        $jobs = $paginator->paginate($jobs, $page, $this->container->getParameter('max_templates_on_page'));

        return $this->render ('MailerBundle:Job:index.html.twig', array(
            'jobs' => $jobs,
        ));
    }

    public function newAction()
    {
        $entity = new Job();
        $form = $this->createCreateForm($entity);

        return $this->render('MailerBundle:Job:new.html.twig', [
            'entity' => $entity,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $entity = new Job();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('job_index_page'));
        }

        return $this->render('MailerBundle:Job:new.html.twig', [
            'entity' => $entity,
            'form' => $form->createView()
        ]);
    }

    private function createCreateForm (Job $entity)
    {
        $form = $this->createForm(new JobType(), $entity, [
            'action' => $this->generateUrl('job_crete_page'),
            'method' => 'POST'
        ]);

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }
}
