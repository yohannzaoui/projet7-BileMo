<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 15:51
 */

namespace App\Controller\Api2\Phone;


use App\Repository\PhoneRepository;
use App\Services\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddPhoneController
 * @package App\Controller\Phone
 */
class AddPhoneController
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
     * AddPhoneController constructor.
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
     * @Route(path="/api2/phones", name="addPhone", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addPhone(Request $request)
    {
        $phone = $this->serializer->deserializePhone($request->getContent());

        $this->repository->save($phone);

        return new Response('Phone added', Response::HTTP_OK);
    }
}