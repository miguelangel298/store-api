<?php
  namespace App\Controller;

  use App\Entity\Product;
  use App\Repository\CategoryRepository;
  use App\Repository\ProductRepository;
  use App\Util\RoutePaginate;
  use mysql_xdevapi\Exception;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\JsonResponse;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Flex\Response;

  /**
   * Product controller.
   * @Route("/api", name="api_")
   */

  class ProductController extends AbstractController {

    /**
     * @var $productRepository
     */
    private $productRepository;


    /**
     * @var $productRepository
     */
    private $categoryRepository;


    public function __construct(
      ProductRepository $productRepository,
      CategoryRepository $categoryRepository) {
      $this->productRepository = $productRepository;
      $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/products", name="products_list", methods={"GET"})
     */
    public function getProductAction(Request $request)
    {
      $query = new RoutePaginate($request);
      $query = $query->getQuery();

      $products = $this->productRepository->getAllByFilterQuery($query);


      return new JsonResponse(['products' => $products]);
    }

    /**
     * @Route("/products", name="products_create", methods={"POST"})
     */
    public function createProductAction(Request $request) {
      try {
        $product = new Product();

        // Verify if the category exists
        $category = $this->categoryRepository->find((int)$request->get('category'));

        if ($category == null) {
          return new JsonResponse(['code' => 204, 'message' => 'NO_CONTENT']);
        }

        // Set all params
        $product->setName($request->get('name'));
        $product->setDescription($request->get('description'));
        $product->setPrice((int)$request->get('price'));
        $product->setImage($request->get('image'));
        $product->setPrice($request->get('price'));
        $product->setCategory($category);

        // Save new product
        $repository = $this->getDoctrine()->getManager();
        $repository->persist($product);
        $repository->flush();

        $product = $this->productRepository->find($product);
        return new JsonResponse(['products' => $product], 201);

      } catch (Exception $exception) {

        return new Response(['code' => 500, 'message' => $exception]);

      }

    }

  }
