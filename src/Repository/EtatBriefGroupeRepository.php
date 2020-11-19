<?php

namespace App\Repository;

use App\Entity\EtatBriefGroupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatBriefGroupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatBriefGroupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatBriefGroupe[]    findAll()
 * @method EtatBriefGroupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatBriefGroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatBriefGroupe::class);
    }

    // /**
    //  * @return EtatBriefGroupe[] Returns an array of EtatBriefGroupe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtatBriefGroupe
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
