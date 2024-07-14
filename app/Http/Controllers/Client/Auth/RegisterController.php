<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function save(Request $request) {
        $data = $request->all();

        $newUser = User::query()->create($data);

        return back();

    }
}
