<?php

namespace App\Repository;

use App\Entity\AssoAddressEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssoAddressEvent>
 *
 * @method AssoAddressEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssoAddressEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssoAddressEvent[]    findAll()
 * @method AssoAddressEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssoAddressEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssoAddressEvent::class);
    }

    public function save(AssoAddressEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AssoAddressEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AssoAddressEvent[] Returns an array of AssoAddressEvent objects
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

//    public function findOneBySomeField($value): ?AssoAddressEvent
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
