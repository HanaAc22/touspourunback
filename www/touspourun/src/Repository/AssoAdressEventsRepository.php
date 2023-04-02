<?php

namespace App\Repository;

use App\Entity\AssoAdressEvents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssoAdressEvents>
 *
 * @method AssoAdressEvents|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssoAdressEvents|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssoAdressEvents[]    findAll()
 * @method AssoAdressEvents[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssoAdressEventsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssoAdressEvents::class);
    }

    public function save(AssoAdressEvents $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AssoAdressEvents $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AssoAdressEvents[] Returns an array of AssoAdressEvents objects
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

//    public function findOneBySomeField($value): ?AssoAdressEvents
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
