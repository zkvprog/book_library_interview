<?php

namespace App\Repository;

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Book $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Book $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getMultiAuthorBook()
    {
        $sql = "SELECT id, name, COUNT(ba.author_id) as count FROM book LEFT JOIN book_author as ba ON id = ba.book_id GROUP BY id HAVING COUNT(ba.author_id) >= 2";
        $stmt = $this->_em->getConnection()->prepare($sql);
        $res = $stmt->executeQuery();
        return $res->fetchAllAssociative();
    }

    public function getMultiAuthorBookUsingDoctrine()
    {
        $qb = $this->createQueryBuilder('b');

        return $qb
            ->select('b.id, b.name')
            ->leftJoin('b.author', 'authors')
            ->addSelect('COUNT(authors) as total')
            ->groupBy('b')
            ->having($qb->expr()->gte($qb->expr()->count('authors'), 2))
            ->getQuery()
            ->getResult();
    }
}