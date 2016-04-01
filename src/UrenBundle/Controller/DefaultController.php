<?php

namespace UrenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UrenBundle\Entity\time_registration;
use UrenBundle\Form\time_registrationType;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $firstName = $this->getUser();
        $lastName = '';
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
        $em = $this->getDoctrine()->getManager();

        $time_registrations = $em->getRepository('UrenBundle:time_registration')->findBy(
            ['userId' => $this->get('security.token_storage')->getToken()->getUser()]
        );

        return $this->render('UrenBundle:Opvragen:opvragen.html.twig', array(
            'time_registrations' => $time_registrations,
        ));

    }

}
