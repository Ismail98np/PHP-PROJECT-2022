<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\DrivingInstructor;

class DrivingInstructorController extends AbstractController
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        //return new Response("<html><body>this webpage is working fine</body></html>");

        //mock array of driving instructors
        $driving_instructors =["DI_1","D1_2"];


        return $this->render("DI/index.html.twig",array('instructors' => $driving_instructors));
    }
    /** 
    
     * @Route("/save")
     */
    
    public function save(ManagerRegistry $doctrine) :Response
    {
        //Using entity manager
        $entityManager = $doctrine->getManager();

        //Object instantiation
        $instructor = new DrivingInstructor();

        //Setting object fields
        $instructor->setName('Ismail Omotoso');
        $instructor->setEmail('IO@gmail.com');
        $instructor->setPhoneNumber('0123456789');
        $instructor->setExperience(2);


        //Persist to DB
        $entityManager->persist($instructor);

        //execute query to save object
        $entityManager->flush();

        return new Response('saved a new driving instructor the name of them is '.$instructor->getName());

    }
    
}
