<?php

namespace App\Usecases\User;

use App\Domains\Entities\User;
use App\Domains\Repositories\UserRepository;
use App\Usecases\Exceptions\NotFoundException;

class UserGetDetailUsecase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): User
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
