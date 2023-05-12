<?php

namespace App\Repositories;

abstract class BaseRepository {
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';

    public function getModelClass()
    {
        return $this->model->getModel();
    }

    public function all()
    {
        return $this->model
                ->orderBy($this->sortBy, $this->sortOrder)
                ->get();
    }

    public function paginated($count)
    {
        return $this->model->paginate($count);
    }

    public function create($input)
    {
        $model = $this->model;
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function find($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function update($id, array $input)
    {
        $model = $this->find($id);
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function getBy($key, $value)
    {
        return $this->model->where($key, $value)->get();
    }
}
