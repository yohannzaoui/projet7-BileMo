<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 22:48
 */

namespace App\Controller\Phone;

use App\Services\Interfaces\SerializerServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\PhoneRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetPhonesController
 * @package App\Controller\Phone
 */
class GetPhonesController
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
     * GetPhonesController constructor.
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
     * @Route(path="/phones", name="phones", methods={"GET"})
     * @return JsonResponse
     */
    public function getPhones()
    {
        $data = $this->phoneRepository->findAll();

        $serialize = $this->serializer->serializePhone($data);

        return new JsonResponse($serialize, 200);
    }
}