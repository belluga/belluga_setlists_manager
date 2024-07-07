<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated_fields =  $request->validate([
            'first_name' => ['required', 'max:50', 'min:2'],
            'last_name' => ['required', 'max:50', 'min:2'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'max:255', 'confirmed'],
        ]);

        $user = User::create($validated_fields);
        Auth::login($user);

        return redirect()->intended();
    }

    public function login(Request $request)
    {
        $validated_credentials = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        $logged_in = Auth::attempt(
            $validated_credentials,
            $request->remember
        );

        if($logged_in){
            return redirect()->intended();
        }

        return back()->withErrors(['login_error' => 'Email ou senha incorretos.']);
    }
}
