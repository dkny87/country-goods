<?php

namespace App\Repositories;

use App\Session;

/**
 * Class SessionRepository
 * @package App\Repositories
 */
class SessionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Session::class;
    }

    /**
     * @param $sessionId
     * @return mixed
     */
    public function get($sessionId)
    {
        return $this->findWhere('session_id', '=', $sessionId);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function set(array $data)
    {
        return $this->model->create($data);
    }
}
