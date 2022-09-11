<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\FaqType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminFaqController extends AbstractController
{
    /**
     * @Route("/admin/faq", name="admin_faq")
     */
    public function faqAdmin(FaqRepository $faqRepository){

        $questions = $faqRepository->findAll();

        return $this->render('admin/faq.html.twig', [
            'questions' => $questions
        ]);
    }

    /**
     * @Route("/admin/insert-question", name="admin_insert_question")
     */
    public function insertQuestion(EntityManagerInterface $entityManager, Request $request)
    {

        $questions = new Faq();

        $form = $this->createForm(FaqType::class, $questions);

        $form->handleRequest($request);

        if($form->IsSubmitted() && $form->isValid()) {

            $entityManager->persist($questions);
            $entityManager->flush();

            $this->addFlash('success', 'Question enregistrée');
        }

        return $this->render('admin/insert_question.html.twig', [
            'form' => $form->createView(),
            'questions' => $questions
        ]);
    }
//
//    /**
//     * @Route("/admin/question/{id}", name="admin_question")
//     */
//    public function showQuestion($id, FaqRepository $faqRepository)
//    {
//        $questions = $faqRepository->find($id);
//
//        return $this->render('admin/question.html.twig', [
//            'questions' => $questions
//        ]);
//    }

    /**
     * @Route("/admin/question/update", name="admin_update_question")
     */
    public function updateQuestion($id, FaqRepository $faqRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $questions = $faqRepository->find($id);

        $form = $this->createForm(FaqType::class, $questions);

        $form->handleRequest($request);

        if($form->IsSubmitted() && $form->isValid()) {

            $entityManager->persist($questions);
            $entityManager->flush();

            $this->addFlash('success', 'Question enregistrée');
        }

        return $this->render('admin/update_question.html.twig', [
            'form' => $form->createView(),
            'questions' => $questions
        ]);
    }

    /**
     *@Route("/admin/question/delete/{id}", name="admin_delete_question")
     */
    public function deleteQuestion($id, FaqRepository $faqRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $questions = $faqRepository->find($id);

        if (!is_null($questions)){

            $entityManager->remove($questions);
            $entityManager->flush();

            $this->addFlash('success', "La question a été supprimée");
        } else {

            $this->addFlash('error', "Element introuvable");
        }
    }
}