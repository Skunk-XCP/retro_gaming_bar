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

        $lastArticles = $articleRepository->findBy([], ['id' => 'DESC'], 1);

        $picture = $pictureRepository->findBy([], ['id' => 'DESC'], 3);

        return $this->render('front/home.html.twig', [
            'lastArticles' => $lastArticles,
            'picture' => $picture
        ]);
    }
}