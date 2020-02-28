<?php

namespace App\Http\Controllers\API\Categories;

use App\Http\Controllers\API\APIController;
use App\Services\Categories\CategoryService;
use App\Transformers\Categories\CategoryTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API\Categories
 */
class CategoryController extends APIController
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->fractalManager = new Manager;
        $this->categoryService = $categoryService;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->responseWithCollection(
            $this->categoryService->list($request->all()),
            new CategoryTransformer()
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->responseWithItem(
            $this->categoryService->create($request->all()),
            new CategoryTransformer()
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->responseWithItem(
            $this->categoryService->find($id),
            new CategoryTransformer()
        );
    }
}
