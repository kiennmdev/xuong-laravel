<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newProducts = Product::query()->latest('id')->where('is_new', '=', true)->limit(8)->get();

        $products = Product::query()->latest('id')->limit(8)->get();

        $productBestSellers = Product::query()->with('tags')->where('price_sale', '<>', null)->latest('id')->limit(4)->get();

        return view('client.home', compact('newProducts', 'products', 'productBestSellers'));
    }
}
