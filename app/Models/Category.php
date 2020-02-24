<?php

namespace App\Models;

use App\Utilities\FCTokenGenerator;

/**
 * Class Category
 * @package App\Models
 */
class Category extends BaseModel
{
    protected $fillable = ['category_uuid', 'name', 'descrption', 'created_at', 'updated_at'];

    /**
     * Set Category UUID
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->category_uuid = FCTokenGenerator::uuid();
        });
    }
}
