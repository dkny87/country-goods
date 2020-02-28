<?php

namespace App\Transformers\Products;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

/**
 * Class ProductTransformer
 * @package App\Transformers\Products
 */
class ProductTransformer extends TransformerAbstract
{
    /**
     * @param Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->product_uuid,
            'name' => $product->name,
            'description' => $product->description,
            'sku' => $product->sku,
            'quantity' => $product->quantity,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at
        ];
    }
}
