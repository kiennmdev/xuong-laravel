<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    const PATH_VIEW = 'admin.orders.';

    public function index()
    {
        $orders = Order::query()->latest('id')->paginate(10);
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;
        // dd($orders->toArray());
        return view(self::PATH_VIEW . __FUNCTION__, compact('orders', 'statusOrder', 'statusPayment'));
    }

    public function update(Request $request, Order $order) {
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;

        $statusOrderUpdate = $request->status_order;
        $statusPaymentUpdate = $request->status_payment;

        $checkStatusOrder = false;
        $checkStatusPayment = false;

        foreach ($statusOrder as $key => $value) {
            if($statusOrderUpdate === $key) {
                $checkStatusOrder = true;
                break;
            }
        }

        foreach ($statusPayment as $key => $value) {
            if($statusPaymentUpdate === $key) {
                $checkStatusPayment = true;
                break;
            }
        }

        if($checkStatusOrder && $checkStatusPayment) {
            $order->update($request->toArray());
            $msg = 'Cập nhật đơn hàng thành công!';
            return redirect()->route('admin.order.index')->with('msg', $msg);
        } else {
            $msg = 'Cập nhật đơn hàng thất bại!';
            return redirect()->route('admin.order.index')->with('msg', $msg);     
        }
    }

    public function detail(Order $order)
    {
        $orderItems = OrderItem::query()->where('order_id', $order->id)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('orderItems', 'order'));

    }
    
}
