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
        $newsData = [
            "news_title" => "Bramka Lewadowskiego w meczu Barcy vol.2",
            "news_text" => "Lorem ipsum est docet alert",
            "news_authors" => [1]
        ];

        $client = static::createClient();
        $crawler = $client->request('POST', '/news', $newsData);

        $this->assertResponseRedirects();
    }

    public function testUpdateNews(): void
    {
        $id = 1;
        $newsData = [
            'news_title' => "Bramka Lewandowskiego w meczu Barcy",
            'news_text' => "Tekst"
        ];

        $client = static::createClient();
        $crawler = $client->request('POST', '/news/'.$id.'/edit', $newsData);

        $this->assertResponseRedirects();
    }

    public function testShowNewsById(): void
    {
        $id = 1;

        $client = static::createClient();
        $crawler = $client->request('GET', '/news/'.$id);

        $this->assertResponseIsSuccessful();
    }

    public function testGetNewsById(): void
    {
        $id = 1;

        $client = static::createClient();
        $crawler = $client->request('GET', '/news/'.$id.'/json');

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