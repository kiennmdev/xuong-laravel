<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Đặt Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .invoice-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invoice-header,
        .invoice-details,
        .invoice-items,
        .invoice-summary {
            margin-bottom: 20px;
        }

        .invoice-header {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .invoice-header h1 {
            margin: 0;
            color: #333;
        }

        .invoice-header .date {
            text-align: right;
            color: #777;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
        }

        .invoice-details .info {
            width: 48%;
        }

        .invoice-details .info h3 {
            margin-top: 0;
            color: #333;
        }

        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .invoice-items table,
        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ddd;
        }

        .invoice-items th,
        .invoice-items td {
            padding: 10px;
            text-align: left;
        }

        .invoice-items th {
            background-color: #f2f2f2;
        }

        .invoice-summary {
            text-align: right;
            font-weight: bold;
        }

        .invoice-summary .total {
            font-size: 1.2em;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Hóa Đơn</h1>
            <div class="date">
                Ngày hóa đơn: {{ \Carbon\Carbon::parse($order['created_at'])->format('d-m-Y') }}
                <p>Mã hóa đơn: #{{ $order['id'] }}</p>
            </div>
        </div>
        <div class="invoice-details">
            <div class="info">
                <h3>Khách hàng</h3>
                <p>Tên khách hàng: {{ $order['user_name'] }}</p>
                <p>Địa chỉ: {{ $order['user_address'] }}</p>
                <p>Số điện thoại: {{ $order['user_phone'] }}</p>
            </div>
            <div class="info">
                <h3>Cửa hàng</h3>
                <p>Cửa hàng Kenne</p>
                <p>Địa chỉ: 456 Đường DEF, Nam Từ Liêm, TP. Hà Nội</p>
                <p>Email: kenner@shop.com</p>
            </div>
        </div>
        <div class="invoice-items">
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng giá</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity_purchase'] }}</td>
                            <td>{{ number_format($item['price_sale'] ?: $item['price_regular'], 0, ',', '.') }} VNĐ
                            </td>
                            <td>{{ number_format(($item['price_sale'] ?: $item['price_regular']) * $item['quantity_purchase'], 0, ',', '.') }}
                                VNĐ</td>
                        </tr>
                    @endforeach

                    @php
                        $totalTemp = 0;
                        foreach ($orderItems as $item) {
                            if ($item['price_sale'] > 0) {
                                $totalTemp += $item['price_sale'] * $item['quantity_purchase'];
                            } else {
                                $totalTemp += $item['price_regular'] * $item['quantity_purchase'];
                            }
                        }
                    @endphp

                    <tr>
                        <th colspan="3" style="text-align: center; background-color: white;">Tạm tính</th>
                        <td>{{ number_format($totalTemp, 0, ',', '.') }} VNĐ</td>
                    </tr>

                    @if ($order['discount'] > 0)
                        <tr>
                            <th colspan="3" style="text-align: center; background-color: white;">Giảm giá</th>
                            <td>-{{ number_format($order['discount'], 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endif

                    <tr>
                        <th colspan="3" style="text-align: center; background-color: white;">Tổng</th>
                        <td>{{ number_format($order['total_price'], 0, ',', '.') }} VNĐ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-summary">
            <p class="total">Tổng cộng: {{ number_format($order['total_price'], 0, ',', '.') }} VNĐ</p>
        </div>
    </div>
</body>

</html>
