<?php

namespace App\Repository;

use App\Entity\ProfilDeSortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfilDeSortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilDeSortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilDeSortie[]    findAll()
 * @method ProfilDeSortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilDeSortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilDeSortie::class);
    }

    // /**
    //  * @return ProfilDeSortie[] Returns an array of ProfilDeSortie objects
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
    public function findOneBySomeField($value): ?ProfilDeSortie
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
