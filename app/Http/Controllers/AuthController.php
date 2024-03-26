<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showlogin(){
        return view('login');
    }
    public function login(Request $request){
        $val = $request->validate([
            'username' =>'required',
            'password' =>'required',
        ]);
        if(Auth::attempt($val)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }else{
            return redirect()->back()->with('danger','Login failed, check your credentials!');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Login have been logged out!');
    }
}
