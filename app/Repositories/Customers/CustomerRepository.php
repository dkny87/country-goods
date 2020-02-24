<?php

namespace App\Repositories\Customers;

use App\Domain\Customer;
use App\Domain\Pagination;
use App\Models\Customer as CustomerModel;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return CustomerModel::class;
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
            ->whereCustomerName($filter)
            ->paginate($perPage);
    }

    /**
     * @param $filter
     * @return $this|CustomerRepository
     */
    private function whereCustomerName($filter)
    {
        if (!$this->hasValue($filter['name'])) {
            return $this;
        }

        $this->where('first_name', 'LIKE', '%' . $filter['name'] . '%');
        $this->orWhere('last_name', 'LIKE', '%' . $filter['name'] . '%');
        $this->orWhere('middle_name', 'LIKE', '%' . $filter['name'] . '%');

        return $this;
    }

    /**
     * @param $filter
     * @return $this|CustomerRepository
     */
    private function whereStatus($filter)
    {
        if (!$this->hasValue($filter['status'])) {
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
     * @param $field
     * @return bool
     */
    private function hasValue($field)
    {
        return isset($value);
    }
}
