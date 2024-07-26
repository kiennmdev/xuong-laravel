<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function showFormRegister()
    {

        if (Auth::check()) {
            return redirect()->route('my.account');
        } else {
            return view('client.register');
        }

    }

    public function save(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string','max:255'],
            'email' => ['required', 'string','email', 'unique:users', 'max:255'],
            'password' => ['required', 'string','confirmed', 'max:10']
        ]);

        $newUser = User::query()->create($data);

        //Gửi email xác nhận
        $token = base64_encode($newUser->email);
        
        Mail::to($newUser->email)->send((new VerifyEmail($newUser->name, $token)));

        // Auth::login($newUser);

        // //Generate lại token
        // $request->session()->regenerate();

        return redirect()->intended('/');

    }
}
