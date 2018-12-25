<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 00:21
 */

namespace App\Controller\Api2\Phone;

use App\Repository\PhoneRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Services\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetPhoneController
 * @package App\Controller
 */
class GetPhoneController
{
    /**
     * @var PhoneRepository
     */
    private $repository;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * GetPhonesController constructor.
     * @param PhoneRepository $repository
     * @param Serializer $serializer
     */
    public function __construct(
        PhoneRepository $repository,
        Serializer $serializer
    ) {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    /**
     * @Route(path="/api2/phones/{id}", name="phone", methods={"GET"})
     * @param $id
     * @return JsonResponse | Response
     * @IsGranted("ROLE_USER")
     */
    public function getPhone($id)
    {
        $phone = $this->repository->findOneBy(['id' => $id]);

        if (!$phone) {

            return new Response('Unknown phone', Response::HTTP_BAD_REQUEST);
        }

        $data = $this->serializer->serialize($phone);

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}