<?php

namespace App\Repository;

use App\Entity\BoostAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoostAnnonce>
 *
 * @method BoostAnnonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoostAnnonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoostAnnonce[]    findAll()
 * @method BoostAnnonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoostAnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoostAnnonce::class);
    }

//    /**
//     * @return BoostAnnonce[] Returns an array of BoostAnnonce objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BoostAnnonce
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
