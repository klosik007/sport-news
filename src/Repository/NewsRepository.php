<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @extends ServiceEntityRepository<News>
 *
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function findAllNewsByAuthorName(string $author): array
    {
        $connection = $this->getEntityManager()->getConnection();

        $query = '
                SELECT news.id, news.title, news.text, news.created_at FROM news
                INNER JOIN news_author ON news_author.news_id = news.id 
                INNER JOIN author ON author.id = news_author.author_id 
                WHERE author.name=:author
        ';

        $result = $connection->executeQuery($query, ['author' => $author]);

        return $result->fetchAllAssociative();
    }

    public function findTop3AuthorsWithMostNewsLastWeek(): array
    {
        $connection = $this->getEntityManager()->getConnection();

        $query = '
                SELECT author.name, COUNT(author.name) AS news_count FROM author
                INNER JOIN news_author ON news_author.author_id = author.id
                INNER JOIN news on news.id = news_author.news_id
                WHERE news.created_at BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK) AND NOW()
                GROUP BY author.name 
                ORDER BY COUNT(author.name) DESC 
                LIMIT 3;
        ';

        $result = $connection->executeQuery($query);

        return $result->fetchAllAssociative();
    }
}
