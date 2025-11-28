<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Tentukan kolom otentikasi yang akan digunakan.
     * Ini akan menggantikan default 'email'.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        // Karena default guard sudah 'admins', middleware 'guest' sudah tepat.
        $this->middleware('guest')->except('logout');
    }
}