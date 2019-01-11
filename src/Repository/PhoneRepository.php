<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/01/2019
 * Time: 21:16
 */

namespace App\Repository;


use App\Entity\Phone;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class PhoneRepository
 * @package App\Repository
 */
class PhoneRepository extends ServiceEntityRepository
{
    /**
     * PhoneRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Phone::class);
    }
}