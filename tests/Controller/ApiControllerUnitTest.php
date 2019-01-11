<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/01/2019
 * Time: 17:45
 */

namespace App\Tests\Controller;


use App\Controller\ApiController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ApiControllerUnitTest extends TestCase
{
    public function testApiRedirection()
    {
        $controller = new ApiController();

        static::assertInstanceOf(RedirectResponse::class, $controller->api());
    }
}