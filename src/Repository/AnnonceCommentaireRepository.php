<?php

namespace App\Repository;

use App\Entity\AnnonceCommentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnnonceCommentaire>
 *
 * @method AnnonceCommentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnonceCommentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnonceCommentaire[]    findAll()
 * @method AnnonceCommentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceCommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnonceCommentaire::class);
    }

//    /**
//     * @return AnnonceCommentaire[] Returns an array of AnnonceCommentaire objects
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

//    public function findOneBySomeField($value): ?AnnonceCommentaire
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
