<?php

namespace App\Models;

use App\Utilities\FCTokenGenerator;

/**
 * Class Category
 * @package App\Models
 */
class Product extends BaseModel
{
    protected $guard = [];

    /**
     * Set Product UUID
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->category_uuid = FCTokenGenerator::uuid();
        });
    }
}
