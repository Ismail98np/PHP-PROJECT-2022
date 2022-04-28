<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use App\Entity\DrivingInstructor;

class DrivingInstructorController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function index(ManagerRegistry $doctrine)
    {
        //return new Response("<html><body>this webpage is working fine</body></html>");

        // array of driving instructors
        $driving_instructors = $doctrine->getRepository(DrivingInstructor::class)->findAll();


        return $this->render("DI/index.html.twig",array('instructors' => $driving_instructors));
    }

    /**
     * @Route("/instructor/{id}", name="instructor")
     * @Method({"GET"})
     */
    public function showInstructor(ManagerRegistry $doctrine, int $id)
    {

        // array of driving instructors
        $driving_instructor = $doctrine->getRepository(DrivingInstructor::class)->find($id);


        return $this->render("DI/show.html.twig",array('instructor' => $driving_instructor));
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
        $instructor->setName('Ismail Omotoso 2');
        $instructor->setEmail('IO@gmail.com');
        $instructor->setPhoneNumber('0123456789');
        $instructor->setExperience(2);


        //Persist to DB
        $entityManager->persist($instructor);

        //execute query to save object
        $entityManager->flush();

        return new Response('saved a new driving instructor the name of them is '.$instructor->getName());

    }

    /** 
     * @Route("/di/new")
     * @Method({"GET","POST"})
     */
    public function newInstructor(ManagerRegistry $doctrine, Request $request)
    {
        

        $form = $this->createFormBuilder()
        ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('email', TextType::class, array(
          'required' => false,
          'attr' => array('class' => 'form-control')
        ))
        ->add('Phone', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
          'label' => 'Create',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
          $form_data = $form->getData();
          $instructor = new DrivingInstructor();
          $instructor->setName($form_data["name"]);
          $instructor->setEmail($form_data["email"]);
          $instructor->setPhoneNumber($form_data["Phone"]);
          $instructor->setExperience(0);


          $entityManager = $doctrine->getManager();
          $entityManager->persist($instructor);
          $entityManager->flush();

          return $this->redirectToRoute('home');
        }

        

        return $this->render('DI/new.html.twig', array(
            'form' => $form->createView()
          ));
    }


      /** 
     * @Route("/di/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, Request $request, int $id)
    {

      // get driving instructor
      $driving_instructor = $doctrine->getRepository(DrivingInstructor::class)->find($id);


      $entityManager = $doctrine->getManager();
      $entityManager->remove($driving_instructor);
      $entityManager->flush();

      $response = new Response();
      $response->send();

    }
}
