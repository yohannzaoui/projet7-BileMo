<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 00:12
 */

namespace App\Controller\Phone;


use App\Repository\PhoneRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class GetPhonesController
 * @package App\Controller
 */
class GetPhonesController
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
     * @Route(path="/api2/phones", name="allPhones", methods={"GET"})
     * @return JsonResponse
     * @IsGranted("ROLE_USER")
     */
    public function getPhones()
    {
        $phones = $this->repository->findAll();

        $data = $this->serializer->serialize($phones);

        return new JsonResponse($data , JsonResponse::HTTP_OK);
    }
}