<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $admin = new User();

        $admin->setUsername('admin');
        $admin->setPlainPassword('admin');
        $admin->setEmail('admin@admin.com');
        $admin->setEnabled(true);
        $admin->setSuperAdmin(true);

        $manager->persist($admin);
        $manager->flush();
    }
}
