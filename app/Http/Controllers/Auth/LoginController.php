<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * LoginController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('guest')->except('logout');
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws InvalidCredentialsException
     */
    public function login(Request $request)
    {
        return $this->authService->login($request['email'], $request['password']);
    }

    /**
     *
     */
    public function logout()
    {
        $this->authService->logout(request()->header('x-http-token'));

        return response()->noContent();
    }
}
