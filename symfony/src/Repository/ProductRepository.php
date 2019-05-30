<?php

namespace App\Repository;

use App\Entity\Product;
use App\Util\ParamsToPaginate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

     /**
      * @return Product[] Returns an array of Product objects
      */


    public function getAllByFilterQuery(ParamsToPaginate $query)
    {
         return $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->orWhere('p.name LIKE :searchTerm')
            ->orWhere('c.name LIKE :category')
            ->andWhere('p.price BETWEEN :startPrice AND :targetPrice')
            ->setParameter('startPrice', $query->getStartPrice())
            ->setParameter('targetPrice', $query->getTargetPrice())
            ->setParameter('searchTerm', '%'.$query->getSearch().'%')
            ->setParameter('category', '%'.$query->getCategory().'%')
            ->orderBy('p.'.$query->getField(), $query->getSort())
            ->getQuery()
            ->getResult()
        ;
    }

}
