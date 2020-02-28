<?php

namespace App\Services\Employees;

use App\Repositories\Employees\EmployeeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EmployeeService
{
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    /**
     * EmployeeService constructor.
     *
     * @param EmployeeRepository $employeeRepository
     */
    final function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator
     */
    public function list(array $request)
    {
        return $this->employeeRepository->list($request);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->employeeRepository->find($id);
    }

    /**
     * @param array $request
     * @return Model
     */
    public function create(array $request): Model
    {
        return $this->employeeRepository->create($request);
    }

    /**
     * @param array $request
     * @param $id
     * @return bool
     */
    public function update(array $request, $id): bool
    {
        return $this->employeeRepository->update($request, $id);
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->employeeRepository->delete($id);
    }
}
