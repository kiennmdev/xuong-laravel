<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Xin chào {{$userName}}</h2>
    <p>Cảm ơn đã đăng ký tài khoản web của tui</p>
    <p>Xin mời xác thực tài khoản để tiếp tục sử dụng hệ thống</p>
    <button>
        <a href="{{route('verify', $token)}}">Xác thực tài khoản</a>
    </button>
</body>
</html>