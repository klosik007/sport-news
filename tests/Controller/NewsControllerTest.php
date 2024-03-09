<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testAddNews(): void
    {
        $newsJsonData = [
            'headers' => ['Content-Type' => 'application/json'],
            'json'=> [
                "title"=> "Bramka Lewadowskiego w meczu Barcy",
                "text"=> "Lorem ipsum est docet alert"
            ]
        ];

        $client = static::createClient();
        $crawler = $client->request('POST', '/news', $newsJsonData);

        $this->assertResponseIsSuccessful();
    }

    public function testUpdateNews(): void
    {
        $newsJsonData = [
            'headers' => ['Content-Type' => 'application/json'],
            'json'=> [
                "title"=> "Bramka Lewandowskiego w meczu Barcy",
            ]
        ];

        $client = static::createClient();
        $crawler = $client->request('PATCH', '/news/1', $newsJsonData);

        $this->assertResponseIsSuccessful();
    }

    public function testGetNewsById(): void
    {
        $id = 1;

        $client = static::createClient();
        $crawler = $client->request('GET', '/news/'.$id);

        $this->assertResponseIsSuccessful();
    }

    public function testGetAllNewsByAuthorName(): void
    {
        $authorName = "Przemek";

        $client = static::createClient();
        $crawler = $client->request('GET', '/news/'.$authorName.'/all');

        $this->assertResponseIsSuccessful();
    }

    public function testGetTop3AuthorsWithMostNews(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/news/top3');

        $this->assertResponseIsSuccessful();
    }
}
