<?php

namespace App\Repositories;

use Closure;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\Pagination\{LengthAwarePaginator, Paginator};
use Illuminate\Database\Eloquent\{Collection, Model};

abstract class BaseRepository
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Container $app
     * @throws Exception
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->model = $this->makeModel();
    }

    /**
     * @return mixed
     * @throws Exception
     */
    private function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $model;
    }

    /**
     * @return string
     */
    abstract public function model();

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return mixed
     */
    public function findWhere($column, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->model->where($column, $operator, $value, $boolean)->first();
    }

    /**
     * @param array $columns
     * @return Collection|Model[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return Paginator
     */
    public function simplePaginate(int $perPage, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->model->simplePaginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param array $data
     * @param int|string $id
     * @return bool
     */
    public function update(array $data, $id): bool
    {
        return $this->find($id)->update($data);
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $conditions
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $conditions, array $values)
    {
        return $this->model->updateOrCreate($conditions, $values);
    }

    /**
     * @param int|string $id
     * @return int
     */
    public function delete($id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * @param array|string $relations
     * @return self
     */
    public function with($relations): self
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    /**
     * @param Closure|string|array $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return $this
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and'): self
    {
        if (!empty($column)) {
            $this->model = $this->model->where($column, $operator, $value, $boolean);
        }

        return $this;
    }

    /**
     * @param Closure|string|array $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return $this
     */
    public function orWhere($column, $operator = null, $value = null, $boolean = 'and'): self
    {
        if (!empty($column)) {
            $this->model = $this->model->orWhere($column, $operator, $value, $boolean);
        }

        return $this;
    }

    /**
     * @param $column
     * @param $value
     * @param string $boolean
     * @param bool $not
     * @return $this
     */
    public function whereIn($column, $value, $boolean = 'and', $not = false)
    {
        if (!empty($column)) {
            $this->model = $this->model->whereIn($column, $value, $boolean, $not);
        }

        return $this;
    }
}
