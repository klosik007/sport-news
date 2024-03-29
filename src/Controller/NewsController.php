<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\AuthorRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    public function index(NewsRepository $newsRepository): Response
    {
        $allNews = $newsRepository->findAll();

        return $this->render('news/index.html.twig', [
            'all_news' => $allNews
        ]);
    }

    #[Route('/news', name: 'add_news', methods: ['GET', 'POST'])]
    public function addNews(
        Request $request,
        EntityManagerInterface $entityManager,
        AuthorRepository $authorRepository
    ): Response {
        $authors = $authorRepository->getAllAuthors();

        if ($request->getMethod() == Request::METHOD_POST)
        {
            $title = $request->request->get('news_title');
            $text = $request->request->get('news_text');
            $authorsFromForm = $request->request->all()['news_authors'] ?? [];

            if (empty($title) || empty($text) || empty($authorsFromForm) || strlen($title) > 255)
            {
                //practically rendering the same post.html page
                return $this->render('news/post.html.twig', ['authors' => $authors]);
            }

            $news = new News();
            $news->setTitle($title);
            $news->setText($text);
            $news->setCreatedAt(\DateTimeImmutable::createFromMutable(date_create()));

            foreach ($authorsFromForm as $authorId)
            {
                $author = $authorRepository->find($authorId);
                $news->addAuthor($author);
            }

            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_page');
        }

        return $this->render('news/post.html.twig', ['authors' => $authors]);
    }

    #[Route('/news/top3', name: 'get_top3_authors_with_most_news', methods: ['GET'])]
    public function getTop3AuthorsWithMostNews(NewsRepository $newsRepository): JsonResponse
    {
        $top3AuthorsWithMostNewsData = $newsRepository->findTop3AuthorsWithMostNewsLastWeek();

        return $this->json($top3AuthorsWithMostNewsData);
    }

    #[Route('/news/{id}', name: 'show_news', methods: ['GET'])]
    public function showNews(
        NewsRepository $newsRepository,
        int $id
    ): Response {
        $newsData = $newsRepository->find($id);

        return $this->render('news/show.html.twig', [
            'news_data' => $newsData
        ]);
    }

    #[Route('/news/{id}/edit', name: 'edit_news', methods: ['GET', 'POST'])]
    public function updateNews(
        NewsRepository $newsRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        int $id
    ): Response {
        $newsData = $newsRepository->find($id);

        if ($request->getMethod() == Request::METHOD_POST)
        {
            $title = $request->request->get('news_title');
            $text = $request->request->get('news_text');

            if (empty($title) || empty($text) || strlen($title) > 255)
            {
                //practically rendering the same post.html page
                return $this->render('news/post.html.twig', [
                    'news_data' => $newsData
                ]);
            }

            $newsData->setTitle($title);
            $newsData->setText($text);
            $newsData->setCreatedAt($newsData->getCreatedAt());

            $entityManager->persist($newsData);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_page');
        }

        return $this->render('news/post.html.twig', [
            'news_data' => $newsData
        ]);
    }

    #[Route('/news/{id}/json', name: 'get_news', methods: ['GET'])]
    public function getNews(
        NewsRepository $newsRepository,
        int $id
    ): JsonResponse {
        $newsData = $newsRepository->find($id);

        return $this->json($newsData);
    }

    #[Route('/news/{author}/all', name: 'get_all_news_by_author_name', methods: ['GET'])]
    public function getAllNewsByAuthorName(
        NewsRepository $newsRepository,
        string $author
    ): JsonResponse {
        $allNewsByAuthorNameData = $newsRepository->findAllNewsByAuthorName($author);

        return $this->json($allNewsByAuthorNameData);
    }
}