<?php

namespace App\Repository;

use App\Entity\BlogItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlogItem>
 *
 * @method BlogItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogItem[]    findAll()
 * @method BlogItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogItem::class);
    }

    public function save(BlogItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BlogItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBlogs(): array
        {
            return $this->createQueryBuilder('b')
                ->orderBy('b.createdAt', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }

//    /**
//     * @return BlogItem[] Returns an array of BlogItem objects
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

//    public function findOneBySomeField($value): ?BlogItem
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
