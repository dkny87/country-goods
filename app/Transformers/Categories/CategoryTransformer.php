<?php

namespace App\Transformers\Categories;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer
 * @package App\Transformers\Categories
 */
class CategoryTransformer extends TransformerAbstract
{
    /**
     * @param Category $category
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id' => $category->category_uuid,
            'name' => $category->name,
            'description' => $category->description
        ];
    }
}
