<?php

namespace App\Repository;

use App\Entity\Cm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cm[]    findAll()
 * @method Cm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cm::class);
    }

    // /**
    //  * @return Cm[] Returns an array of Cm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cm
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
