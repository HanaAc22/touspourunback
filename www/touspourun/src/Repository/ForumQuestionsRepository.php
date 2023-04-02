<?php

namespace App\Repository;

use App\Entity\ForumQuestions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumQuestions>
 *
 * @method ForumQuestions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumQuestions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumQuestions[]    findAll()
 * @method ForumQuestions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumQuestions::class);
    }

    public function save(ForumQuestions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ForumQuestions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ForumQuestions[] Returns an array of ForumQuestions objects
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

//    public function findOneBySomeField($value): ?ForumQuestions
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
