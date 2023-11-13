<?php

namespace App\Repository;

use App\Entity\PlanBoost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanBoost>
 *
 * @method PlanBoost|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanBoost|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanBoost[]    findAll()
 * @method PlanBoost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanBoostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanBoost::class);
    }

//    /**
//     * @return PlanBoost[] Returns an array of PlanBoost objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlanBoost
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
