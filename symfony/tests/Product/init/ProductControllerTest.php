<?php

  namespace App\tests\Product;

  use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

  class ProductControllerTest extends WebTestCase
  {

    public function testDetProductListing() {

      $client = static::createClient();

      $client->request('GET', '/api/products');

      $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testAddNewProduct() {

      $client = static::createClient();
      // We are looking for a category to be the evaluation.
      $client->request('GET', '/api/products');

      // We get the data and convert it into an array.
      $products = $client->getResponse()->getContent();
      $productArray = json_decode($products, true);

      // Category evaluation
      $category = $productArray['products'][0]['category']['id'];

      $product= [
        'name' => 'ReactJS',
        'description' => 'React makes it painless to create interactive UIs.',
        'price' => '100',
        'category' => $category,
      ];

      $client->request('POST', '/api/products', $product);

      // We get the data and convert it into an array
      $newProduct = $client->getResponse()->getContent();
      $productArray = json_decode($newProduct, true);

      $this->assertEquals($product['name'], $productArray['products']['name']);
      $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testSortListsProductASC () {

      $client = static::createClient();

      $client->request('GET', '/api/products?sort=ASC');

      // We get the data and convert it into an array
      $newProduct = $client->getResponse()->getContent();
      $productArray = json_decode($newProduct, true);

      $expect = $productArray['products'][0]['name'][0];
      $this->assertEquals('a', strtolower($expect));
      $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSearchForCategory () {

      $client = static::createClient();

      // We are looking for a category to be the evaluation.
      $client->request('GET', '/api/products');

      // We get the data and convert it into an array.
      $products = $client->getResponse()->getContent();
      $productArray = json_decode($products, true);

      // Category evaluation
      $category = $productArray['products'][0]['category']['name'];

      // We look for the products parameterized by the category.
      $client->request('GET', '/api/products?category='.$category);
      $listsProduct = $client->getResponse()->getContent();
      $productArray = json_decode($listsProduct, true);
      $productArray = $productArray['products'];

      // We make a loop to verify that each product belongs to the category sought.
      foreach ($productArray as $key => $value) {
        $this->assertEquals($category, $value['category']['name']);
      }
    }

    public function testSearchForRangeOfPrice () {

      $client = static::createClient();

      $startPrice = 20;
      $targetPrice = 100;

      // We look for the product list with the assigned parameters.
      $client->request('GET', '/api/products?startPrice='.$startPrice.'&targetPrice='.$targetPrice);
      $listsProduct = $client->getResponse()->getContent();
      $productArray = json_decode($listsProduct, true);
      $productArray = $productArray['products'];

      // We loop to verify that each product is within the established price range.
      foreach ($productArray as $key => $value) {
        $condition = false;
        $price = $value['price'];
        if ($price >= $startPrice && $price <= $targetPrice ) {
            $condition = true;
        }
        $this->assertTrue($condition);
      }
    }
  }
