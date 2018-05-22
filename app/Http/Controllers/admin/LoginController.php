<?php

namespace App\Http\Controllers\admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use Authenticatable;
    protected $redirectTo = '/mahasiswa';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    public function guard()
    {
        return Auth::guard('user');

    }
}
