<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API\Categories
 */
class APIController extends Controller
{
    /**
     * @param array $data
     * @return mixed
     */
    protected function responseWithItem($data = [])
    {
        return $data;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function responseWithCollection($data = [])
    {
        return $data;
    }
}
