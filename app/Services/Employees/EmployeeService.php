<?php

namespace App\Services;

use App\Repositories\Employees\EmployeeRepository;
use Illuminate\Database\Eloquent\Collection;
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
     * @return Collection|Model[]
     */
    public function list()
    {
        return $this->employeeRepository->all();
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->employeeRepository->find($id);
    }

    /**
     * @param array $request
     * @return bool
     */
    public function create(array $request): bool
    {
        return $this->employeeRepository->create($request);
    }

    /**
     * @param array $request
     * @param int|string $id
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
