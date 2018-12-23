<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 10:32
 */

namespace App\Controller\User;


use App\Repository\UserRepository;
use App\Services\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class GetUserController
 * @package App\Controller
 */
class GetUserController
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
     * GetUserController constructor.
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
     * @Route(path="/api2/users/{id}", name="user", methods={"GET"})
     * @param $id
     * @return JsonResponse
     * @IsGranted("ROLE_USER")
     */
    public function getUser($id)
    {
        $user = $this->repository->findOneBy(['id' => $id]);

        if (!$user) {

            return new JsonResponse('User unknown', JsonResponse::HTTP_BAD_REQUEST);
        }

        if ($user->getClient() != $this->tokenStorage->getToken()->getUser()) {

            return new JsonResponse('you do not have access to this resource', JsonResponse::HTTP_BAD_REQUEST);
        }

        $data = $this->serializer->serialize($user);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}