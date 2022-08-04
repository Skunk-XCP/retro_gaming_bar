<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontEventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function events(){
        return $this->render('front/events.html.twig');
    }
}