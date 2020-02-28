<?php

namespace App\Models;

use App\Utilities\FCTokenGenerator;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category
 * @package App\Models
 */
class Category extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'category_uuid',
        'name',
        'description'
    ];

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

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
