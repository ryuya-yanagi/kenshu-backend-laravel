<?php

namespace App\Usecases\Auth;

use App\Domains\Entities\Auth;
use App\Domains\Repositories\AuthRepository;
use App\Http\Dto\Auth\CreateAuthDto;

class AuthRegisterUsecase
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function execute(CreateAuthDto $createAuthDto)
    {
        $createAuth = new Auth($createAuthDto);

        $result = $this->authRepository->create($createAuth);
        return $result->id;
    }
}
