<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Lesson;
use App\Entity\DrivingInstructor;
use App\Entity\Student;

class LessonController extends AbstractController
{
    /**
     * @Route("/lessons", name="lesssonHome")
     * @Method({"GET"})
     */
    public function index(ManagerRegistry $doctrine)
    {
        return $this->render("lesson/index.html.twig",);
    }


    /** 
     * @Route("/saveLesson")
     */
    
    public function save(ManagerRegistry $doctrine) :Response
    {
        //Using entity manager
        $entityManager = $doctrine->getManager();

        //Object instantiation
        $lesson = new Lesson();
        $instructor = new DrivingInstructor();
        $student = new Student();

        //Setting object fields
        $instructor->setName('Ismail Omotoso 2');
        $instructor->setEmail('IO@gmail.com');
        $instructor->setPhoneNumber('0123456789');
        $instructor->setExperience(2);

        $student->setName('lee jordane');
        $student->setEmail('lj@gmail.com');
        $student->setPhone('0123456789');


        $lesson->setLocation('Tallaght');
        $lesson->setDate('01/05/22');
        $lesson->setPrice(45);
        $lesson->setDrivingInstructor($instructor);
        $lesson->setStudent($student);

        


        //Persist to DB
        $entityManager->persist($lesson);
        $entityManager->persist($student);
        $entityManager->persist($instructor);

        //execute query to save object
        $entityManager->flush();

        return new Response('saved a new lesson the time of it is '.$lesson->getTime());

    }


    /**
     * @Route("/viewLessons", name="viewLessons")
     * @Method({"GET"})
     */
    public function viewAllLessons(ManagerRegistry $doctrine)
    {

        $lessons = $doctrine->getRepository(Lesson::class)->findAll();


        return $this->render("lessons/viewLessons.html.twig",array('lessons' => $lessons));
    }

    /**
     * @Route("/viewInstructorLessons", name="viewInstructorLessons")
     * @Method({"GET"})
     */
    public function viewInstructorLessons(ManagerRegistry $doctrine)
    {

        $lessons = $doctrine->getRepository(Lesson::class)->findAll();


        return $this->render("lessons/lessonsByInstructor.html.twig",array('lessons' => $lessons));
    }

    /**
     * @Route("/viewStudentLessons", name="viewStudentLessons")
     * @Method({"GET"})
     */
    public function viewStudentLessons(ManagerRegistry $doctrine)
    {

        $lessons = $doctrine->getRepository(Lesson::class)->findAll();


        return $this->render("lessons/lessonsByStudent.html.twig",array('lessons' => $lessons));
    }


    /** 
     * @Route("/createLesson")
     * @Method({"GET","POST"})
     */
    public function newLesson(ManagerRegistry $doctrine, Request $request)
    {
        
        $form = $this->createFormBuilder()
        ->add('location', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('date', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('time', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('Student Email', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('Instructor Email', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
          'label' => 'Create',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

        //Find Instructor by email
        //Find student by email
        ///create lesson with details and link to instructor and student objects
        //persist to db
        //return to view all lessons


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
          $form_data = $form->getData();
          $student = new Student();
          $student->setName($form_data["name"]);
          $student->setEmail($form_data["email"]);
          $student->setPhone($form_data["Phone"]);


          $entityManager = $doctrine->getManager();
          $entityManager->persist($student);
          $entityManager->flush();

          
          return $this->redirectToRoute('viewLessons');
        }

        

        return $this->render('lessons/new.html.twig', array(
            'form' => $form->createView()
          ));
    }

    /** 
     * @Route("/lesson/edit/{id}", name="edit_lesson")
     * @Method({"GET","POST"})
     */
    public function editLesson(ManagerRegistry $doctrine, Request $request , int $id)
    {
        
      $lesson = $doctrine->getRepository(Lesson::class)->find($id);

        
      $form = $this->createFormBuilder($lesson)
      ->add('location', TextType::class, array('attr' => array('class' => 'form-control')))
      ->add('date', TextType::class, array('attr' => array('class' => 'form-control')))
      ->add('time', TextType::class, array('attr' => array('class' => 'form-control')))
      ->add('save', SubmitType::class, array(
        'label' => 'Create',
        'attr' => array('class' => 'btn btn-primary mt-3')
      ))
      ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

          $entityManager = $doctrine->getManager();
          $entityManager->flush();

          return $this->redirectToRoute('edit_lesson');
        }

        

        return $this->render('lesson/editLessons.html.twig', array(
            'form' => $form->createView()
          ));
    }

    /** 
     * @Route("/lesson/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, Request $request, int $id)
    {

      // get driving instructor
      $student = $doctrine->getRepository(Lesson::class)->find($id);


      $entityManager = $doctrine->getManager();
      $entityManager->remove($student);
      $entityManager->flush();

      $response = new Response();
      $response->send();

    }

}
