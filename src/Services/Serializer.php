<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 00:34
 */

namespace App\Services;


use App\Entity\Phone;
use App\Entity\User;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class Serializer
 * @package App\Services
 */
class Serializer
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Serializer constructor.
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
    public function serialize($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    /**
     * @param $data
     * @return object
     */
    public function deserializeUser($data)
    {
        return $this->serializer->deserialize($data, User::class, 'json');
    }

    /**
     * @param $data
     * @return object
     */
    public function deserializePhone($data)
    {
        return $this->serializer->deserialize($data, Phone::class, 'json');
    }
}