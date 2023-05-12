<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository {

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function addContact($data)
    {
        $model = $this->find($data['user_id']);
        $model->contacts()->create($data);
        return $model;
    }

    public function removeContact($data)
    {
        $model = $this->find($data['user_id']);
        $model->contacts()->where('contact_id', $data['contact_id'])->delete();
        return $model;
    }
}