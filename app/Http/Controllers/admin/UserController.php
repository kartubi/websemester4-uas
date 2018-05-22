<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Route;
use DB;

class UserController extends Controller
{

    public function Login(Request $request)
    {
        if ($request->method() == 'POST') :
            $req = $request->all();
            $rules = [
                'email'     => 'required',
                'password'  => 'required'
            ];
            $validator = Validator::make($req, $rules);
            if ($validator->fails())
                return $this->res($validator->errors()->first());
            $user = User::where('email', $request->email)->first();

            if (! $user) {
                return $this->res('User not found');
            }

            $check = Hash::check($request->password, $user->password);

            if (! $check) {
                return $this->res('Password not matched');
            }

            Auth::login($user);

            return $this->res('Login berhasil',true);

        else:
            if (Auth::check())
            {
                return redirect('/');
            }
            return view('admin.login',[
                'name' => $name = Route::currentRouteName()
            ]);
        endif;
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/admin/login')
            ->withSuccess('Terimakasih, selamat datang kembali!');
    }
    //
}
