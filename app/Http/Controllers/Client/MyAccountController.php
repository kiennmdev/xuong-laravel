<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index() {

        $userID = Auth::user()->id;

        $orders = Order::query()->where('user_id', '=', $userID)->latest('id')->get();

        return view('client.my-account', compact('orders'));
    }
}
