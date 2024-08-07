<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function  momoPayment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = session('order')['total_price'];
        $orderId = time() . "";
        $redirectUrl = "http://xuong-laravel-v2.test/handle/momo";
        $ipnUrl = "http://xuong-laravel-v2.test/handle/momo";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there

        return redirect($jsonResult['payUrl']);
        // header('Location: ' . $jsonResult['payUrl']);
    }

    public function handleOrder(Request $request)
    {
        $resultCode = $request->query('resultCode');

        if($resultCode == '1006') {
            return redirect()->route('checkout.view');
        } else {
            $userInfo = session('order');

            try {
                DB::transaction(function () use ($userInfo) {

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
                            'status_payment' => 'paid',
                            'discount' => $userInfo['discount'] ?? 0,
                            'total_price' => $userInfo['total_price'],

                        ]);
                    } else {

                        $user = User::query()->create([
                            'name' => $userInfo['user_name'],
                            'email' => $userInfo['user_email'],
                            'password' => bcrypt($userInfo['user_email']),
                            'phone' => $userInfo['user_phone'],
                            'address' => $userInfo['user_address'],
                            'is_active' => false,
                        ]);

                        $order = Order::query()->create([
                            'user_id' => $user->id,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'user_phone' => $user->phone,
                            'user_address' => $user->address,
                            'discount' => $userInfo['discount'] ?? 0,
                            'total_price' => $userInfo['total_price'],
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
}
