<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function list()
    {
        if (session('cart')) {
            $cart = session('cart');

            $totalAmount = 0;
            $totalQuantity = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['quantity_purchase'] * ($item['price_sale'] ?: $item['price_regular']);
                $totalQuantity +=  $item['quantity_purchase'];
            }
            
            session()->put('total_amount', $totalAmount);
            session()->put('total_quantity', $totalQuantity);

            return view('client.cart', compact('totalAmount'));

        } else {

            return view('client.cart');
            
        }
    }

    public function add()
    {
        $product = Product::query()->findOrFail(request('product_id'));
        $productVariant = ProductVariant::query()->with('color', 'size')->where(
            [
                'product_id' => request('product_id'),
                'product_color_id' => request('product_color_id'),
                'product_size_id' => request('product_size_id'),
            ]
        )->firstOrFail();


        if (!isset(session('cart')[$productVariant->id])) {
            $data = $product->toArray() + $productVariant->toArray() + ['quantity_purchase' => request('quantity')];
            session()->put('cart.' . $productVariant->id, $data);
        } else {
            $data = session('cart')[$productVariant->id];
            $data['quantity_purchase'] = request('quantity');
            session()->put('cart.' . $productVariant->id, $data);
        }
        return redirect()->route('cart.list');
    }
}
