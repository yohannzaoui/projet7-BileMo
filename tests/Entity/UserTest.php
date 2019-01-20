<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 20/01/2019
 * Time: 00:15
 */

namespace App\Tests\Entity;


use App\Entity\Client;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testGetName()
    {
        $this->user->setName('test');
        static::assertSame('test', $this->user->getName());
    }

    public function testGetEmail()
    {
        $this->user->setEmail('test@test.com');
        static::assertSame('test@test.com', $this->user->getEmail());
    }

    public function testGetPhoneNumber()
    {
        $this->user->setPhoneNumber('0123456789');
        static::assertSame('0123456789', $this->user->getPhoneNumber());
    }

    public function testGetCreatedAt()
    {
        $date = new \DateTime();
        $this->user->setCreatedAt($date);
        static::assertSame($date, $this->user->getCreatedAt());
    }

    public function testGetClient()
    {
        $client = new Client();
        $this->user->setClient($client);
        static::assertSame($client, $this->user->getClient());
    }
}