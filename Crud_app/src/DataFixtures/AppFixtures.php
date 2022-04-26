<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Hotel;
use App\Entity\County;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $c1 = new County();
        $c1 -> setName('Dublin');

        $c2 = new County();
        $c2-> setName('Kildare');

        $c3 = new County();
        $c3-> setName( 'Cork');

        $h1 = new Hotel();
        $h1->setName('Clane B&B');
        $h1-> setNumOfRooms(10 );
        $h1 -> setSwimmingPool(false);
        $h1 -> setCounty($c2);

        $h2 = new Hotel();
        $h2 -> setName('Dublin Excelsior');
        $h2-> setNumOfRooms(255 );
        $h2 -> setSwimmingPool(true);
        $h2 -> setCounty($c1);


//
//        $int2 = new Intensity();
//        $int2->setName('moderate');
//
//        $int3 = new Intensity();
//        $int3->setName('vigorous');
//
//
//        $hobby1 = new Hobby();
//        $hobby1->setName('yoga');
//        $hobby1->setIsIndoors(true);
//        $hobby1->setWeeklyCost(15);
//        $hobby1->setIntensity($intLow);
//
//        $hobby2 = new Hobby();
//        $hobby2->setName('running');
//        $hobby2->setIsIndoors(false);
//        $hobby2->setWeeklyCost(0);
//        $hobby2->setIntensity($int3);
//
        $manager->persist($c1);
        $manager->persist($c2);
        $manager->persist($c3);


//
        $manager->persist($h1);
        $manager->persist($h2);

        $manager->flush();


    }
}
