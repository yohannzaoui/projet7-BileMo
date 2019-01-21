<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 21:43
 */

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\Common\Annotations\Reader;

/**
 * Class UserFilterConfigurator
 * @package App\EventListener
 */
class UserFilterConfigurator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * UserFilterConfigurator constructor.
     * @param EntityManagerInterface $em
     * @param TokenStorageInterface $tokenStorage
     * @param Reader $reader
     */
    public function __construct(
        EntityManagerInterface $em,
        TokenStorageInterface $tokenStorage,
        Reader $reader
    ) {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
        $this->reader = $reader;
    }

    /**
     *
     */
    public function onKernelRequest()
    {
        if (!$user = $this->getUser()) {
            return ;
        }

        $filter = $this->em->getFilters()->enable('user_filter');
        $filter->setParameter('id', $user->getId());
        $filter->setAnnotationReader($this->reader);
    }

    /**
     * @return UserInterface|null
     */
    private function getUser(): ?UserInterface
    {
        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        $user = $token->getUser();
        return $user instanceof UserInterface ? $user : null;
    }
}