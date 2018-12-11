<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/12/2018
 * Time: 07:45
 */

namespace App\Services;


use App\Entity\Phone;
use App\Services\Interfaces\SerializerServiceInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class SerializerService
 * @package App\Services
 */
class SerializerService implements SerializerServiceInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * SerializerService constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     * @return string
     */
    public function serializePhone($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    /**
     * @param $request
     * @return object
     */
    public function deserializePhone($request)
    {
        return $this->serializer->deserialize($request, Phone::class, 'json');
    }
}