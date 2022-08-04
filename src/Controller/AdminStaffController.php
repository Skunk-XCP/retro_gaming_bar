<?php

namespace App\Controller;
use App\Repository\StaffRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminStaffController extends AbstractController
{
    /**
     * @Route("/admin/staff", name="admin_staff")
     */
    public function staffAdmin(){
        return $this->render('admin/staff.html.twig');
    }


    public function createStaff(Request $request)
    {
        $staff = new Staff();

        $form = $this->createForm(StaffType::class, $staff);

        $form->handleRequest($request);

        return $this->render('admin/staff.html.twig', ['form' => $form->createView()]);
    }


    public function updateStaff($id, StaffRepository $staffRepository, Request $request)
    {
        $staff = $staffRepository->find($id);

        $form = $this->createForm(StaffType::class, $staff);

        $form->handleRequest($request);

        return $this->render("admin/staff.html.twig", ['form' => $form->createView(), 'staff' => $staff]);
    }
}