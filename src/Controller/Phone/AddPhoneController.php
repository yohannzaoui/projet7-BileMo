<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 23:35
 */

namespace App\Controller\Phone;

use App\Repository\PhoneRepository;
use App\Services\Interfaces\SerializerServiceInterface;
use App\Services\ValidatorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddPhoneController
 * @package App\Controller\Phone
 */
class AddPhoneController
{
    /**
     * @var PhoneRepository
     */
    private $phoneRepository;

    /**
     * @var SerializerServiceInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * AddPhoneController constructor.
     * @param PhoneRepository $phoneRepository
     * @param SerializerServiceInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        PhoneRepository $phoneRepository,
        SerializerServiceInterface $serializer,
        ValidatorInterface $validator
    ) {
      $this->serializer = $serializer;
      $this->phoneRepository = $phoneRepository;
      $this->validator = $validator;
    }

    /**
     * @Route(path="/phones", name="addPhone", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function AddPhone(Request $request)
    {
        $phone = $this->serializer->deserializePhone($request->getContent());

        $errors = $this->validator->validate($phone);

        if (count($errors)) {
            return new JsonResponse((string)$errors, Response::HTTP_BAD_REQUEST);
        }

        $this->phoneRepository->save($phone);

        return new JsonResponse("Product added", JsonResponse::HTTP_ACCEPTED);
    }
}