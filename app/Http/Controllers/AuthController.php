<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.login');
    }

    public function register()
    {
        return "register";
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        $q = User::where('username',$request->username)->orWhere('email',$request->username)->get()->toArray();
        if(count($q)==1){
            if(Hash::check($request->password, $q[0]['password'])){
                Auth::loginUsingId($q[0]['id']);
                return response()->json([
                    'status' => true,
                    'data' => [
                        'url' => route('dashboard.index'),
                    ]
                ]);
            }
        }
        return notif(false,'error','Data login tidak ditemukan.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

}
