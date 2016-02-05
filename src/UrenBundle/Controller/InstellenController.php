<?php

namespace UrenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class InstellenController extends Controller
{
    /**
     * @Route("/instellen")
     */
    public function instellenAction()
    {
        return $this->render('UrenBundle:Instellen:instellen.html.twig');
    }

 }
