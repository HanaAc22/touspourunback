<?php

namespace App\Repository;

use App\Entity\CourseCategoryJoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CourseCategoryJoin>
 *
 * @method CourseCategoryJoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseCategoryJoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseCategoryJoin[]    findAll()
 * @method CourseCategoryJoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseCategoryJoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourseCategoryJoin::class);
    }

    public function save(CourseCategoryJoin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CourseCategoryJoin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CourseCategoryJoin[] Returns an array of CourseCategoryJoin objects
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

//    public function findOneBySomeField($value): ?CourseCategoryJoin
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
