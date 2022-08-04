<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class FrontStaffController extends AbstractController
{
    /**
     * @Route("/staff", name="staff")
     */
    public function staff()
    {
        return $this->render('front/staff.html.twig');
    }
}