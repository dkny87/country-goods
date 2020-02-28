<?php

namespace App\Repositories\Products;

use App\Domain\Pagination;
use App\Domain\Product;
use App\Models\Product as ProductModel;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return ProductModel::class;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator
     */
    public function list(array $request)
    {
        $perPage = Arr::get($request, 'per_page', Pagination::DEFAULT_LIMIT);
        $filter = Arr::get($request, 'filter', []);

        return $this->whereStatus($filter)
            ->whereProductName($filter)
            ->paginate($perPage);
    }

    /**
     * @param $filter
     * @return $this|ProductRepository
     */
    private function whereProductName($filter)
    {
        if (!isset($filter['name'])) {
            return $this;
        }

        return $this->where('name', 'LIKE', '%' . $filter['name'] . '%');
    }

    /**
     * @param $filter
     * @return $this|ProductRepository
     */
    private function whereStatus($filter)
    {
        if (!isset($filter['status'])) {
            return $this;
        }

        $statuses = $filter['status'];

        if (is_array($statuses)) {
            $validStatuses = collect($statuses)->filter(function ($status) {
                return Product::hasValidStatus($status);
            })->toArray();

            return $this->whereIn('status', $validStatuses);
        }

        if (Product::hasValidStatus($statuses)) {
            return $this->where('status', '=', $statuses);
        }

        return $this;
    }

    /**
     * @param ProductModel $product
     * @param array $params
     */
    public function syncCategories(ProductModel $product, array $params)
    {
        $product->categories()->sync($params);
    }

    /**
     * @param ProductModel $product
     */
    public function detachCategories(ProductModel $product)
    {
        $product->categories()->detach();
    }
}
