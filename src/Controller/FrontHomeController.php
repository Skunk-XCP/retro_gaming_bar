<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Repository\PictureRepository;

class FrontHomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ArticleRepository $articleRepository, PictureRepository $pictureRepository){

        $lastArticles = $articleRepository->getArticlesByCat("home",true, 1);

        $pictures = $pictureRepository->getHomePictures();

        return $this->render('front/home.html.twig', [
            'lastArticles' => $lastArticles,
            'pictures' => $pictures
        ]);
    }
}