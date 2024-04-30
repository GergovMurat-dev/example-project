<?php

namespace App\Repositories\CRUD;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepositoryCRUD extends Common\BaseCRUDRepository
{

    function getModelQB(): Builder
    {
        return User::query();
    }
}
