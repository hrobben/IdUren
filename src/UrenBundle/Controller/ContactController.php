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
            // Perform some action, such as sending an email
            $message = \Swift_Message::newInstance()
                ->setSubject('Contact enquiry from uren')
                ->setFrom('hrobben@robusoft.com')
               // ->setTo($this->container->getParameter('uren.emails.contact_email'))
                ->setTo('hrobben@robusoft.nl')
                ->setBody($this->renderView('UrenBundle:Contact:contactEmail.txt.twig', array('enquiry' => $enquiry)));
            $this->get('mailer')->send($message);

//                $this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
            $this->get('session')->getFlashBag()->add('uren-notice', 'Your contact enquiry was successfully sent. Thank you!');

            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            return $this->redirect($this->generateUrl('uren_contact_contact'));
        }

        return $this->render('UrenBundle:Contact:contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

 }
