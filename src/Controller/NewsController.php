<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    public function index(NewsRepository $newsRepository): Response
    {
        $allNews = $newsRepository->findAll();

        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'all_news' => $allNews
        ]);
    }

    #[Route('/news', name: 'add_news', methods: ['POST'])]
    public function addNews(): JsonResponse
    {
        return $this->json("");
    }

    #[Route('/news/{id}', name: 'update_news', methods: ['GET', 'POST'])]
    public function updateNews(NewsRepository $newsRepository, int $id): Response
    {
        $newsData = $newsRepository->find($id);

        return $this->render('news/post.html.twig', [
            'news_data' => $newsData
        ]);
    }

    #[Route('/news/top3', name: 'get_top3_authors_with_most_news', methods: ['GET'])]
    public function getTop3AuthorsWithMostNews(NewsRepository $newsRepository): JsonResponse
    {
        $top3AuthorsWithMostNewsData = $newsRepository->findTop3AuthorsWithMostNewsLastWeek();

        return $this->json($top3AuthorsWithMostNewsData);
    }

    #[Route('/news/{id}', name: 'get_news_by_id', methods: ['GET'])]
    public function getNewsById(NewsRepository $newsRepository, int $id): JsonResponse
    {
        $newsByIdData = $newsRepository->find($id);

        return $this->json($newsByIdData);
    }

    #[Route('/news/{author}/all', name: 'get_all_news_by_author_name', methods: ['GET'])]
    public function getAllNewsByAuthorName(NewsRepository $newsRepository, string $author): JsonResponse
    {
        $allNewsByAuthorNameData = $newsRepository->findAllNewsByAuthorName($author);

        return $this->json($allNewsByAuthorNameData);
    }
}
