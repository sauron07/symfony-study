<?php

namespace MailerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobController extends Controller
{
    public function indexAction($jobs_type, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository('MailerBundle:Job')->getJobs(($jobs_type == 'ended') ? true : false);

        $paginator = $this->container->get('knp_paginator');
        $jobs = $paginator->paginate($jobs, $page, $this->container->getParameter('max_templates_on_page'));

        return $this->render ('MailerBundle:Job:index.html.twig', array(
            'jobs' => $jobs,
        ));
    }

}
