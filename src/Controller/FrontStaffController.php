<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class FrontStaffController extends AbstractController
{
    /**
     * @Route("/staff", name="staff")
     */
    public function staff(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->getArticlesByCat("staff", true);

        return $this->render('front/staff.html.twig', [
            'articles' => $articles
        ]);
    }
}