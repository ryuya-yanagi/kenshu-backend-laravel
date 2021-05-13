<?php

namespace App\Domains\Usecases\User;

use App\Domains\Entities\User;
use App\Domains\Repositories\UserRepository;

class UserGetDetailUsecase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): ?User
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            return null;
        }

        return $user;
    }
}
