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
use Symfony\Component\Form\Extension\Core\Type\NumberType;


use App\Entity\DrivingInstructor;

class DrivingInstructorController extends AbstractController
{

      /**
     * @Route("/drivinginstructors", name="home")
     * @Method({"GET"})
     */
    public function index(ManagerRegistry $doctrine)
    {

        return $this->render("DI/home.html.twig",);
    }


    /**
     * @Route("/viewInstrcutors", name="viewInstrcutors")
     * @Method({"GET"})
     */
    public function index1(ManagerRegistry $doctrine)
    {
        // array of driving instructors
        $driving_instructors = $doctrine->getRepository(DrivingInstructor::class)->findAll();


        return $this->render("DI/viewInstructors.html.twig",array('instructors' => $driving_instructors));
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
        $instructor->setName('jiM Omotoso 2');
        $instructor->setEmail('JO@gmail.com');
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
        
      //Using form builder from symfony I pass in the fields needed to create the driving inxtructor object
        $form = $this->createFormBuilder()
        ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('email', TextType::class, array(
          'required' => false,
          'attr' => array('class' => 'form-control')
        ))
        ->add('Phone', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('Experience', NumberType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
          'label' => 'Create',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();


        //form handles the request
        $form->handleRequest($request);

        //if the information provided is valid then a driving instructor is created
        if($form->isSubmitted() && $form->isValid()) {
          //gets data entered into form
          $form_data = $form->getData();
          //creates driving instructor
          $instructor = new DrivingInstructor();
          $instructor->setName($form_data["name"]);
          $instructor->setEmail($form_data["email"]);
          $instructor->setPhoneNumber($form_data["Phone"]);
          $instructor->setExperience($form_data["Experience"]);

          //get manager
          $entityManager = $doctrine->getManager();
          //persist object to db
          $entityManager->persist($instructor);
          //execute query
          $entityManager->flush();
          //redirect to correct page
          return $this->redirectToRoute('home');
        }

        
        //pass in the form into this page which will render it for use
        return $this->render('DI/new.html.twig', array(
            'form' => $form->createView()
          ));
    }

     /**
     * @Route("/editInstructors", name="editInstructors")
     * @Method({"GET"})
     */
    public function editStudents(ManagerRegistry $doctrine)
    {
        // array of driving instructors
        $driving_instructor = $doctrine->getRepository(DrivingInstructor::class)->findAll();

        return $this->render("DI/editInstructors.html.twig",array('instructors' => $driving_instructor));
    }


       /** 
     * @Route("/di/edit/{id}", name="edit_instructor")
     * @Method({"GET","POST"})
     */
    public function editInstructor(ManagerRegistry $doctrine, Request $request , int $id)
    {
      //Follows the same approach as new instuctor
      $driving_instructor = $doctrine->getRepository(DrivingInstructor::class)->find($id);

        $form = $this->createFormBuilder($driving_instructor)
        ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('email', TextType::class, array(
          'required' => false,
          'attr' => array('class' => 'form-control')
        ))
        ->add('Phone_number', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('Experience', NumberType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
          'label' => 'Update',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

          $entityManager = $doctrine->getManager();
          $entityManager->flush();

          return $this->redirectToRoute('editInstructors');
        }

        

        return $this->render('DI/edit.html.twig', array(
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
      //remove driving instructor
      $entityManager->remove($driving_instructor);
      //execute query
      $entityManager->flush();

      //response is sent back to fetch
      $response = new Response();
      $response->send();

    }
}
