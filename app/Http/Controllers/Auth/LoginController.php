<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    // protected $redirectTo;

    protected function redirectPath()
    {
        if (Auth::user()->type == 'admin') {
            // return '/admin/dashboard'; // Admin redirect
            return route('admin.dashboard');
        } elseif (Auth::user()->type == 'editor') {
            // return '/editor/dashboard'; // Editor redirect
            return route('manager.dashboard');
        } else {
            return '/home'; // Regular user redirect
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
