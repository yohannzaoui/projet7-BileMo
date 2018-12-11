<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 23:57
 */

namespace App\Controller\Phone;


use App\Repository\PhoneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DeletePhoneController
 * @package App\Controller\Phone
 */
class DeletePhoneController
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
     * DeletePhoneController constructor.
     * @param PhoneRepository $phoneRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        PhoneRepository $phoneRepository,
        SerializerInterface $serializer
    ) {
      $this->phoneRepository = $phoneRepository;
      $this->serializer = $serializer;
    }

    /**
     * @Route(path="/phones/{id}", name="deletePhone", methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletePhone(Request $request)
    {
        $phone = $this->phoneRepository->find($request->attributes->get('id'));

        if (!$phone) {
            return new JsonResponse("Product not found", JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->phoneRepository->delete($phone);

        return new JsonResponse("Product removed", JsonResponse::HTTP_ACCEPTED);
    }

}