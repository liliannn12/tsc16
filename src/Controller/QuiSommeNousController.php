<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuiSommeNousController extends AbstractController
{
    #[Route('/qui-somme-nous', name: 'presentation')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $presentationArticles = $articleRepository->findByCategoryName('PRESENTATION');

        return $this->render('qui_somme_nous/index.html.twig', [
            'presentationArticles' => $presentationArticles,
        ]);
    }
}
