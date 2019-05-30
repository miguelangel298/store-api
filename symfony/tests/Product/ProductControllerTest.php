<?php

  namespace App\tests\Product;

  use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

  class ProductControllerTest extends WebTestCase
  {
    public function testPOST() {

      $client = static::createClient();

      $client->request('GET', 'http://localhost/api/products?search=a');

//      dd($client->getResponse());
      $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
  }
