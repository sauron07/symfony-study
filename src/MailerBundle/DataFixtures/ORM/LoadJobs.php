<?php

namespace MailerBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MailerBundle\Entity\Job;
use MailerBundle\Entity\Template;

class LoadJobs extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load (ObjectManager $manager)
    {
        $activationTemplate = $manager->getRepository('MailerBundle:Template')->findOneBy(['alias' => 'activation']);

        $activationJob = new Job();
        $activationJob->setName('activation')
            ->setStartedAt(new \DateTime('2015-01-15 10:00:00'))
            ->setStatus(1)
            ->setTemplate($activationTemplate);

        $endedJob = new Job();
        $endedJob->setName('activation')
            ->setStartedAt(new \DateTime('2015-01-10 10:00:00'))
            ->setStatus(1)
            ->setTemplate($activationTemplate);

        $manager->persist($endedJob);
        $manager->persist($activationJob);
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