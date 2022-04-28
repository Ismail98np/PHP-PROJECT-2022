<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\County;

class DrivingInstructorController extends AbstractController
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index(): Response
    {
        return new Response("<html><body>this webpage is working fine</body></html>");
    }
    /** 
    
     * @Route("/save")
     */
    /*
    public function save(ManagerRegistry $doctrine) :Response
    {
        $entityManager = $doctrine->getManager();

        $product = new County();
        $product->setName('new one');


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response($product->getId());

    }*/
    
}
