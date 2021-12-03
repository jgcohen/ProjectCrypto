<?php

namespace App\Repository;

use App\Entity\Gains;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gains|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gains|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gains[]    findAll()
 * @method Gains[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GainsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gains::class);
    }

    // /**
    //  * @return Gains[] Returns an array of Gains objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gains
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
