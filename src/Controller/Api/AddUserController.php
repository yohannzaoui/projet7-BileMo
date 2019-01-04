<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 25/12/2018
 * Time: 11:01
 */

declare(strict_types=1);

namespace App\Controller\Api;


use App\Repository\UserRepository;
use App\Services\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @Route(path="/api/users", name="addUser", methods={"POST"})
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(Request $request)
    {
        $user = $this->serializer->deserializeUser($request->getContent());

        //dd($user);

        $errors = $this->validator->validate($user);

        if (count($errors)) {

            return new Response((string)$errors, Response::HTTP_BAD_REQUEST);
        }

        $user->setClient($this->tokenStorage->getToken()->getUser());

        $this->repository->save($user);

        return new Response('User added', Response::HTTP_ACCEPTED);
    }
}