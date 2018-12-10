<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 16:49
 */

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class getProductController
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
     * @Route(path="/product/{id}", name="product", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getProduct(Request $request)
    {
        $product = $this->productRepository->find($request->attributes->get('id'));

        $serializeData = $this->serializer->serialize($product, 'json');

        return new JsonResponse($serializeData, 200);
    }
}