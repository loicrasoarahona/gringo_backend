<?php

namespace App\Repository;

use App\Entity\AnnoncePhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnnoncePhoto>
 *
 * @method AnnoncePhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnoncePhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnoncePhoto[]    findAll()
 * @method AnnoncePhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnoncePhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnoncePhoto::class);
    }

//    /**
//     * @return AnnoncePhoto[] Returns an array of AnnoncePhoto objects
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

//    public function findOneBySomeField($value): ?AnnoncePhoto
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
