<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList() {

        $key = request()->search;

        $products = Product::query()->with('catalogue')->where('name', 'like', "%$key%")->latest('id')->paginate(9);

        return view('client.shop', compact('products'));
    }

    public function productDetail(string $slug) {
        
        $product = Product::query()->with('catalogue', 'galleries','tags', 'variants')->where('slug', '=', $slug)->firstOrFail();
        
        $comments = Comment::query()->with('user')->where('product_id', $product->id)->get();
        
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $productBestSellers = Product::query()->where('price_sale', '<>', null)->latest('id')->limit(8)->get();
        
        return view('client.product-detail', compact('product', 'colors', 'sizes', 'comments', 'productBestSellers'));
    }

    public function productCatalogue(string $id) {

        $products = Product::query()->where('catalogue_id', '=', $id)->latest('id')->paginate(9);

        return view('client.shop', compact('products'));
    }
}
