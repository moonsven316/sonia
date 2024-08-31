@extends('layouts.guest')
@section('style')
<link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
@endsection
@section('content')
<body>
    <main class="form-signin">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <div class="text-center">
                    <img src="{{ asset('assets/image/grad_sonia_logo.png') }}" alt="logo" style="width: 100%;">
                </div>
            </div>
            <div class="py-3 px-3" style="background-color: #404040;">
                <div class="mb-3">
                    <label for="name" class="form-label text-light">名前</label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" name="name" autofocus>
                    @if ($errors->has('name'))
                        <div id="name-error" class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-light">メールアドレス</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" name="email">
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
                <div class="mb-5">
                    <label for="password_confirmation" class="form-label text-light">パスワードを再入力</label>
                    <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <div id="password_confirmation-error" class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
                <button class="w-100 btn btn-lg btn-light mb-3 gradient_button" type="submit">新規登録</button>
                <div class="text-center">
                    <div><a href="{{ route('login') }}" class="text-primary text-light">既に登録済みの方</a></div>
                </div>
            </div>
        </form>
    </main>
</body>
@endsection