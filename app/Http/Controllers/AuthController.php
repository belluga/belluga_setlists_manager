<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Support\Facades\Dashboard;

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

        $password = $validated_fields['password'];
        unset($validated_fields["password"]);

        $user = $this->_createUserAdmin($validated_fields, $password);

        Auth::login($user, $request->remember);

        return redirect()->intended();
    }

    private function _createUserAdmin($fields, $password): User
    {
        return User::create([
            "password" => Hash::make($password),
            "permissions" => Dashboard::getAllowAllPermission(),
            ...$fields
        ]);
    }

    public function login(Request $request)
    {
        $validated_credentials = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        // $validated_credentials['password'] = Hash::make($validated_credentials['password']);

        $logged_in = Auth::attempt(
            $validated_credentials,
            $request->remember
        );

        if ($logged_in) {
            return redirect()->intended();
        }

        return back()->withErrors(['login_error' => 'Email ou senha incorretos.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
