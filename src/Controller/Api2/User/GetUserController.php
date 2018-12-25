<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 10:32
 */

namespace App\Controller\Api2\User;


use App\Repository\UserRepository;
use App\Services\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
     * @IsGranted("ROLE_USER")
     * @param $id
     * @return JsonResponse|Response
     */
    public function getUser($id)
    {
        $user = $this->repository->findOneBy(['id' => $id]);

        if (!$user) {

            return new Response('Unknown user', Response::HTTP_NOT_FOUND);
        }

        if ($user->getClient() != $this->tokenStorage->getToken()->getUser()) {

            return new Response('You do not have access to this resource', Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializer->serialize($user);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}