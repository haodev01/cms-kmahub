@php use App\Helpers\AssetsHelper; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{AssetsHelper::assetKiaalap('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{AssetsHelper::assetKiaalap('vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{AssetsHelper::assetKiaalap('css/app.css')}}">
    <link rel="stylesheet" href="{{AssetsHelper::assetKiaalap('css/pages/auth.css')}}">
</head>

<body>
<div id="auth">

    <div class=" h-100 d-flex justify-content-center align-items-center ">
        <div style="max-width: 480px; width: 100%" class="auth-bg">
            <div class="auth-logo">
                <a href="{{route('admin.dashboard')}}"><img
                        src="{{AssetsHelper::assetKiaalap('images/logo/logo.png')}}"
                        alt="Logo"></a>
            </div>
            <p class="auth-subtitle mb-5 mt-3 text-center">Trang quản trị hệ thống LMS</p>
            <form action="{{route('admin.login')}}" method="POST">
                @error('message')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @csrf
                <div class="form-group position-relative mb-4">
                    <label for="email" class="mb-1">Email</label>
                    <input value="{{old("email")}}" name="email" type="text" id="email"
                           class="form-control  {{$errors->has('email') ? 'is-invalid' : ''}}"
                           placeholder="Email...">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group position-relative mb-3">
                    <label for="password" class="mb-1">Mật khẩu</label>
                    <input id="password" value="{{old("password")}}" name="password" type="password"
                           class="form-control  {{$errors->has('password') ? 'is-invalid' : ''}}"
                           placeholder="**********">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check form-check-md d-flex align-items-end">
                    <input class="form-check-input me-2 mb-1" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Nhớ thiết bị
                    </label>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Đăng nhập</button>
            </form>
            <a href="{{$auth_gg_url}}" class="btn btn-success w-full d-block  mt-3">
                <img src="{{AssetsHelper::assetAdmin('images/google-logo.svg')}}" alt="">
                Đăng nhập bằng Google
            </a>
        </div>
    </div>
</div>
</body>
</html>
