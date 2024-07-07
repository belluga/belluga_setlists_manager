<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register (Request $request){
        //validate
        $request->validate([
            'first_name' => ['required', 'max:50', 'min:2'],
            'last_name' => ['required', 'max:50', 'min:2'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'max:255', 'confirmed'],
        ]);

        //register

        //login

        //redirect
    }

    public function login (Request $request){
        //validate
        $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        //register

        //login

        //redirect
    }

    protected function _redirect(){
        // return route()->redirect->intended();
    }
}
