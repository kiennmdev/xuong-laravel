<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {

        if (Auth::check()) {
            return redirect()->route('my.account');
        } else {
            return view('client.login');
        }

    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('form.login');
    }

    public function verify($token) {
        $user = User::query()->where([
            'email'=> base64_decode($token),
            'email_verified_at'=> null
        ])->firstOrFail();

        if($user) {
            $user->update(['email_verified_at' => Carbon::now()]);

            Auth::login($user);

            request()->session()->regenerate();

            return redirect()->intended('/');
            
        }
    }
}
