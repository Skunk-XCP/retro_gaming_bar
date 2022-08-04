<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontFaqController extends AbstractController
{
    /**
     * @Route("/faq", name="faq")
     */
    public function faq(){
        return $this->render('front/faq.html.twig');
    }
}