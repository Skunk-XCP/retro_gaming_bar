<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminEventsController extends AbstractController
{
    /**
     * @Route("/admin/events", name="admin_events")
     */
    public function eventsAdmin(){
        return $this->render('admin/events.html.twig');
    }
}