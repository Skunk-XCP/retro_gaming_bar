<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontEventController extends AbstractController
{
    /**
     * @Route("/event", name="event")
     */
    public function event(){
        return $this->render('front/event.html.twig');
    }
}