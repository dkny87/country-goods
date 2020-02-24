<?php

namespace App\Services;

use App\Repositories\Products\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductRepository constructor.
     *
     * @param ProductRepository $productRepository
     */
    final function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return Collection|Model[]
     */
    public function list()
    {
        return $this->productRepository->all();
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    /**
     * @param array $request
     * @return bool
     */
    public function create(array $request): bool
    {
        return $this->productRepository->create($request);
    }

    /**
     * @param array $request
     * @param int|string $id
     * @return bool
     */
    public function update(array $request, $id): bool
    {
        return $this->productRepository->update($request, $id);
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->productRepository->delete($id);
    }
}
