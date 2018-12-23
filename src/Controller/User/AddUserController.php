<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 10:42
 */

namespace App\Controller\User;

use App\Repository\UserRepository;
use App\Services\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddUserController
 * @package App\Controller
 */
class AddUserController
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
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddUserController constructor.
     * @param UserRepository $repository
     * @param Serializer $serializer
     * @param ValidatorInterface $validator
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserRepository $repository,
        Serializer $serializer,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    ) {
        $this->repository = $repository;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route(path="/api2/users", name="addUser", methods={"POST"})
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(Request $request)
    {
        $user = $this->serializer->deserializeUser($request->getContent());

        $errors = $this->validator->validate($user);

        if (count($errors)) {

            return new JsonResponse((string) $errors, JsonResponse::HTTP_FOUND);
        }

        $user->setClient($this->tokenStorage->getToken()->getUser());

        $this->repository->save($user);

        return new JsonResponse('User added', JsonResponse::HTTP_ACCEPTED);
    }
}