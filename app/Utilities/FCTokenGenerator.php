<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

/**
 * Class FCTokenGenerator
 * @package App\Utilities
 */
class FCTokenGenerator
{
    /**
     * Uid generator implementation.
     *
     * @param string|null $salt
     * @return string
     */
    public static function uuid($salt = null)
    {
        $salt = !$salt ? microtime() : $salt;

        return (string)Uuid::uuid5(Uuid::NAMESPACE_DNS, $salt);
    }

    /**
     * @param string $prefix
     * @return string
     */
    public static function key($prefix = '')
    {
        return uniqid($prefix);
    }

    /**
     * @param string $algo
     * @param string $data
     * @return string
     */
    public static function secret($algo = 'sha256', $data = '')
    {
        return hash($algo, $data);
    }

    /**
     * Create password hash.
     *
     * @param string $value
     * @return string
     */
    public static function password($value)
    {
        return Hash::make($value);
    }
}
