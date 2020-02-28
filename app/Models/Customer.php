<?php

namespace App\Models;

use App\Utilities\FCTokenGenerator;

/**
 * Class Customer
 * @package App\Models
 */
class Customer extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'customer_uuid',
        'first_name',
        'last_name',
        'email',
        'status'
    ];

    /**
     * Set Product UUID
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->customer_uuid = FCTokenGenerator::uuid();
        });
    }
}
