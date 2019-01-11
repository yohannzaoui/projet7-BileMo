<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/01/2019
 * Time: 17:53
 */

namespace App\Tests\EventListener;


use App\EventListener\UserListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserListenerUnitTest extends TestCase
{
    public function testConstruct()
    {
        $tokenStorage = $this->createMock(TokenStorageInterface::class);

        $listener = new UserListener($tokenStorage);

        static::assertInstanceOf(UserListener::class, $listener);
    }
}