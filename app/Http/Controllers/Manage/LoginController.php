<?php

namespace App\Http\Controllers\Manage;

use Auth;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::guard('admin')->check())
            return redirect()->route('manage.dashboard');

        return view('manage.login', [
        ]);
    }

    public function loginPost(Request $request)
    {
        $remember = true;
        if(Auth::guard('admin')->check())
            return redirect()->route('manage.dashboard');
            
        $rules = [
            'username' => [
                'required',
                Rule::exists('admins')
            ],
            'password' => 'required',
        ];
        $result = Validator::make($request->all(), $rules);

        $credentials = $request->only('username', 'password');

        if($result->fails()) {
            return redirect()->back()->withErrors($result);
        }

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->route('manage.dashboard');
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
               'password' => ['Login Error'],
            ]);
            throw $error;
            return redirect()->back()->withErrors($result);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('manage.dashboard');
    }
}
