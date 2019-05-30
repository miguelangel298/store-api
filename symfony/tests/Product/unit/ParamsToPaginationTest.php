<?php
  namespace App\Tests\Product\Unit;

  use App\Util\ParamsToPaginate;
  use PHPUnit\Framework\TestCase;

  class CalculatorTest extends TestCase
  {
    public function testAddParamsToClassParamsToPaginate()
    {

      $query = new ParamsToPaginate();
      $query->setCategory('Libros');
      $query->setSearch('ReactJS');
      $query->setSort('name');

      $this->assertEquals('name', $query->getSort());
      $this->assertEquals('ReactJS', $query->getSearch());
      $this->assertEquals('Libros', $query->getCategory());

    }
  }
