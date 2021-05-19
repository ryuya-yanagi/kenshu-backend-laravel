<?php

namespace App\Http\Controllers\Auth;

use App\Usecases\User\UserGetDetailUsecase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CurrentUserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(UserGetDetailUsecase $usecase)
    {
        $currentUserId = Auth::id();
        $currentUser = $usecase->execute($currentUserId);
        return view('mypage', ['currentUser' => $currentUser]);
    }
}
