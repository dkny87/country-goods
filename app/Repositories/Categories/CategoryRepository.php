<?php

namespace App\Repositories\Categories;

use App\Domain\Category;
use App\Domain\Pagination;
use App\Models\Category as CategoryModel;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return CategoryModel::class;
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
            ->whereCategoryName($filter)
            ->paginate($perPage);
    }

    /**
     * @param $filter
     * @return $this|CategoryRepository
     */
    private function whereCategoryName($filter)
    {
        if (!isset($filter['name'])) {
            return $this;
        }

        return $this->where('name', 'LIKE', '%' . $filter['name'] . '%');
    }

    /**
     * @param $filter
     * @return $this|CategoryRepository
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

    /**
     * @param array $params
     * @return void
     */
    public function syncProducts(array $params)
    {
        $this->model->products()->sync($params);
    }


    /**
     * @return void
     */
    public function detachProducts()
    {
        $this->model->products()->detach();
    }

    /**
     * @param $field
     * @return bool
     */
    private function hasValue($field)
    {
        return isset($value);
    }
}
