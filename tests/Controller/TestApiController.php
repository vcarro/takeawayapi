<?php
declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ApiControllerTest extends WebTestCase
{
    public function testListRestaurantsReturnAlwaysStatus200(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants');

	$this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testListRestaurantsGet99Elements(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants');
        $response = json_decode($client->getResponse()->getContent(),true);

        $this->assertEquals(99, count($response['data']));
    }

    public function testListRestaurantsWithVersionForAndroidReturnRestaurantName(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants?version=5.12.300');
        $response = json_decode($client->getResponse()->getContent(),true);

        $this->assertEquals(TRUE, array_key_exists('RestaurantName',$response['data'][0]));
    }

    public function testListRestaurantsWithNormalVersionReturnNameForRestaurantName(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants?version=5.12.299');
        $response = json_decode($client->getResponse()->getContent(),true);

        $this->assertEquals(TRUE, array_key_exists('name',$response['data'][0]));
    }

    public function testListRestaurantsSortByBestMachReturnId98001248AtFirstPosition(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants/sort?field=best%20match');
        $response = json_decode($client->getResponse()->getContent(),true);

        $this->assertEquals(98001248, $response['data'][0]['id']);
    }

    public function testListRestaurantsSortByPopularityReturnId98001310AtLastPosition(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants/sort?field=popularity');
	$response = json_decode($client->getResponse()->getContent(),true);
	$numElem = count($response['data']);

        $this->assertEquals(98001310, $response['data'][$numElem-1]['id']);
    }

    public function testSearchRestaurantsByNameGondoHasTwoResults(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants/search?name=Gondo');
	$response = json_decode($client->getResponse()->getContent(),true);
	$numElem = count($response['data']);

        $this->assertEquals(2, $numElem);
    }

    public function testSearchRestaurantsByNamePizzaBellaNapoliHasOneResultWithId98001229(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/restaurants/search?name=Pizza%20Bella%20Napoli');
	$response = json_decode($client->getResponse()->getContent(),true);
	$numElem = count($response['data']);

        $this->assertEquals(1, $numElem);
        $this->assertEquals(98001229, $response['data'][$numElem-1]['id']);
    }

}

