<?php
/**
 * Created by PhpStorm.
 * User: matveev
 * Date: 1/10/15
 * Time: 10:54 AM
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Users;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsers extends AbstractFixture implements
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    /** @var  ContainerInterface $container */
    protected $container;

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer (ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load (ObjectManager $manager)
    {
        $user = $this->container->get('fos_user.user_manager');

        $adminUser = $user->createUser();
        $adminUser->setUsername('admin')
            ->setEmail('matyeyev.sasha@gmail.com')
            ->setPlainPassword('admin')
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setEnabled(1);

        $commonUser = $user->createUser();
        $commonUser->setUsername('user')
            ->setEmail('user@email.com')
            ->setPlainPassword('user')
            ->setRoles(['ROLE_USER'])
            ->setEnabled(1);

        $manager->persist($adminUser);
        $manager->persist($commonUser);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder ()
    {
        return 1;
    }
}