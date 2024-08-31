@extends('layouts.guest')
@section('style')
<link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
@endsection
@section('content')
<body>
    <main class="form-signin">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <div class="text-center">
                    <img src="{{ asset('assets/image/grad_sonia_logo.png') }}" alt="logo" style="width: 100%;">
                </div>
            </div>
            <div class="py-3 px-3" style="background-color: #404040;">
                <p class="text-light">
                    パスワードをお忘れですか？ <br> ご登録時のメールアドレスを入力頂ければ、パスワードリセットのためのリンクをメールで送信いたします
                </p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text-light">メールアドレス</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" autofocus>
                </div>
                <button class="w-100 btn btn-md btn-light mb-3 gradient_button" type="submit" style="font-size: 15px;">パスワードリセットメールを送信</button>
            </div>
        </form>
    </main>
</body>
@endsection
