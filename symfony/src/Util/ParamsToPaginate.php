<?php
  namespace App\Util;


  use phpDocumentor\Reflection\Types\This;

  /**
   * Class ParamsToPaginate will act as an interface
   * to params the routs
   * @package App\Util
   */

  class ParamsToPaginate {

    private $sort = 'ASC';
    private $field = 'name';
    private $search = '';
    private $category = '';
    private $startPrice = 0;
    private $targetPrice = 100000;
    private $page = 1;
    private $perPage = 10;
    private $offset = 10;


    public function setTargetPrice($targetPrice): self {
        $this->targetPrice = $targetPrice;
        return $this;
    }

    public function setStartPrice($startPrice): self {
        $this->startPrice = $startPrice;
        return $this;
    }

    public function setSort(string $sort): self {
        $this->sort = $sort;
        return $this;
    }

    public function setCategory(string $category): self {
        $this->category = $category;
        return $this;
    }

    public function setField(string $field): self {
        $this->field = $field;
        return $this;
    }

    public function setSearch(string $search): self {
        $this->search = $search;
        return $this;
    }

    public function setPage(string $page): self {
        $this->page = $page;
        return $this;
    }

    public function setPerPage(string $perPage): self {
        $this->perPage = $perPage;
        return $this;
    }

    public function getField(): string {
        return $this->field;
    }

    public function getSort(): string {
        return $this->sort;
    }

    public function getSearch(): string {
      if ($this->category != "" && $this->search == '') {
        $this->setSearch('*');
      }
      return $this->search;

    }

    public function getPage(): string {
        return $this->page;
    }

    public function getPerPage(): string {
        return $this->perPage;
    }

    public function getCategory(): string {
      if ($this->search != '' && $this->category == '') {
        $this->setCategory('*');
      }
        return $this->category;
    }

    public function getTargetPrice(): int {
        return $this->targetPrice;
    }

    public function getStartPrice(): int {
        return $this->startPrice;
    }

    public function getOffset(): int {
      /**
       * We calculate the offset to know from which item we should bring
       */
      $this->offset = (($this->page * $this->perPage) - $this->perPage);
      if (!$this->offset) {
        $this->offset = 10;
      }

      return $this->offset;
    }

  }
