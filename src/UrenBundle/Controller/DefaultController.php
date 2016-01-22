<?php

namespace UrenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $firstName = 'Henry';
        $lastName = 'Robben';
        return $this->render('UrenBundle:Default:index.html.twig', [
            'firstName' => $firstName,
            'lastName' => $lastName
        ]);
    }

    /**
     * @Route("/invoeren")
     */
    public function invoerAction()
    {
        return $this->render('UrenBundle:Invoeren:invoeren.html.twig');
    }

    /**
     * @Route("/opvragen")
     */
    public function opvraagAction()
    {
        return $this->render('UrenBundle:Opvragen:opvragen.html.twig');
    }

}
