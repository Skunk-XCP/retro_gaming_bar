<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ArticleType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminArticleController extends AbstractController
{

    /**
     * @Route ("/admin/insert-article", name="admin_insert_article")
     */
    public function insertArticle(EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger)
    {

        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        // on donne à la variable qui contient le formulaire
        // une instance de la classe request
        // pour que le formulaire puisse récupérer toutes les données
        // des inputs et faire les setters sur  $article automatiquement
        $form->handleRequest($request);

        return $this->render("admin/insert_article.html.twig", [
            'form' => $form->createView(), 'article' => $article]);
    }

    /**
     * @Route("/admin/article/{id}", name="admin_article")
     */
    public function showArticle(ArticleRepository $articleRepository, $id)
    {
        // récupérer depuis la base de données un article
        // en fonction d'un ID
        // donc SELECT * FROM article where id = xxx

        // la classe Repository me permet de faire des requête SELECT
        // dans la table associée
        // la méthode permet de récupérer un élément par rapport à son id
        $article = $articleRepository->find($id);

        return $this->render("admin/article.html.twig", ['article' => $article]);
    }
}