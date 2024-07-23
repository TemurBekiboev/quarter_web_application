<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        $this->middleware('guest:citizens')->except('logout');
    }
    public function showCitizensLoginForm()
    {
        return view('auth.login', ['url' => 'citizens-check']);
    }

    public function citizensLogin(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('citizens')->attempt(['login_id' => $request->name, 'password' => $request->password])) {

            return redirect()->intended('citizen-profile-logged');
        }
        else{
            return 'xato';
        }
    }
    public function username()
    {

        if (Route::is('citizen-profile-logged')){
            return 'login_id';}
        else{
            return 'name';
        }
    }
}
