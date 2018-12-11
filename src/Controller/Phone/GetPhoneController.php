<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 23:26
 */

namespace App\Controller\Phone;


use App\Repository\PhoneRepository;
use App\Services\Interfaces\SerializerServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetPhoneController
 * @package App\Controller\Phone
 */
class GetPhoneController
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
     * PhoneController constructor.
     * @param PhoneRepository $phoneRepository
     * @param SerializerServiceInterface $serializer
     */
    public function __construct(
        PhoneRepository $phoneRepository,
        SerializerServiceInterface $serializer
    ) {
        $this->phoneRepository = $phoneRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route(path="/phones/{id}", name="phone", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getPhone(Request $request)
    {
        $data = $this->phoneRepository->find($request->attributes->get('id'));

        $serialize = $this->serializer->serializePhone($data);

        return new JsonResponse($serialize, 200);
    }
}