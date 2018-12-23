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
use Symfony\Component\HttpFoundation\Response;
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
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletePhone($id)
    {
        $phone = $this->repository->findOneBy(['id' => $id]);

        if (!$phone) {

            return new Response('Phone not found', Response::HTTP_BAD_REQUEST);
        }

        $this->repository->delete($phone);

        return new Response('Phone deleted', Response::HTTP_OK);
    }
}