<?php

namespace App\Repository;

use App\Entity\FarmAnimalGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FarmAnimalGroup>
 *
 * @method FarmAnimalGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method FarmAnimalGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method FarmAnimalGroup[]    findAll()
 * @method FarmAnimalGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FarmAnimalGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FarmAnimalGroup::class);
    }

    public function save(FarmAnimalGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FarmAnimalGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FarmAnimalGroup[] Returns an array of FarmAnimalGroup objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FarmAnimalGroup
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
