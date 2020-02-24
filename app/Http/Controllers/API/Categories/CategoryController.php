<?php

namespace App\Http\Controllers\API\Categories;

use App\Http\Controllers\API\APIController;
use App\Services\CategoryService;

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
        $this->categoryService = $categoryService;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->responseWithCollection($this->categoryService->list());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->responseWithItem($this->categoryService->create($request->all()));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->responseWithItem($this->categoryService->find($id));
    }
}
