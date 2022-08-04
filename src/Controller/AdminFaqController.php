<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminFaqController extends AbstractController
{
    /**
     * @Route("/admin/faq", name="admin_faq")
     */
    public function faqAdmin(){
        return $this->render('admin/faq.html.twig');
    }
}