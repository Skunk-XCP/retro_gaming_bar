<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\StaffType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminStaffController extends AbstractController
{
    /**
     * @Route("/admin/staff", name="admin_staff")
     */
    public function staffAdmin(ArticleRepository $articleRepository){

        $articles = $articleRepository->getArticlesByCat("staff", true);

        return $this->render('admin/staff.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/admin/create-staff", name="admin_create_staff")
     */
    public function createStaff(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $article = new Article();

        $form = $this->createForm(StaffType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // alors on enregistre l'article en bdd
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Elément enregistré');
        }

        return $this->render('admin/create_staff.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }

    /**
     * @Route("/admin/staff/update/{id}", name="admin_update_staff")
     */
    public function updateStaff($id, ArticleRepository $articleRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $article = $articleRepository->find($id);

        $form = $this->createForm(StaffType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // alors on enregistre l'article en bdd
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Elément modifié');
        }

        return $this->render("admin/staff.html.twig", [
            'form' => $form->createView(),
            'article' => $article]);
    }
}