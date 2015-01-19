<?php

namespace MailerBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MailerBundle\Entity\ContactList;

class LoadContactLists extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load (ObjectManager $manager)
    {
        $activatedContactList = new ContactList();
        $activatedContactList->setTitle('Activated contact list');

        $nonActivatedContactList = new ContactList();
        $nonActivatedContactList->setTitle('Non activated contact list');

        $manager->persist($activatedContactList);
        $manager->persist($nonActivatedContactList);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder ()
    {
        return 3;
    }
}