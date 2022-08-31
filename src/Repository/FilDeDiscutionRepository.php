<?php

namespace App\Repository;

use App\Entity\FilDeDiscution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FilDeDiscution|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilDeDiscution|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilDeDiscution[]    findAll()
 * @method FilDeDiscution[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilDeDiscutionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilDeDiscution::class);
    }

    // /**
    //  * @return FilDeDiscution[] Returns an array of FilDeDiscution objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilDeDiscution
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
