<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Picture;
use App\Form\PictureType;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PictureRepository;


class AdminPictureController extends AbstractController
{

    /**
     * @Route("/admin/insert-picture", name="admin_insert_picture")
     */
    public function insertPicture(PictureRepository $pictureRepository, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $pictures = new Picture();

        $form = $this->createForm(PictureType::class, $pictures);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->get('name')->getData();

            $originalFilename = pathinfo($name->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);

            $newFilename = $safeFilename . "-" . uniqid() . '.' . $name->guessExtension();

            $name->move($this->getParameter('images_directory'), $newFilename);

            $pictures->setName($newFilename);

            // alors on enregistre l'image en bdd
            $entityManager->persist($pictures);
            $entityManager->flush();

            $this->addFlash('success', 'Image enregistrée');
        }

        return $this->render("admin/insert_picture.html.twig", [
            'form' => $form->createView(),
            'pictures' => $pictures
        ]);
    }

    /**
     * @Route("/admin/picture/update/{id}", name="admin_update_picture")
     */
    public function updatePicture($id, PictureRepository $pictureRepository, EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger)
    {
        $pictures = $pictureRepository->find($id);

        $form = $this->createForm(PictureType::class, $pictures);

        // on donne à la variable qui contient le formulaire
        // une instance de la classe request
        // pour que le formulaire puisse récupérer toutes les données
        // des inputs et faire les setters sur $picture automatiquement
        $form->handleRequest($request);


        // si le formulaire a été posté et que les données sont valides (valeurs
        // des inputs correspondent à ce qui est attendu en bdd pour la table picture)
        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->get('name')->getData();

            $originalFilename = pathinfo($name->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);

            $newFilename = $safeFilename . "-" . uniqid() . '.' . $name->guessExtension();

            $name->move($this->getParameter('images_directory'), $newFilename);

            $pictures->setName($newFilename);

            // alors on enregistre l'image en bdd
            $entityManager->persist($pictures);
            $entityManager->flush();

            $this->addFlash('success', 'Image enregistrée');
        }

        // j'affiche mon twig, en lui passant la variable
        // form, qui contient la vue du formulaire, c'est à dire,
        // le résultat de la méthode createView de la variable $form
        return $this->render("admin/update_image.html.twig", [
            'form' => $form->createView(),
            'picture' => $pictures]);
    }

    /**
     * Route("/admin/picture/delete/{id}", name="admin_delete_picture")
     */

    public function deletePicture($id, PictureRepository $pictureRepository, EntityManagerInterface $entityManager)
    {
        $pictures = $pictureRepository->find($id);

        if (!is_null($pictures)){
            $entityManager->remove($pictures);
            $entityManager->flush();

            $this->addFlash('success', "L'image a été supprimée");
        }  else {

            $this->addFlash('error', "Element introuvable");
        }
    }
}