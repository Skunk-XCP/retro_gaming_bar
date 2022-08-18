<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController {

    /**
     * @Route("/admin/insert-category", name="admin_insert_category")
     */
    public function insertCategory(EntityManagerInterface $entityManager, Request $request)
    {
        $category = new Category();

        $form = $this->createForm(Category::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Categorie enregistrée');
        }
        return $this->render("admin/update_category.html.twig", [
            'form' => $form->createView()]);
    }

    /**
     * @Route("/admin/category-list", name="admin_category_list")
     */
    public function showCategory(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render("Admin/categories_list.html.twig", [
            'categories' => $categories]);
    }

    /**
     * @Route("/admin/category/{id}", name="admin_show_category")
     */
    public function showCategorySingle($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        return $this->render('Admin/show_category.html.twig', [
            'category' => $category]);
    }

    public function deleteCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        if (!is_null($category)) {

            $entityManager->remove($category);
            $entityManager->flush();

            $this->addFlash('success','La catégorie a été supprimée');
            return $this->redirectToRoute('admin_category_list');
        } else {

            $this->addFlash('error',"Element introuvable");
        }
    }
}
