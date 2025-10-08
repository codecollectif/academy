<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Scienta\DoctrineJsonFunctions\Query\AST\Functions\Mysql\JsonExtract;

/**
 * @extends ServiceEntityRepository<Page>
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    public function findByResearch(string $value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('JSON_SEARCH(p.titleJson, \'all\', :val) is not null')
            ->setParameter('val', "%$value%")
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByResearchAndCategory(string $query, string $category): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.category', 'c')
            ->andWhere('c.id = :category')
            ->andWhere('JSON_SEARCH(p.titleJson, \'all\', :q) is not null')
            ->setParameter('category', "$category")
            ->setParameter('q', "%$query%")
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //     /**
    //     * @return Page[] Returns an array of Page objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Page
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
