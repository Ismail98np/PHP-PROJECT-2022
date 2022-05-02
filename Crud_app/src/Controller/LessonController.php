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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $instructor->setName('Tom Omotoso 2');
        $instructor->setEmail('TO@gmail.com');
        $instructor->setPhoneNumber('0123456789');
        $instructor->setExperience(2);

        $student->setName('lee jordane');
        $student->setEmail('lj@gmail.com');
        $student->setPhone('0123456789');


        $lesson->setLocation('Tallaght');
        $lesson->setTime('10pm');
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

        return $this->render("lesson/viewLessons.html.twig",array('lessons' => $lessons));
    }

    /**
     * @Route("/viewInstructorLessons", name="viewInstructorLessons")
     * @Method({"GET"})
     */
    public function viewInstructorLessons(ManagerRegistry $doctrine , Request $request)
    {

        $lessons = [];

        $form = $this->createFormBuilder()

        ->add('Instructor_Email', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('search', SubmitType::class, array(
          'label' => 'Search',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();
    

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {

            $form_data = $form->getData();
            $instrcutorLessons = $doctrine->getRepository(Lesson::class)->findBy(array('DrivingIntsructorEmail' => $form_data["Instructor_Email"]));
            $lessons = $instrcutorLessons;


            return $this->render('lesson/instructorLessons.html.twig',array(
                'lessons' => $lessons));
          }


        return $this->render("lesson/lessonsByInstructor.html.twig",array(
            'lessons' => $lessons,
            'form' => $form->createView()

        ));
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
        ->add('location',TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('date', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('time', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('Student_Email', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('Instructor_Email', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
          'label' => 'Create',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();
    

        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()) {
          $form_data = $form->getData();

        //Find Instructor by email
        $instrcutor = $doctrine->getRepository(DrivingInstructor::class)->findOneBy(array('email' => $form_data["Instructor_Email"]));

        //Find student by email
        $student = $doctrine->getRepository(Student::class)->findOneBy(array('email' => $form_data["Student_Email"]));


        ///create lesson with details and link to instructor and student objects
        $lesson = new Lesson();
        $lesson->setLocation($form_data["location"]);
        $lesson->setTime($form_data["time"]);
        $lesson->setDate($form_data["date"]);
        $lesson->setPrice(45);
        $lesson->setDrivingInstructor($instrcutor);
        $lesson->setDrivingIntsructorEmail($instrcutor->getEmail());
        $lesson->setStudent($student);
        $lesson->setStudentEmail($student->getEmail());


        //persist to db
        $entityManager = $doctrine->getManager();
        $entityManager->persist($lesson);
        $entityManager->flush();

        //return to view all lessons
          return $this->redirectToRoute('viewLessons');
        }

        

        return $this->render('lesson/new.html.twig', array(
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
      ->add('location', ChoiceType::class, array('attr' => array('class' => 'form-control')))
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
