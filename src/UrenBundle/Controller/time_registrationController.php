<?php

namespace UrenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UrenBundle\Entity\time_registration;
use UrenBundle\Form\time_registrationType;

/**
 * time_registration controller.
 *
 * @Route("/time_registration")
 */
class time_registrationController extends Controller
{
    /**
     * Lists all time_registration entities.
     *
     * @Route("/", name="time_registration_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $time_registrations = $em->getRepository('UrenBundle:time_registration')->findAll();

        return $this->render('time_registration/index.html.twig', array(
            'time_registrations' => $time_registrations,
        ));
    }

    /**
     * Creates a new time_registration entity.
     *
     * @Route("/new", name="time_registration_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $time_registration = new time_registration();
        $form = $this->createForm('UrenBundle\Form\time_registrationType', $time_registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($time_registration);
            $em->flush();

            return $this->redirectToRoute('time_registration_show', array('id' => $time_registration->getId()));
        }

        return $this->render('time_registration/new.html.twig', array(
            'time_registration' => $time_registration,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a time_registration entity.
     *
     * @Route("/{id}", name="time_registration_show")
     * @Method("GET")
     */
    public function showAction(time_registration $time_registration)
    {
        $deleteForm = $this->createDeleteForm($time_registration);

        return $this->render('time_registration/show.html.twig', array(
            'time_registration' => $time_registration,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing time_registration entity.
     *
     * @Route("/{id}/edit", name="time_registration_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, time_registration $time_registration)
    {
        $deleteForm = $this->createDeleteForm($time_registration);
        $editForm = $this->createForm('UrenBundle\Form\time_registrationType', $time_registration);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($time_registration);
            $em->flush();

            return $this->redirectToRoute('time_registration_edit', array('id' => $time_registration->getId()));
        }

        return $this->render('time_registration/edit.html.twig', array(
            'time_registration' => $time_registration,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a time_registration entity.
     *
     * @Route("/{id}", name="time_registration_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, time_registration $time_registration)
    {
        $form = $this->createDeleteForm($time_registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($time_registration);
            $em->flush();
        }

        return $this->redirectToRoute('time_registration_index');
    }

    /**
     * Creates a form to delete a time_registration entity.
     *
     * @param time_registration $time_registration The time_registration entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(time_registration $time_registration)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('time_registration_delete', array('id' => $time_registration->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
