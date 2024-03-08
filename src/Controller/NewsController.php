<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    public function index(): Response
    {
        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
        ]);
    }

    #[Route('/news', name: 'add_news', methods: ['POST'])]
    public function addNews(): JsonResponse
    {
        return $this->json("");
    }

    #[Route('/news/{id}', name: 'update_news', methods: ['PATCH'])]
    public function updateNews(int $id): JsonResponse
    {
        return $this->json("");
    }

    #[Route('/news/{id}', name: 'get_news_by_id', methods: ['GET'])]
    public function getNewsById(int $id): JsonResponse
    {
        return $this->json("");
    }

    #[Route('/news/{author}/all', name: 'get_all_news_by_author_name', methods: ['GET'])]
    public function getAllNewsByAuthorName(string $author): JsonResponse
    {
        return $this->json("");
    }

    #[Route('/news/top3', name: 'get_top3_authors_with_most_news', methods: ['GET'])]
    public function getTop3AuthorsWithMostNews(): JsonResponse
    {
        return $this->json("");
    }
}