<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminImageList extends AbstractController
{
    /**
     * @Route("/admin/images-list", name="images_list")
     */
    public function imagesList(ImageRepository $imageRepository){
        $image = $imageRepository->findAll();

        return $this->render('admin/images_list.html.twig', ['images' => $image]);
    }
}