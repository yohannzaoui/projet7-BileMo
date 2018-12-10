<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 09:39
 */

namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class getProductsController
 * @package App\Controller
 */
class getProductsController
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
     * getProductController constructor.
     * @param ProductRepository $testRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        productRepository $testRepository,
        SerializerInterface $serializer
    ) {
        $this->productRepository = $testRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route(path="/products", name="products", methods={"GET"})
     * @return JsonResponse
     */
    public function getProducts()
    {
        $products = $this->productRepository->findAll();

        $serializeData = $this->serializer->serialize($products, 'json');

        return new JsonResponse($serializeData, '200');
    }
}