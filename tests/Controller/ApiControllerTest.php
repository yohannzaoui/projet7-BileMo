<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 14/01/2019
 * Time: 17:35
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testApiControllerResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}