<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Doctrine\ORM\EntityManager;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/category', name:'admin_category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findAll([],[]);
        return $this->render('admin/category/index.html.twig', compact('category'));
    }

    #[Route('/ajout', name:'add')]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $category = new Category();

        $categoryForm = $this->createForm(CategoryFormType::class, $category);

        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted() && $categoryForm->isValid()){
            
            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug);

            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Votre catégorie a été ajouté avec succès');

            return $this->redirectToRoute('admin_category_index');
        }
        return $this->renderForm('admin/category/ajout.html.twig', compact('categoryForm'));
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Category $category, Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        
        $categoryForm = $this->createForm(CategoryFormType::class, $category);

        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted() && $categoryForm->isValid()){
            
            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug);
            $category->setName($categoryForm->get('name')->getData());

            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Catégorie modifié avec succès');

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->renderForm('admin/category/edit.html.twig', compact('categoryForm'));
    }

    #[Route('/suppression/{id}', name:'delete')]
    public function delete(Category $category, Request $request, EntityManagerInterface $em): Response
    {
        $em->remove($category);
        $em->flush();

        return $this->render('admin/category/index.html.twig');
    }
}
