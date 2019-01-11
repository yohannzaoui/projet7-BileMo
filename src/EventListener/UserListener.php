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

/**
 * Class UserListener
 * @package App\EventListener
 */
class UserListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * UserListener constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     *
     */
    public function OnKernelRequest()
    {

    }

    /**
     * @param User $user
     */
    public function prePersist(User $user)
    {
        $user->setClient($this->tokenStorage->getToken()->getUser());
    }
}