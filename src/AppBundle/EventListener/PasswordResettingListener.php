<?php

namespace AppBundle\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PasswordResettingListener implements EventSubscriberInterface
{
    /** @var  \Symfony\Component\Routing\Generator\UrlGeneratorInterface */
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents ()
    {
        return [
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => 'onPasswordResettingSuccess'
        ];
    }

    public function onPasswordResettingSuccess(FormEvent $event)
    {
        $url = $this->router->generate('homepage');

        $event->setResponse(new RedirectResponse($url));
    }
}