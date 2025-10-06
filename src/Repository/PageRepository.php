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
            ->andWhere('JSON_EXTRACT(p.titleJson, :key) LIKE :val')
            ->setParameter('val', "%$value%")
            ->setParameter('key', '$.fr')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

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
