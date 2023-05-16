<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if(Auth::check()){
            return redirect()->intended(route('home', [
                'authUsername' => Auth::user()->email
            ]));
        }
        
        $formFields = $request->only(['email', 'password']);

        if(Auth::attempt($formFields)){
            return redirect()->intended(route('home', [
                'authUsername' => Auth::user()->email
            ]));
        }

        return redirect(route('login'))->withErrors([
            'email' => 'Не удалось авторизоваться.'
            ]);
    }
}
