<?php

namespace App\Services\Categories;

use App\Repositories\Categories\CategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryService
 * @package App\Services\Categories
 */
class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator
     */
    public function list(array $request = [])
    {
        return $this->categoryRepository->list($request);
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * @param array $request
     * @return bool
     */
    public function create(array $request): Model
    {
        return $this->categoryRepository->create($request);
    }

    /**
     * @param array $request
     * @param int|string $id
     * @return bool
     */
    public function update(array $request, $id): bool
    {
        return $this->categoryRepository->update($request, $id);
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->categoryRepository->delete($id);
    }

    /**
     * @param array $params
     * @return void
     */
    public function syncProducts(array $params)
    {
        $this->categoryRepository->syncProducts($params);
    }

    /**
     * @return void
     */
    public function detachProducts()
    {
        $this->categoryRepository->detachProducts();
    }
}
