<?php

namespace App\Http\Controllers\User;

use App\Usecases\User\UserGetListUsecase;
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
        $users = $usecase->execute();

        return view('users.index', ['users' => $users]);
    }
}
