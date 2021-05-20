<?php

namespace App\Http\Controllers\User;

use App\Usecases\User\UserGetDetailUsecase;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    /**
     * 数字に変換できない文字列の排除のためのMiddlewareを登録
     */
    public function __construct()
    {
        $this->middleware('is_numeric($id)');
    }

    /**
     * @param string $id
     * @param UserGetDetailUsecase 
     * 
     * @return Response
     */
    public function __invoke(string $id, UserGetDetailUsecase $usecase)
    {
        $user = $usecase->execute((int) $id);

        return view('users.id', ['user' => $user]);
    }
}
