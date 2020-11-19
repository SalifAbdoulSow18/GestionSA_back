<?php

namespace App\Repository;

use App\Entity\CompetencesValides;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompetencesValides|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetencesValides|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetencesValides[]    findAll()
 * @method CompetencesValides[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetencesValidesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetencesValides::class);
    }

    // /**
    //  * @return CompetencesValides[] Returns an array of CompetencesValides objects
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
    public function findOneBySomeField($value): ?CompetencesValides
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
