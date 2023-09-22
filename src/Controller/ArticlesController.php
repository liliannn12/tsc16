<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    #[Route('/articles/{categoryId}', name: 'app_articles')]
    public function index(int $categoryId, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->createQueryBuilder('a')
        ->join('a.category', 'c')
        ->where('c.id = :categoryId')
        ->setParameter('categoryId', $categoryId)
        ->getQuery()
        ->getResult();

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}

