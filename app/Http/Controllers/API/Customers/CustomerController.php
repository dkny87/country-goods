<?php

namespace App\Http\Controllers\API\Customers;

use App\Http\Controllers\API\APIController;
use App\Services\Customers\CustomerService;
use App\Transformers\Customers\CustomerTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;

/**
 * Class CustomerController
 * @package App\Http\Controllers\API\Customers
 */
class CustomerController extends APIController
{
    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * CustomerController constructor.
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->fractalManager = new Manager;
        $this->customerService = $customerService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->responseWithCollection(
            $this->customerService->list($request->all()),
            new CustomerTransformer()
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->responseWithItem(
            $this->customerService->create($request->all()),
            new CustomerTransformer()
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $this->customerService->update($request->all(), $id);

        return $this->responseWithItem(
            $this->customerService->find($id),
            new CustomerTransformer()
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->responseWithItem(
            $this->customerService->find($id),
            new CustomerTransformer()
        );
    }
}
