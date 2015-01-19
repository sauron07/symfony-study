<?php
/**
 * Created by PhpStorm.
 * User: matveev
 * Date: 1/16/15
 * Time: 11:43 AM
 */

namespace MailerBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MailerBundle\Document\Email;

class LoadEmails extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load (ObjectManager $manager)
    {
        for($i = 0; $i < 10; $i++){
            $activatedEmails = new Email();
            $activatedEmails->setContactList(1);
            $activatedEmails->setEmail(sprintf('%s@mail.com', uniqid('active_')));
            $manager->persist($activatedEmails);
        }

        for($i = 0; $i < 10; $i++){
            $nonActivatedEmails = new Email();
            $nonActivatedEmails->setContactList(2);
            $nonActivatedEmails->setEmail(sprintf('%s@mail.com', uniqid('non_active_')));
            $manager->persist($nonActivatedEmails);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder ()
    {
        return 4;
    }
}