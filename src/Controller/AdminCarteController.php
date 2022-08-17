<?php

namespace App\Controller;
use App\Repository\DrinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminCarteController extends AbstractController
{
    /**
     * @Route("/admin/carte", name="admin_carte")
     */
    public function carteAdmin(){
        return $this->render('admin/carte.html.twig');
    }

    /**
     * @Route("/admin/insert-drink", name="admin_insert_drink")
     */
    public function insertDrink(DrinkRepository $drinkRepository,Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager)
    {
        $drink = new Drink();

        $form = $this->createForm(DrinkType::class, $drink);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->get('name')->getData();

            $originalFilename = pathinfo($name->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);

            $newFilename = $safeFilename . "-" . uniqid() . '.' . $name->guessExtension();

            $name->move($this->getParameter('images_directory'), $newFilename);

            $drink->setName($newFilename);

            // alors on enregistre l'article en bdd
            $entityManager->persist($drink);
            $entityManager->flush();

            $this->addFlash('success', 'Elément enregistré');
        }
        return $this->render("admin/insert_drink.html.twig", [
            'form' => $form->createView(),
            'drink' => $drink]);
    }

    /**
     * @Route("/admin/drink/update/{id}", name="admin_update_drink")
     */
    public function updateDrink($id, EntityManagerInterface $entityManager, DrinkRepository $drinkRepository, SluggerInterface $slugger)
    {
        $drink = $drinkRepository->find($id);

        $form = $this->createForm(DrinkType::class, $drink);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->get('name')->getData();

            $originalFilename = pathinfo($name->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);

            $newFilename = $safeFilename . "-" . uniqid() . '.' . $name->guessExtension();

            $name->move($this->getParameter('images_directory'), $newFilename);

            $drink->setName($newFilename);

            // alors on enregistre l'article en bdd
            $entityManager->persist($drink);
            $entityManager->flush();

            $this->addFlash('success', 'Elément enregistré');
        }
        return $this->render("admin/update_drink.html.twig", [
            'form' => $form->createView(),
            'drink' => $drink]);
    }
}