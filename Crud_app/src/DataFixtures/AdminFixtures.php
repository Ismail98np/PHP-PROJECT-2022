<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Admin;
use App\Entity\DrivingInstructor;
use App\Entity\Lesson;
use App\Entity\Student;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Create super user
         $admin = new Admin();
         $admin->setUsername("ismail");
         $admin->setPassword("1234");
         $admin->setRole("ROLE_ADMIN");

/*
        $lesson = new Lesson();
        $lesson->setLocation("ismail");
        $lesson->setDate("1234");
        $lesson->setTime("ROLE_ADMIN");
        $lesson->setPrice(45);

        $lesson1 = new Lesson();
        $lesson1->setLocation("ad");
        $lesson1->setDate("12ssa34");
        $lesson1->setTime("xxx");
        $lesson1->setPrice(45);
        
        

        //Object instantiation
        $instructor = new DrivingInstructor();

        //Setting object fields
        $instructor->setName('Ismail Omotoso 2');
        $instructor->setEmail('IO@gmail.com');
        $instructor->setPhoneNumber('0123456789');
        $instructor->setExperience(2);


        //Setting object fields
        $instructor1 = new DrivingInstructor();

        $instructor1->setName('Ismail Omotoso 3');
        $instructor1->setEmail('IO@gmail.com');
        $instructor1->setPhoneNumber('0126789');
        $instructor1->setExperience(3);


        //Object instantiation
        $student = new Student();
        
        $student->setName('Ismail Omotoso 2');
        $student->setEmail('IO@gmail.com');
        $student->setPhone('0123456789');
        $student->setPassword("1234");

        //Object instantiation
        $student1 = new Student();

        $student1->setName('Ismail Omotoso 5');
        $student1->setEmail('IO@g4242mail.com');
        $student1->setPhone('012343rw3r36789');
        $student1->setPassword("12effe34");

        $lesson->setStudent($student);
        $lesson1->setStudent($student);
        $lesson1->setDrivingInstructor($instructor1);





$manager->persist($lesson);
$manager->persist($lesson1);
$manager->persist($student);
$manager->persist($instructor1);
*/

$manager->persist($admin);

        $manager->flush();
    }
}
