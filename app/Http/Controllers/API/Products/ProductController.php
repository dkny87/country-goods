<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\API\APIController;
use App\Services\Products\ProductService;
use App\Transformers\Products\CustomerTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API\Categories
 */
class ProductController extends APIController
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->fractalManager = new Manager;
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->responseWithCollection(
            $this->productService->list($request->all()),
            new CustomerTransformer()
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->responseWithItem(
            $this->productService->create($request->all()),
            new CustomerTransformer
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->responseWithItem(
            $this->productService->find($id),
            new CustomerTransformer
        );
    }
}
