<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffType;
use App\Repository\StaffRepository;
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
    public function staffAdmin(StaffRepository $staffRepository){

        $staffs = $staffRepository->findBy([], ['id' => 'DESC'], 3);

        return $this->render('admin/staff.html.twig', [
            'staffs' => $staffs
        ]);
    }

    /**
     * @Route("/admin/create-staff", name="admin_create_staff")
     */
    public function createStaff(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $staffs = new Staff();

        $form = $this->createForm(StaffType::class, $staffs);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // alors on enregistre l'article en bdd
            $entityManager->persist($staffs);
            $entityManager->flush();

            $this->addFlash('success', 'Elément enregistré');
        }

        return $this->render('admin/create_staff.html.twig', [
            'form' => $form->createView(),
            'staffs' => $staffs
        ]);
    }

    /**
     * @Route("/admin/staff/update/{id}", name="admin_update_staff")
     */
    public function updateStaff($id, StaffRepository $staffRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $staffs = $staffRepository->find($id);

        $form = $this->createForm(StaffType::class, $staffs);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // alors on enregistre l'article en bdd
            $entityManager->persist($staffs);
            $entityManager->flush();

            $this->addFlash('success', 'Elément modifié');
        }

        return $this->render("admin/staff.html.twig", ['form' => $form->createView(), 'staffs' => $staffs]);
    }
}