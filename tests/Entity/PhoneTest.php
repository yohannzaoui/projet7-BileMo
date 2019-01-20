<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 20/01/2019
 * Time: 00:15
 */

namespace App\Tests\Entity;


use App\Entity\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    private $phone;

    public function setUp()
    {
        $this->phone = new Phone();
    }

    public function testGetBrand()
    {
        $this->phone->setBrand('test');
        static::assertSame('test', $this->phone->getBrand());
    }

    public function testGetModel()
    {
        $this->phone->setModel('test');
        static::assertSame('test', $this->phone->getModel());
    }

    public function testGetColor()
    {
        $this->phone->setColor('test');
        static::assertSame('test', $this->phone->getColor());
    }

    public function testGetStorage()
    {
        $this->phone->setStorage('0');
        static::assertSame('0', $this->phone->getStorage());
    }

    public function testGetPrice()
    {
        $this->phone->setPrice('0');
        static::assertSame('0', $this->phone->getPrice());
    }

    public function testGetCreatedAt()
    {
        $date = new \DateTime();
        $this->phone->setCreatedAt($date);
        static::assertSame($date, $this->phone->getCreatedAt());
    }

    public function testGetUpdatedAt()
    {
        $date = new \DateTime();
        $this->phone->setUpdatedAt($date);
        static::assertSame($date, $this->phone->getUpdatedAt());
    }
}