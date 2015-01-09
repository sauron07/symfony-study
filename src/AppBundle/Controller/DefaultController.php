<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('test')
            ->setFrom('test@mail.com')
            ->setTo('matyeyev.sasha@gmail.com')
            ->setBody(
                    'test letter'
            );

        $this->container->get('mailer')->send($message);

        return $this->render('@FOSUser/layout.html.twig');
    }
}
