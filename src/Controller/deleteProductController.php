<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 10/12/2018
 * Time: 16:32
 */

namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class deleteProductController
 * @package App\Controller
 */
class deleteProductController
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
     * deleteProductController constructor.
     * @param ProductRepository $productRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ProductRepository $productRepository,
        SerializerInterface $serializer
    ) {
      $this->productRepository = $productRepository;
      $this->serializer = $serializer;
    }

    /**
     * @Route(path="/delete/product/{id}", name="deleteProducts", methods={"DELETE"})
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteProduct(Request $request)
    {
        $product = $this->productRepository->find($request->attributes->get('id'));

        $this->productRepository->delete($product);

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}