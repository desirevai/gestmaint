<?php

namespace App\Repository;

use App\Entity\Directions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Directions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Directions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Directions[]    findAll()
 * @method Directions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Directions::class);
    }

    // /**
    //  * @return Directions[] Returns an array of Directions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Directions
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
