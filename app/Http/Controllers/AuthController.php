<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required|min:3|max:255',
            'password' => 'required|min:3|max:255'
        ]);

        if(!$credentials){
            return redirect()->back()->withErrors($credentials);
        }

        if(Auth::attempt($credentials)){
            return redirect()->intended('transaction')->with('success','Welcome Admin');
        }

        return redirect()->back()->with('error', 'Wrong Username Or Password');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->intended('login')->with('success','Welcome Admin');
    }
}
