<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCarteController extends AbstractController
{
    /**
     * @Route("/admin/carte", name="admin_carte")
     */
    public function carteAdmin(){
        return $this->render('admin/carte.html.twig');
    }
}