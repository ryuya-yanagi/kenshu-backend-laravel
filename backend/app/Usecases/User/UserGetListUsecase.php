<?php

namespace App\Usecases\User;

use App\Domains\Repositories\UserRepository;

class UserGetListUsecase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        return $this->userRepository->getList();
    }
}
