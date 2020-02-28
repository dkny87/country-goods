<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API\Categories
 */
class APIController extends Controller
{
    /**
     * @var FractalManager
     */
    protected $fractalManager;

    /**
     * @param $item
     * @param $callback
     * @return mixed
     */
    protected function responseWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractalManager->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param array $array
     * @param array $headers
     * @return mixed
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        return response()->json($array, 200, $headers);
    }

    /**
     * @param $collection
     * @param $callback
     * @return mixed
     */
    protected function responseWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $resource->setPaginator(new IlluminatePaginatorAdapter($collection));

        $rootScope = $this->fractalManager->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }
}
