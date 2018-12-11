<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 23:35
 */

namespace App\Controller\Phone;


use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * AddPhoneController constructor.
     * @param PhoneRepository $phoneRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        PhoneRepository $phoneRepository,
        SerializerInterface $serializer
    ) {
      $this->serializer = $serializer;
      $this->phoneRepository = $phoneRepository;
    }

    /**
     * @Route(path="/add/phone", name="addPhone", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function AddPhone(Request $request)
    {
        $phone = $this->serializer->deserialize($request->getContent(), Phone::class, 'json');

        $this->phoneRepository->save($phone);

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}