<?php

namespace App\Http\Controllers\API\Employees;

use App\Http\Controllers\API\APIController;
use App\Models\Employee;
use App\Services\Employees\EmployeeService;
use App\Transformers\Employees\EmployeeTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;

/**
 * Class EmployeeController
 * @package App\Http\Controllers\API\Employees
 */
class EmployeeController extends APIController
{
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * EmployeeController constructor.
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->fractalManager = new Manager;
        $this->employeeService = $employeeService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->responseWithCollection(
            $this->employeeService->list($request->all()),
            new EmployeeTransformer()
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->responseWithItem(
            $this->employeeService->create($request->all()),
            new EmployeeTransformer()
        );
    }

    public function update(Request $request, $id)
    {
        $this->employeeService->update($request->all(), $id);

        return $this->responseWithItem(
            $this->employeeService->find($id),
            new EmployeeTransformer()
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->responseWithItem(
            $this->employeeService->find($id),
            new EmployeeTransformer()
        );
    }
}
