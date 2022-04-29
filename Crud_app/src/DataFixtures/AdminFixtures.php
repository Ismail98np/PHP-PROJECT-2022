<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Admin;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $admin = new Admin();
         $admin->setUsername("ismail");
         $admin->setPassword("1234");
         $admin->setRole("ROLE_ADMIN");

         $manager->persist($admin);

        $manager->flush();
    }
}
