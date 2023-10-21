<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Youtube>
 *
 * @method Youtube|null find($id, $lockMode = null, $lockVersion = null)
 * @method Youtube|null findOneBy(array $criteria, array $orderBy = null)
 * @method Youtube[]    findAll()
 * @method Youtube[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
   public const PAGINATOR_PER_PAGE = 2;
   public function __construct(ManagerRegistry $registry)
   {
      parent::__construct($registry, Video::class);
   }

   public function findPaginated(int $offset) : Paginator
   {
      $query = $this->createQueryBuilder('c')
         ->setMaxResults(self::PAGINATOR_PER_PAGE)
         ->setFirstResult($offset)
         ->getQuery()
      ;

      return new Paginator($query);
   }

   public function findByCategory (string $category, int $offset) : Paginator
   {
      $query = $this->createQueryBuilder('c')
         ->andWhere('c.category = :category')
         ->setParameter('category', $category)
         ->setMaxResults(self::PAGINATOR_PER_PAGE)
         ->setFirstResult($offset)
         ->getQuery()
      ;

      return new Paginator($query);
   }
}
