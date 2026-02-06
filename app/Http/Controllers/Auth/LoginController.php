<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected function authenticated($request, $user)
{
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    if ($user->role === 'owner') {
        return redirect('/owner/dashboard');
    }

    return redirect('/'); // pelanggan
}




    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
