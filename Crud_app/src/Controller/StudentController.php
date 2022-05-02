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

use App\Entity\Student;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="studentHome")
     * @Method({"GET"})
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig');
    }

    /** 
     * @Route("/saveStudent")
     */
    
    public function save(ManagerRegistry $doctrine) :Response
    {
        //Using entity manager
        $entityManager = $doctrine->getManager();

        //Object instantiation
        $student = new Student();

        //Setting object fields
        $student->setName('lee jordane');
        $student->setEmail('lj@gmail.com');
        $student->setPhone('0123456789');



        //Persist to DB
        $entityManager->persist($student);

        //execute query to save object
        $entityManager->flush();

        return new Response('saved a new student the name of them is '.$student->getName());

    }

        /** 
     * @Route("/createStudent")
     * @Method({"GET","POST"})
     */
    public function newStudent(ManagerRegistry $doctrine, Request $request)
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
          $student = new Student();
          $student->setName($form_data["name"]);
          $student->setEmail($form_data["email"]);
          $student->setPhone($form_data["Phone"]);


          $entityManager = $doctrine->getManager();
          $entityManager->persist($student);
          $entityManager->flush();

          
          return $this->redirectToRoute('allStudents');
        }

        

        return $this->render('student/new.html.twig', array(
            'form' => $form->createView()
          ));
    }

        /**
     * @Route("/viewStudent", name="allStudents")
     * @Method({"GET"})
     */
    public function viewStudents(ManagerRegistry $doctrine)
    {
       

        // array of driving instructors
        $students = $doctrine->getRepository(Student::class)->findAll();


        return $this->render("student/allStudent.html.twig",array('students' => $students));
    }


            /**
     * @Route("/editStudents", name="editStudents")
     * @Method({"GET"})
     */
    public function editStudents(ManagerRegistry $doctrine)
    {
       

        // array of driving instructors
        $students = $doctrine->getRepository(Student::class)->findAll();


        return $this->render("student/editStudents.html.twig",array('students' => $students));
    }

           /** 
     * @Route("/student/edit/{id}", name="edit_student")
     * @Method({"GET","POST"})
     */
    public function editStudent(ManagerRegistry $doctrine, Request $request , int $id)
    {
        
      $student = $doctrine->getRepository(Student::class)->find($id);

        $form = $this->createFormBuilder($student)
        ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('email', TextType::class, array(
          'required' => false,
          'attr' => array('class' => 'form-control')
        ))
        ->add('phone', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array(
          'label' => 'Update',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

          $entityManager = $doctrine->getManager();
          $entityManager->flush();

          return $this->redirectToRoute('editStudents');
        }

        

        return $this->render('student/edit.html.twig', array(
            'form' => $form->createView()
          ));
    }

          /** 
     * @Route("/student/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, Request $request, int $id)
    {

      // get driving instructor
      $student = $doctrine->getRepository(Student::class)->find($id);


      $entityManager = $doctrine->getManager();
      $entityManager->remove($student);
      $entityManager->flush();

      $response = new Response();
      $response->send();

    }

    
}

