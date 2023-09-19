<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '';
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function redirectTo()
    {
        return '/admin/users';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password'), 'inactive' => 0])) {
            return $this->sendLoginResponse($request);
        }
    }

    public function validateLogin($request)
    {
        $this->validate($request, [
            'username' => 'required|string|exists:users',
            'password' => 'required|string',
        ]);
    }

    public function showLoginForm(){
        return view('auth.login');
    }
}
