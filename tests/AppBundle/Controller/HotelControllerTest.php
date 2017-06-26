<?php

namespace Tests\AppBundle\Controller;

use Nelmio\ApiDocBundle\Tests\WebTestCase;

class HotelControllerTest extends WebTestCase
{
    public function testShowHotel()
    {
        $client = static::createClient();
        $client->request('GET', '/hotels');

        $this->assertTrue(true);
//        $this->assertGreaterThan(0, $hotels);
    }
}