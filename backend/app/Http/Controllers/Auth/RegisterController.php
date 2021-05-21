<?php

namespace App\Http\Controllers\Auth;

use App\Usecases\Auth\AuthRegisterUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Auth\CreateAuthDto;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::LOGIN;

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
        return redirect($this->redirectTo);
    }
}
