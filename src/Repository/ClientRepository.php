<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/01/2019
 * Time: 18:32
 */

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * Class ClientRepository
 * @package App\Repository
 */
class ClientRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * @param string $username
     * @return \Symfony\Component\Security\Core\User\UserInterface|void|null
     */
    public function loadUserByUsername($username)
    {
        // TODO: Implement loadUserByUsername() method.
    }


    /**
     * @param Client $client
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Client $client)
    {
        $this->_em->persist($client);
        $this->_em->flush();
    }
}