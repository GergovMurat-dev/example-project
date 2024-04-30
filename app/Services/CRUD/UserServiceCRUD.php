<?php

namespace App\Services\CRUD;

use App\Models\User;
use App\Repositories\CRUD\UserRepositoryCRUD;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserServiceCRUD extends Common\BaseService
{
    public function __construct(UserRepositoryCRUD $repository)
    {
        parent::__construct($repository);
    }

    public function getModelInstance(): Model
    {
        return new User();
    }

    public function getValidateModelRules(array $properties): array
    {
        return [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($properties['id'] ?? 0)],
            'password' => [
                'sometimes',
                'min:8',
                Password::default()
            ],
            'confirmation_hash' => 'nullable',
            'is_confirmed_email' => 'boolean'
        ];
    }
}
