<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

        /**
     * @Route("/getStarted", name="getStarted")
     * @Method({"GET"})
     */
    public function getStarted(): Response
    {
        return $this->render('default/start.html.twig');
    }

    /**
     * @Route("/edt", name="edt")
     * @Method({"GET"})
     */
    public function lessons(): Response
    {
        return $this->render('default/lessons.html.twig');
    }

    /**
     * @Route("/prices", name="prices")
     * @Method({"GET"})
     */
    public function prices(): Response
    {
        return $this->render('default/prices.html.twig');
    }
}
