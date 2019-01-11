<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/01/2019
 * Time: 15:00
 */

namespace App\EventListener;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserListener
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    /**
     * @param User $user
     */
    public function prePersist(User $user)
    {
        if ($this->tokenStorage->getToken()->getUser()) {

            $user->setClient($this->tokenStorage->getToken()->getUser());
        }

    }
}