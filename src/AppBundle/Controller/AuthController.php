<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    public function registrationAction(Request $request)
    {
        $entity = new Users();
        $form = $this->createRegistrationForm($entity);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }

        return $this->render('AppBundle:Auth:registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function loginAction()
    {
        return $this->render('AppBundle:Auth:login.html.twig', array(
                // ...
            ));
    }

    private function createRegistrationForm ($entity)
    {
        return $this->createForm(new UsersType(), $entity, [
            'action' =>  $this->generateUrl('registration'),
            'method' => 'POST'
        ]);

    }

}
