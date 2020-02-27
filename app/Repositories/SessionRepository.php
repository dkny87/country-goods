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
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->model->find($id);
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
