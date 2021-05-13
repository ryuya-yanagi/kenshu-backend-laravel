<?php

namespace App\Http\Controllers\User;

use App\Domains\Usecases\User\UserGetListUsecase;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @param UserGetListUsecase
     * 
     * @return Response
     */
    public function __invoke(UserGetListUsecase $usecase)
    {
        $result = $usecase->execute();

        return view('users.index', ['users' => $result]);
    }
}
