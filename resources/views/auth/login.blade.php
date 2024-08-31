@extends('layouts.guest')
@section('style')
<link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
@endsection
@section('content')
<body>
    <main class="form-signin">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <div class="text-center">
                    <img src="{{ asset('assets/image/grad_sonia_logo.png') }}" alt="logo" style="width: 100%;">
                </div>
            </div>
            <div class="py-3 px-3" style="background-color: #404040;">
                <div class="mb-3">
                    <label for="email" class="form-label text-light">会員ID</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" name="email" autofocus>
                    @if ($errors->has('email'))
                        <div id="email-error" class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-light">パスワード</label>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password">
                    @if ($errors->has('password'))
                        <div id="password-error" class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="text-center mb-3">
                    <div><a href="{{ route('register') }}" class="text-primary text-light">新規登録はこちらから</a></div>
                </div>
                <button class="w-100 btn btn-lg btn-light mb-3 gradient_button" type="submit">ログイン</button>
                <div class="text-center">
                    <div><a href="{{ route('password.request') }}" class="text-primary text-light">パスワードを忘れた？</a></div>
                </div>
            </div>
        </form>
    </main>
</body>
@endsection