<?php

namespace App\Repository;

use App\Entity\AnnonceEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnnonceEvaluation>
 *
 * @method AnnonceEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnonceEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnonceEvaluation[]    findAll()
 * @method AnnonceEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnonceEvaluation::class);
    }

//    /**
//     * @return AnnonceEvaluation[] Returns an array of AnnonceEvaluation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AnnonceEvaluation
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
