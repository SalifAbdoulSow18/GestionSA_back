<?php

namespace App\Repository;

use App\Entity\LivrableAttenduApprenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LivrableAttenduApprenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivrableAttenduApprenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivrableAttenduApprenant[]    findAll()
 * @method LivrableAttenduApprenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivrableAttenduApprenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivrableAttenduApprenant::class);
    }

    // /**
    //  * @return LivrableAttenduApprenant[] Returns an array of LivrableAttenduApprenant objects
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
    public function findOneBySomeField($value): ?LivrableAttenduApprenant
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
