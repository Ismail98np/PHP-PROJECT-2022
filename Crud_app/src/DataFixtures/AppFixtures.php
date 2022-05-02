<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Lesson;
use App\Entity\DrivingInstructor;
use App\Entity\Student;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        //Instructors
        $instructor = new DrivingInstructor();
        $instructor1 = new DrivingInstructor();
        $instructor2 = new DrivingInstructor();

        $instructor->setName('John Doe');
        $instructor->setEmail('JD@gmail.com');
        $instructor->setPhoneNumber('0123456789');
        $instructor->setExperience(2);

        $instructor1->setName('Tom Doe');
        $instructor1->setEmail('TD@gmail.com');
        $instructor1->setPhoneNumber('0123456789');
        $instructor1->setExperience(5);

        $instructor2->setName('Cole Doe');
        $instructor2->setEmail('CD@gmail.com');
        $instructor2->setPhoneNumber('0123456789');
        $instructor2->setExperience(12);

        //Students
        $student = new Student();
        $student1 = new Student();
        $student2 = new Student();

        $student->setName('lee jordane');
        $student->setEmail('lj@gmail.com');
        $student->setPhone('0123456789');

        $student1->setName('Mike wozoko');
        $student1->setEmail('mq@gmail.com');
        $student1->setPhone('0123456789');

        $student2->setName('Naruto uzamaki');
        $student2->setEmail('nu@gmail.com');
        $student2->setPhone('0123456789');


        //Lessons

        $lesson = new Lesson();
        $lesson1 = new Lesson();
        $lesson2 = new Lesson();
        $lesson3= new Lesson();
        $lesson4 = new Lesson();
        $lesson5 = new Lesson();
        $lesson6 = new Lesson();



        $lesson->setLocation('Tallaght');
        $lesson->setTime('10pm');
        $lesson->setDate('01/05/22');
        $lesson->setPrice(45);
        $lesson->setDrivingInstructor($instructor);
        $lesson->setStudent($student);
        $lesson->setDrivingIntsructorEmail("hi");
        $lesson->setStudentEmail($student->getEmail());

        $lesson1->setLocation('Blanchardstown');
        $lesson1->setTime('12pm');
        $lesson1->setDate('02/05/22');
        $lesson1->setPrice(45);
        $lesson1->setDrivingInstructor($instructor);
        $lesson1->setStudent($student);
        $lesson1->setDrivingIntsructorEmail($instructor1->getEmail());
        $lesson1->setStudentEmail($student->getEmail());


        $lesson2->setLocation('Lucan');
        $lesson2->setTime('1pm');
        $lesson2->setDate('04/05/22');
        $lesson2->setPrice(45);
        $lesson2->setDrivingInstructor($instructor1);
        $lesson2->setStudent($student2);
        $lesson2->setDrivingIntsructorEmail($instructor1->getEmail());
        $lesson2->setStudentEmail($student2->getEmail());


        $lesson3->setLocation('City');
        $lesson3->setTime('4pm');
        $lesson3->setDate('07/05/22');
        $lesson3->setPrice(45);
        $lesson3->setDrivingInstructor($instructor2);
        $lesson3->setStudent($student1);
        $lesson3->setDrivingIntsructorEmail($instructor2->getEmail());
        $lesson3->setStudentEmail($student1->getEmail());


        $lesson4->setLocation('Dunboyne');
        $lesson4->setTime('11pm');
        $lesson4->setDate('12/05/22');
        $lesson4->setPrice(45);
        $lesson4->setDrivingInstructor($instructor);
        $lesson4->setStudent($student2);
        $lesson4->setDrivingIntsructorEmail($instructor->getEmail());
        $lesson4->setStudentEmail($student2->getEmail());

        $lesson5->setLocation('Rathfarnam');
        $lesson5->setTime('8am');
        $lesson5->setDate('24/05/22');
        $lesson5->setPrice(45);
        $lesson5->setDrivingInstructor($instructor1);
        $lesson5->setStudent($student1);
        $lesson5->setDrivingIntsructorEmail($instructor1->getEmail());
        $lesson5->setStudentEmail($student1->getEmail());

        $lesson6->setLocation('Maynooth');
        $lesson6->setTime('12pm');
        $lesson6->setDate('9/05/22');
        $lesson6->setPrice(45);
        $lesson6->setDrivingInstructor($instructor2);
        $lesson6->setStudent($student);
        $lesson6->setDrivingIntsructorEmail($instructor2->getEmail());
        $lesson6->setStudentEmail($student->getEmail());


        //persist to db

        $manager->persist($lesson);
        $manager->persist($lesson1);
        $manager->persist($lesson2);
        $manager->persist($lesson3);
        $manager->persist($lesson4);
        $manager->persist($lesson5);
        $manager->persist($lesson6);


        $manager->persist($student);
        $manager->persist($student1);
        $manager->persist($student2);

        $manager->persist($instructor);
        $manager->persist($instructor1);
        $manager->persist($instructor2);

        $manager->flush();
    }
}
