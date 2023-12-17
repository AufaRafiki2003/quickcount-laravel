<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index(){
        return view('Auth.login');
    }

    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email anda belum di isi',
            'password.required'=>'Password anda belum terisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
           if(Auth::user()->role == 'admin') {
                return redirect ('/home');
           }else{
                return redirect ('/home');
           }
        }else{
            return redirect('')->withErrors('Username dan password yang di masukkan salah')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}
