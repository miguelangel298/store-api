<?php
  namespace App\Util;

  use Symfony\Component\HttpFoundation\Request;

  /**
   * Class RoutePaginate
   * @package App\Util
   */

  class RoutePaginate {
    /**
     * @var $request
     */
    private $request;

    public function __construct(Request $request) {
      $this->request = $request;
    }

    /**
     * Captures the data that is navigating in the request and
     * validates the field before assigning value
     * @return ParamsToPaginate
     */
    public function getQuery() {
      $sort = $this->request->query->get('sort');
      $field = $this->request->query->get('field');
      $search = $this->request->query->get('search');
      $page = $this->request->query->get('page');
      $perPage = $this->request->query->get('perPage');
      $category = $this->request->query->get('category');
      $startPrice = $this->request->query->get('startPrice');
      $targetPrice = $this->request->query->get('targetPrice');

      $query = new ParamsToPaginate();

      if ($sort == 'ASC' || $sort == 'DESC') {
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

      if ($category) {
        $query->setCategory($category);
      }

      if ($startPrice) {
        $query->setStartPrice($startPrice);
      }

      if ($targetPrice) {
        $query->setTargetPrice($targetPrice);
      }
      return $query;
    }
  }
