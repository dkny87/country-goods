<?php

namespace App\Models;

use App\Utilities\FCTokenGenerator;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category
 * @package App\Models
 */
class Product extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_uuid',
        'name',
        'description',
        'sku',
        'quantity',
        'price'
    ];

    /**
     * Set Product UUID
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->product_uuid = FCTokenGenerator::uuid();
        });
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
