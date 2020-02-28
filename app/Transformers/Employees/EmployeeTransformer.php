<?php

namespace App\Transformers\Employees;

use App\Models\Employee;
use League\Fractal\TransformerAbstract;

/**
 * Class EmployeeTransformer
 * @package App\Transformers\Employees
 */
class EmployeeTransformer extends TransformerAbstract
{
    /**
     * @param employee $employee
     * @return array
     */
    public function transform(Employee $employee)
    {
        return [
            'id' => $employee->employee_uuid,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'created_at' => $employee->created_at,
            'updated_at' => $employee->updated_at
        ];
    }
}
