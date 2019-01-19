<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 14/01/2019
 * Time: 17:11
 */

namespace App\Tests\Entity;


use App\Entity\Client;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    private $client;

    public function setUp()
    {
        $this->client = new Client();
    }

    public function testGetUsername()
    {
        $this->client->setUsername('test');

        static::assertSame('test', $this->client->getUsername());
    }

    public function testGetEmail()
    {
        $this->client->setEmail('test@test.com');

        static::assertSame('test@test.com', $this->client->getEmail());
    }

    public function testGetPassword()
    {
        $this->client->setPassword('password');

        static::assertSame('password', $this->client->getPassword());
    }

    public function testGetPhoneNumber()
    {
        $this->client->setPhoneNumber('0123456789');

        static::assertSame('0123456789', $this->client->getPhoneNumber());
    }

    public function testGetCreatedAt()
    {
        $date = new \DateTime();

        $this->client->setCreatedAt($date);

        static::assertSame($date, $this->client->getCreatedAt());
    }

    public function testGetRoles()
    {
        $this->client->setRoles(['ROLE_USER']);

        static::assertSame(['ROLE_USER'], $this->client->getRoles());
    }

}