<?php

namespace App\Controller\Admin;


use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/article', name :'admin_article_')]
class ArticleController extends AbstractController{

    #[Route('/', name:'index')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findAll();
        return $this->render('admin/article/index.html.twig', compact('article'));
    }

    #[Route('/ajout', name:'add')]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $article = new Article();

        $articleForm = $this->createForm(ArticleFormType::class, $article);

        $articleForm->handleRequest($request);

        if($articleForm->isSubmitted() && $articleForm->isValid()){
            
            $slug = $slugger->slug($article->getTitle());
            $article->setSlug($slug);

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Votre article a été ajouté avec succès');

            return $this->redirectToRoute('admin_article_index');
        }
        return $this->renderForm('admin/article/ajout.html.twig', compact('articleForm'));
    }

    #[Route('/edition/{id}', name:'edit')]
    public function edit(Article $article, Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $articleForm = $this->createForm(ArticleFormTypes::class, $article);

        $articleForm->handleRequest($request);

        if($articleForm->isSubmitted() && $articleForm->isValid()){


        $slug = $slugger->slug($article->getTitle());
        $article->setSlug($slug);

        $em->persist($article);
        $em->flush();

        $this->addFlash('success', 'Article modifié avec succès');

    }
    
    return $this->renderForm('admin/article/edition.html.twig', compact('articleForm'));
}

    #[Route('/suppression/{id}', name:'delete')]
    public function delete(Article $article, Request $request, EntityManager $em): Response
    {
        $em->remove($article);
        $em->flush();

        return $this->render('admin/article/index.html.twig');
    }
}