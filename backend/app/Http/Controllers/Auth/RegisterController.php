<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Usecases\Auth\AuthRegisterUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Auth\CreateAuthDto;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::MYPAGE;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke(RegisterRequest $request, AuthRegisterUsecase $usecase)
    {
        $createAuthDto = new CreateAuthDto([
            "name" => $request->name,
            "password_hash" => Hash::make($request->password),
        ]);

        $usecase->execute($createAuthDto);
        return redirect($this->redirectPath());
    }
}
