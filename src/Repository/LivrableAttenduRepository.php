<?php

namespace App\Repository;

use App\Entity\LivrableAttendu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LivrableAttendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivrableAttendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivrableAttendu[]    findAll()
 * @method LivrableAttendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivrableAttenduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivrableAttendu::class);
    }

    // /**
    //  * @return LivrableAttendu[] Returns an array of LivrableAttendu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LivrableAttendu
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
