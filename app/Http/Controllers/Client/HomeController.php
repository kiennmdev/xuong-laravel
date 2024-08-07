<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newProducts = Product::query()->latest('id')->where('is_new', '=', true)->limit(8)->get();

        $products = Product::query()->latest('id')->limit(8)->get();

        $productBestSellers = Product::query()->with('tags')->where('price_sale', '<>', null)->latest('id')->limit(4)->get();

        $banners = Banner::query()->latest('id')->get();

        $currentDate = Carbon::now()->format('Y-m-d');

        $coupons = Coupon::query()->where('expiry', '>', $currentDate)->latest('id')->get();
        
        return view('client.home', compact('newProducts', 'products', 'productBestSellers', 'banners', 'coupons'));
    }
}
