<?php

namespace App\Repository;

use App\Entity\BalanceCategoryRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BalanceCategoryRelation>
 *
 * @method BalanceCategoryRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BalanceCategoryRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BalanceCategoryRelation[]    findAll()
 * @method BalanceCategoryRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BalanceCategoryRelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BalanceCategoryRelation::class);
    }

    public function save(BalanceCategoryRelation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BalanceCategoryRelation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BalanceCategoryRelation[] Returns an array of BalanceCategoryRelation objects
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

//    public function findOneBySomeField($value): ?BalanceCategoryRelation
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
