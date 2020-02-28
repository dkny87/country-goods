<?php

namespace App\Transformers\Customers;

use App\Models\Customer;
use League\Fractal\TransformerAbstract;

/**
 * Class CustomerTransformer
 * @package App\Transformers\Customers
 */
class CustomerTransformer extends TransformerAbstract
{
    /**
     * @param Customer $customer
     * @return array
     */
    public function transform(Customer $customer)
    {
        return [
            'id' => $customer->customer_uuid,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'created_at' => $customer->created_at,
            'updated_at' => $customer->updated_at
        ];
    }
}
