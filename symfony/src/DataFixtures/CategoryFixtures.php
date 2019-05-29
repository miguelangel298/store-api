<?php

  namespace App\DataFixtures;

  use App\Entity\Category;
  use Doctrine\Common\Persistence\ObjectManager;

  class CategoryFixtures extends BaseFixture {

    public const CATEGORY_REFERENCE = 'category';

    public function loadData(ObjectManager $manager)
    {
      // create category!
      $category = new Category();
      $category->setName('Electronics');
      $manager->persist($category);

      $manager->flush();

      $this->addReference(self::CATEGORY_REFERENCE, $category);
    }
  }
