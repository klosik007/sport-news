<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function getAllAuthors()
    {
        $connection = $this->getEntityManager()->getConnection();

        $query = '
                SELECT DISTINCT author.id, author.name FROM author
                INNER JOIN news_author ON news_author.author_id = author.id;
        ';

        $result = $connection->executeQuery($query);

        return $result->fetchAllAssociative();
    }
}
