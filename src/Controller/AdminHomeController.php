<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Repository\PictureRepository;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin_home")
     */

    // La méthode appelle le fichier "twig" avec la méthode render, render prend le fichier twig et le transforme en html
    // le return permet de le renvoyer au navigateur
    public function homeAdmin(ArticleRepository $articleRepository, PictureRepository $pictureRepository){

        $lastArticles = $articleRepository->findBy([], ['id' => 'DESC'], 1);

        $picture = $pictureRepository->findBy([], ['id' => 'DESC'], 3);

        return $this->render('admin/home.html.twig',  [
            'lastArticles' => $lastArticles,
            'picture' => $picture
        ]);
    }
}