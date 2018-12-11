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

class SerializerService implements SerializerServiceInterface
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serializePhone($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function deserializePhone($request)
    {
        return $this->serializer->deserialize($request, Phone::class, 'json');
    }
}