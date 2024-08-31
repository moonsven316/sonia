@extends('layouts.guest')
@section('style')
<link href="https://getbootstrap.com/docs/5.0/examples/cover/cover.css" rel="stylesheet">
@endsection
@section('content')
<body class="d-flex text-center text-white" style="height: 100vh;">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main class="px-3 my-auto">
            <h2 class="mb-5 text-dark">メインビジュアル</h2>
            <p class="lead pt-5">
                <a href="{{ route('login') }}" class="btn btn-lg btn-secondary fw-bold border-white bg-white">ログイン</a>
            </p>
        </main>
    </div>
</body>
@endsection