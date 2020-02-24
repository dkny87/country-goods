<?php

namespace App\Repositories\Employee;

use App\Domain\Employee;
use App\Domain\Pagination;
use App\Models\Employee as EmployeeModel;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * Class EmployeeRepository
 * @package App\Repositories
 */
class EmployeeRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return EmployeeModel::class;
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
            ->whereEmployeeName($filter)
            ->paginate($perPage);
    }

    /**
     * @param $filter
     * @return $this|EmployeeRepository
     */
    private function whereEmployeeName($filter)
    {
        if (!isset($filter['name'])) {
            return $this;
        }
        $this->where('first_name', 'LIKE', '%' . $filter['name'] . '%');
        $this->orWhere('last_name', 'LIKE', '%' . $filter['name'] . '%');
        $this->orWhere('middle_name', 'LIKE', '%' . $filter['name'] . '%');

        return $this;
    }

    /**
     * @param $filter
     * @return $this|EmployeeRepository
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
