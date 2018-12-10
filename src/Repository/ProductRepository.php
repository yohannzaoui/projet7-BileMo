<?php

namespace App\Repository;

use App\Entity\Product;
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
     * @param $product
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Product $product)
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

    /**
     * @param Product $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Product $id)
    {
        $this->_em->remove($id);
        $this->_em->flush();
    }

}
