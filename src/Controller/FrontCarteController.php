<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontCarteController extends AbstractController
{
    /**
     * @Route("/carte", name="carte")
     */
    public function carte(){
        return $this->render('front/carte.html.twig');
    }
}