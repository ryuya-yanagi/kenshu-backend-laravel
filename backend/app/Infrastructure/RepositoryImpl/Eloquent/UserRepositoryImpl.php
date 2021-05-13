<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities\User as UserEntity;
use App\Domains\Repositories\UserRepository;
use App\Infrastructure\DataAccess\Eloquent\User as UserEloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleUserEntity;

class UserRepositoryImpl extends BaseRepositoryImpl implements UserRepository
{
    use ConvertibleUserEntity;

    private UserEloquent $userEloquent;

    public function __construct(UserEloquent $userEloquent)
    {
        $this->userEloquent = $userEloquent;
    }

    public function getList(): array
    {
        $result = $this->userEloquent->newQuery()->get()->toArray();

        return $this->toUserEntityCollection($result);
    }

    public function findById(int $id): UserEntity
    {
        $builder = $this->userEloquent->newQuery();
        $builder->with('articles');
        $result = $builder->find($id);
        if (!$result) {
            return null;
        }

        return $this->toUserEntity($result->toArray());
    }
}
