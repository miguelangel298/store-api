<?php
  namespace App\Util;

  use Symfony\Component\HttpFoundation\Request;

  class RoutePaginate {
    /**
     * @var $request
     */
    private $request;

    public function __construct(Request $request) {
      $this->request = $request;
    }

    public function getQuery() {
      $sort = $this->request->query->get('sort');
      $field = $this->request->query->get('field');
      $search = $this->request->query->get('search');
      $page = $this->request->query->get('page');
      $perPage = $this->request->query->get('perPage');
      $offset = $this->request->query->get('offset');

      $query = new ParamsToPaginate();

      if ($sort) {
        $query->setSort($sort);
      }

      if ($field) {
        $query->setField($field);
      }

      if ($search) {
        $query->setSearch($search);
      }

      if ($page) {
        $query->setPage($page);
      }

      if ($perPage) {
        $query->setPerPage($perPage);
      }

      if ($offset) {
        $query->setOffset($offset);
      }

      return $query;
    }
  }
