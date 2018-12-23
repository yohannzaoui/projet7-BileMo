<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 10:22
 */

namespace App\Controller\User;


use App\Repository\UserRepository;
use App\Services\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class GetUsersController
 * @package App\Controller
 */
class GetUsersController
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * GetUsersController constructor.
     * @param UserRepository $repository
     * @param Serializer $serializer
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserRepository $repository,
        Serializer $serializer,
        TokenStorageInterface $tokenStorage
    ) {
        $this->repository = $repository;
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route(path="/api2/users", name="allUsers", methods={"GET"})
     * @return JsonResponse
     * @IsGranted("ROLE_USER")
     */
    public function getUsers()
    {
        $users = $this->repository->allUsers($this->tokenStorage->getToken()->getUser()->getId());

        $data = $this->serializer->serialize($users);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}