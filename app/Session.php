<?php

namespace App;

use App\Models\BaseModel;

/**
 * Class Session
 * @package App
 */
class Session extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'session_id',
        'session_info',
        'expired_at'
    ];
}
