<?php
  namespace App\Controller;



  use App\Entity\Product;
  use App\Repository\ProductRepository;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\JsonResponse;
  use Symfony\Component\Routing\Annotation\Route;

  /**
   * Product controller.
   * @Route("/api", name="api_")
   */

  class ProductController extends AbstractController {

    /**
     * @var $productRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository) {
      $this->productRepository = $productRepository;
    }

    /**
     * @Route("/products", name="products_list", methods={"GET"})
     */
    public function getProductAction()
    {
      $products = $this->productRepository->findAll();
      return new JsonResponse(['products' => $products]);
    }

  }
