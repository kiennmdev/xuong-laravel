<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Events\OrderCreated;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function view()
    {
        if (!session('cart')) {

            return redirect()->route('cart.list');
        } else {

            $cart = session('cart');

            $totalAmount = session('total_amount');

            return view('client.checkout', compact('cart', 'totalAmount'));
        }
    }

    public function create(Request $request)
    {

        // dd($request->except('_token', 'payment_method'));

        if ($request->payment_method == 'momo') {

            session()->put('order', $request->except('_token'));
            return redirect()->route('payment.momo');

        } else if ($request->payment_method == 'cod'){

            try {
                DB::transaction(function () use ($request) {

                    $dataItem = [];

                    foreach (session('cart') as $variantID => $item) {

                        $dataItem[] = [
                            'product_variant_id' => $variantID,
                            'quantity' => $item['quantity_purchase'],
                            'product_name' => $item['name'],
                            'product_sku' => $item['sku'],
                            'product_img_thumbnail' => $item['img_thumbnail'],
                            'product_price_regular' => $item['price_regular'],
                            'product_price_sale' => $item['price_sale'],
                            'variant_size_name' => $item['size']['name'],
                            'variant_color_name' => $item['color']['name'],
                        ];
                    }

                    if (Auth::check()) {

                        $order = Order::query()->create([
                            'user_id' => Auth::user()->id,
                            'user_name' => Auth::user()->name,
                            'user_email' => Auth::user()->email,
                            'user_phone' => Auth::user()->phone,
                            'user_address' => Auth::user()->address,
                            'discount' => $request->discount ?? 0,
                            'total_price' => $request->total_price,

                        ]);
                    } else {

                        $user = User::query()->create([
                            'name' => $request->user_name,
                            'email' => $request->user_email,
                            'password' => bcrypt($request->user_email),
                            'phone' => $request->user_phone,
                            'address' => $request->user_address,
                            'is_active' => false,
                        ]);

                        $order = Order::query()->create([
                            'user_id' => $user->id,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'user_phone' => $user->phone,
                            'user_address' => $user->address,
                            'discount' => $request->discount ?? 0,
                            'total_price' => $request->total_price,
                        ]);
                    }

                    foreach ($dataItem as $item) {

                        $item['order_id'] = $order->id;

                        OrderItem::query()->create($item);
                    }

                    OrderCreated::dispatch(session('cart'), $order);
                });

                session()->forget(['cart', 'total_amount', 'coupon', 'order']);

                return redirect()->route('home')->with('success', 'Đặt hàng thành công');
            } catch (Exception $exception) {

                dd($exception);
            }
        }
    }

    public function detail(Order $order)
    {

        $orderItems  = Order::with('order_items')->find($order->id);

        return view('client.order-detail', compact('orderItems'));
    }

    public function addCoupon(Request $request)
    {
        $coupon = Coupon::query()->where('code', $request->coupon)->first();

        if ($coupon) {
            session()->put('coupon', $coupon);
        }

        return redirect()->route('checkout.view');
    }

    public function deleteCoupon()
    {
        session()->forget('coupon');

        return redirect()->route('checkout.view');
    }
}
