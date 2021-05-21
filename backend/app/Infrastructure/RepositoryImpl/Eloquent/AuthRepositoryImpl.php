<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities\Auth as AuthEntity;
use App\Domains\Repositories\AuthRepository;
use App\Infrastructure\DataAccess\Eloquent\Auth as AuthEloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleAuthEntity;

class AuthRepositoryImpl extends BaseRepositoryImpl implements AuthRepository
{
    use ConvertibleAuthEntity;

    private AuthEloquent $authEloquent;

    public function __construct(AuthEloquent $authEloquent)
    {
        $this->authEloquent = $authEloquent;
    }

    public function findUserByName(string $name): ?AuthEntity
    {
        $result = $this->authEloquent->newQuery()->where('name', '=', $name)->first();
        if (!$result) {
            return null;
        }

        return $this->toAuthEntity($result->toArray());
    }

    public function create(AuthEntity $auth): AuthEntity
    {
        $result = $this->authEloquent->newQuery()->create([
            "name" => $auth->name,
            "password_hash" => $auth->password_hash
        ]);

        return $this->toAuthEntity($result->toArray());
    }
}
