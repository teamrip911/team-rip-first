<?php

namespace App\Tests\Fuctional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class TestCheckActionTest extends WebTestCase
{
    public function testRequestSuccess(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/test-check');

        $this->assertResponseIsSuccessful();

        $result = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('ok', $result['status']);
    }
}
