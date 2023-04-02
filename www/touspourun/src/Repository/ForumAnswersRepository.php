<?php

namespace App\Repository;

use App\Entity\ForumAnswers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumAnswers>
 *
 * @method ForumAnswers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumAnswers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumAnswers[]    findAll()
 * @method ForumAnswers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumAnswersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumAnswers::class);
    }

    public function save(ForumAnswers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ForumAnswers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ForumAnswers[] Returns an array of ForumAnswers objects
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

//    public function findOneBySomeField($value): ?ForumAnswers
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
