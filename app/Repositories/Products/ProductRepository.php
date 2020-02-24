<?php

namespace App\Repositories\Categories;

use App\Domain\Product;
use App\Domain\Pagination;
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
                return Category::hasValidStatus($status);
            })->toArray();

            return $this->whereIn('status', $validStatuses);
        }

        if (Category::hasValidStatus($statuses)) {
            return $this->where('status', '=', $statuses);
        }

        return $this;
    }
}
