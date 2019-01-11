<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/01/2019
 * Time: 15:00
 */

namespace App\EventListener;


use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserListener
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    /**
     * @ORM\PrePersist()
     * @param User $user
     */
    public function addUser(User $user)
    {
        $client = $this->tokenStorage->getToken()->getUser();
        $user->setClient($client);
    }
}