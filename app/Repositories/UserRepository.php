<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository{

  public function __construct(User $model)
  {
    parent::__construct($model);
  }

  public function getByEmail($email){
    $user = $this->model->whereEmail($email)->first();
    return $user;
  }

}