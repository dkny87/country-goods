<?php

namespace App\Services\Products;

use App\Repositories\Products\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductService
 * @package App\Services\Products
 */
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
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator
     */
    public function list(array $request = [])
    {
        return $this->productRepository->list($request);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->productRepository->find($id);
    }

    /**
     * @param array $request
     * @return Model
     */
    public function create(array $request): Model
    {
        $product = $this->productRepository->create($request);

        if (isset($request['categories'])) {
            $this->productRepository->syncCategories($product, $request['categories']);
        } else {
            $this->productRepository->detachCategories($product);
        }

        return $product;
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

    /**
     * @param array $params
     */
    public function syncCategories(array $params)
    {
        $this->productRepository->syncCategories($params);
    }

    /**
     * @return void
     */
    public function detachCategories()
    {
        $this->productRepository->detachCategories();
    }
}
