<?php

namespace UrenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use UrenBundle\Entity\Enquiry;
use UrenBundle\Form\EnquiryType;

class ContactController extends Controller
{
    /**
     * @Route("/contact")
     */
    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $enquiry);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
          var_dump($form);
        }

        return $this->render('UrenBundle:Contact:contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

 }
