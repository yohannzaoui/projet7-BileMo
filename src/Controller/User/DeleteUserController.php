<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 12:22
 */

namespace App\Controller\User;


use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class DeleteUserController
 * @package App\Controller
 */
class DeleteUserController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * DeleteUserController constructor.
     * @param UserRepository $repository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserRepository $repository,
        TokenStorageInterface $tokenStorage
    ) {
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route(path="/api2/users/{id}", name="deleteUser", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     * @param $id
     * @return JsonResponse | Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteUser($id)
    {
        $user = $this->repository->findOneBy(['id' => $id]);

        if (!$user) {

            return new Response('Unknown user', Response::HTTP_BAD_REQUEST);
        }

        if ($user->getClient() != $this->tokenStorage->getToken()->getUser()) {

            return new Response('You do not have access to this resource', Response::HTTP_BAD_REQUEST);
        }

        $this->repository->delete($user);

        return new JsonResponse('User deleted', JsonResponse::HTTP_OK);
    }
}