<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 16:13
 */

namespace App\Controller\Phone;


use App\Repository\PhoneRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeletePhoneController
 * @package App\Controller\Phone
 */
class DeletePhoneController
{
    /**
     * @var PhoneRepository
     */
    private $repository;

    /**
     * DeletePhoneController constructor.
     * @param PhoneRepository $repository
     */
    public function __construct(PhoneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route(path="/api2/phones/{id}", name="deletePhone", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     * @param $id
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletePhone($id)
    {
        $phone = $this->repository->findOneBy(['id' => $id]);

        if (!$phone) {

            return new JsonResponse('Phone not found', JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->repository->delete($phone);

        return new JsonResponse('Phone deleted', JsonResponse::HTTP_OK);
    }
}