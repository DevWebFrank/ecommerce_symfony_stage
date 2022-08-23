<?php

namespace App\Repository;

use App\Entity\ProductUpdate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductUpdate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductUpdate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductUpdate[]    findAll()
 * @method ProductUpdate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductUpdateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductUpdate::class);
    }

    // /**
    //  * @return ProductUpdate[] Returns an array of ProductUpdate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductUpdate
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
