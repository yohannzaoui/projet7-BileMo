<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 14:49
 */

namespace App\Controller;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class addTestController
 * @package App\Controller
 */
class addProductController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * addTestController constructor.
     * @param $productRepository
     * @param $serializer
     */
    public function __construct(
        productRepository $productRepository,
        SerializerInterface $serializer
    ) {
        $this->productRepository = $productRepository;
        $this->serializer = $serializer;
    }


    /**
     * @Route(path="/addProduct", name="addProduct", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addProduct(Request $request)
    {
        $product = $this->serializer->deserialize($request->getContent(), Product::class, 'json');

        $this->productRepository->save($product);

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}