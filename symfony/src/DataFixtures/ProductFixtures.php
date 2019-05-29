<?php

  namespace App\DataFixtures;

  use App\Entity\Product;
  use Doctrine\Common\Persistence\ObjectManager;

  class ProductFixtures extends BaseFixture {

    public function loadData(ObjectManager $manager)
    {

      // create 10 products.
      $this->createMany(Product::class, 10, function (Product $product, $count) {

        $product->setName($this->faker->jobTitle);
        $product->setDescription($this->faker->realText(400));
        $product->setImage($this->faker->imageUrl());
        $product->setPrice(mt_rand(10, 100));
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE));

      });

      $manager->flush();
    }
  }
