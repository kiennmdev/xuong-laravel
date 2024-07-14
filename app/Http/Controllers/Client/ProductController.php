<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList() {
        $products = Product::query()->latest('id')->paginate(9);
        return view('client.shop', compact('products'));
    }

    public function productDetail(string $slug) {
        // dd($product->toArray());

        $product = Product::query()->with('catalogue', 'galleries','tags', 'variants')->where('slug', '=', $slug)->firstOrFail();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        // dd($product->toArray());

        $productImgColorTMP = [];
        $productImgColor = [];
        foreach ($product->variants as $variant) {
            $productImgColorTMP[$variant->product_color_id] = $variant;
        }
        // dd($product->variants->toArray());
        // dd($productImgColorTMP);
        // $productImgColor = array_unique($productImgColorTMP);
        // dd(array_unique($productImgColorTMP));
        
        return view('client.product-detail', compact('product', 'colors', 'sizes'));
    }
}
