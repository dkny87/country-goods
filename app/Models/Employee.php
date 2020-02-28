<?php

namespace App\Models;

use App\Utilities\FCTokenGenerator;

/**
 * Class Employee
 * @package App\Models
 */
class Employee extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'employee_uuid',
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
            $model->employee_uuid = FCTokenGenerator::uuid();
        });
    }
}
