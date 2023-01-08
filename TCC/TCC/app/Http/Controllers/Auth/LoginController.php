<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $loginType = request()->input('telefone');
        $this->telefone = filter_var($loginType, FILTER_VALIDATE_EMAIL) ? 'email' : 'telefone';
        request()->merge([$this->telefone => $loginType]);

        return property_exists($this, 'telefone') ? $this->telefone : 'email';
    }

    public function credentials()
    {
        $credencial = filter_var(request()->input('telefone'), FILTER_VALIDATE_EMAIL)
            ? request()->input('telefone')
            : montaTelefone(request()->input('telefone'));
        return [
            $this->username() => $credencial,
            'password' => request()->input('password')
        ];
    }
}
