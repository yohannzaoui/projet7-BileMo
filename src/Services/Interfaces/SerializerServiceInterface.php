<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/12/2018
 * Time: 07:49
 */

namespace App\Services\Interfaces;

use Symfony\Component\Serializer\SerializerInterface;


interface SerializerServiceInterface
{
    public function __construct(SerializerInterface $serializer);

    public function serializePhone($data);

    public function deserializePhone($request);
}