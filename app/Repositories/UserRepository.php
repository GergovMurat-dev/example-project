<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Common\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{

    protected function getModelQB(): Builder
    {
        return User::query();
    }

    public function getByHash(string $hash)
    {
        return $this->getModelQB()->firstWhere('confirmation_hash', $hash);
    }
}
