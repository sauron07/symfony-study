<?php

namespace MailerBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MailerBundle\Entity\Template;

class LoadTemplates extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load (ObjectManager $manager)
    {
        $activation = new Template();
        $activation->setAlias('activation')
            ->setSubject('Activation letter')
            ->setBody('Activation letter from some site')
            ->setDeleted(0);
        $manager->persist($activation);

        for($i = 0; $i < 50; $i++){
            $template = new Template();
            $template->setAlias(uniqid('alias-'))
                ->setSubject('Mailing')
                ->setBody('This is common mailing letter, please do not do nothing!')
                ->setDeleted(0);
            $manager->persist($template);
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
        return 2;
    }
}