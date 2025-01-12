<?php

namespace App\Repository;

use App\Entity\Caserne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Caserne>
 */
class CaserneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caserne::class);
    }

    public function getCamion(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.id , c.coorX as coorX, c.coorY as coorY,c.nbPompier,c.nbCamion ,  c.nom ')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Caserne[] Returns an array of Caserne objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Caserne
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
