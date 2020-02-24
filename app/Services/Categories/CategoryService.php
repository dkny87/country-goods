<?php

namespace App\Services\Categories;

use App\Repositories\Categories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
    final function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Collection|Model[]
     */
    public function list()
    {
        return $this->categoryRepository->all();
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
    public function create(array $request): bool
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
}
