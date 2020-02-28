<?php

namespace App\Services\Customers;

use App\Repositories\Customers\CustomerRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * CustomerService constructor.
     *
     * @param CustomerRepository $customerRepository
     */
    final function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator
     */
    public function list(array $request)
    {
        return $this->customerRepository->list($request);
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->customerRepository->find($id);
    }

    /**
     * @param array $request
     * @return Model
     */
    public function create(array $request): Model
    {
        return $this->customerRepository->create($request);
    }

    /**
     * @param array $request
     * @param int|string $id
     * @return bool
     */
    public function update(array $request, $id): bool
    {
        return $this->customerRepository->update($request, $id);
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->customerRepository->delete($id);
    }
}
