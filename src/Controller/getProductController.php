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
 * Class getProductController
 * @package App\Controller
 */
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
     * @Route(path="/getProducts", name="getProducts", methods={"GET"})
     * @return JsonResponse
     */
    public function getTest()
    {
        $data = $this->productRepository->findAll();

        $serializeData = $this->serializer->serialize($data, 'json');

        return new JsonResponse($serializeData, '200');
    }
}