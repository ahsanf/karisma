<?php

namespace App\Http\Controllers\Auth;

use App\Helper\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function showLoginForm()
    {
        $data['action'] = ['page_login'];
        $data['page_title'] = 'Login to Karisma';
        return view('auth.login', compact('data'));
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : RedirectHelper::redirectRouteStatus('login', 'success', 'Logout Berhasil !');
    }

    protected function attemptLogin(Request $request)
    {


        if(!$this->guard()->attempt($this->credentials($request))){

            return RedirectHelper::redirectRouteStatus('login','warning', 'Email atau Password Salah !');
        }
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function validateLogin(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($credentials->fails()) {
            $error = $credentials->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function authenticated(Request $request, $user)
    {
    if(!Auth::check()) {
        return RedirectHelper::redirectBackStatus('warning', 'Silahkan coba lagi !');
    }
    return redirect()->route('admin.event.index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
