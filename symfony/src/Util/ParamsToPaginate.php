<?php
  namespace App\Util;

  class ParamsToPaginate {

    private $sort;
    private $field;
    private $search;
    private $page;
    private $perPage;
    private $offset;


    public function setSort(string $sort): self
      {
        $this->sort = $sort;

        return $this;
      }

    public function setField(string $field): self
      {
        $this->field = $field;

        return $this;
      }

    public function setSearch(string $search): self
    {
      $this->search = $search;

      return $this;
    }

    public function setPage(string $page): self
    {
      $this->page = $page;

      return $this;
    }

    public function setPerPage(string $perPage): self
    {
      $this->perPage = $perPage;

      return $this;
    }

    public function setOffset(string $offset): self
    {
      $this->offset = $offset;

      return $this;
    }

  }
