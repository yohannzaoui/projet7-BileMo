<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 20/01/2019
 * Time: 12:49
 */

namespace App\Tests\EventListener;


use App\EventListener\UserFilterConfigurator;
use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserFilterConfiguratorUnitTest extends TestCase
{
    public function testConstruct()
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $tokenStorage = $this->createMock(TokenStorageInterface::class);
        $reader = $this->createMock(Reader::class);
        $userFilter = new UserFilterConfigurator($em, $tokenStorage, $reader);
        static::assertInstanceOf(UserFilterConfigurator::class, $userFilter);
    }
}