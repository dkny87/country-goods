<?php

namespace App\Domain;

/**
 * Class Pagination
 * @package App\Domain
 */
class Category
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_DELETED = 'deleted';
    const STATUS_PENDING = 'pending';

    /**
     * @var array
     */
    private static $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_DELETED,
        self::STATUS_PENDING
    ];

    /**
     * @param string $status
     * @return bool
     */
    public static function hasValidStatus(string $status)
    {
        return collect(self::$statuses)->contains($status);
    }
}
