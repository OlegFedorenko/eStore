<?php

namespace App\Repository;

use App\Entity\CategoryImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoryImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryImage[]    findAll()
 * @method CategoryImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoryImage::class);
    }

//    /**
//     * @return CategoryImage[] Returns an array of CategoryImage objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryImage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
