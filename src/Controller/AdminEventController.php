<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminEventController extends AbstractController
{
    /**
     * @Route("/admin/event", name="admin_event")
     */
    public function eventAdmin(){
        return $this->render('admin/event.html.twig');
    }
}