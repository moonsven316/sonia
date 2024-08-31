<nav class="navbar navbar-expand-lg fixed-top bg-white d-flex" aria-label="Main navigation" style="border-bottom: 1px solid black;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/image/sonia_logo.png') }}" alt="logo" style="max-width: 170px;">
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation" >
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 text-white">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" <?php if(strpos(url()->current(), "dashboard")) echo 'class="nav-link nav-link1 active" aria-current="page"'; else echo 'class="nav-link nav-link1"';?>>店舗検索</a>
                </li>
                @if (Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('shop.create') }}" <?php if(strpos(url()->current(), "shop_create")) echo 'class="nav-link nav-link1 active" aria-current="page"'; else echo 'class="nav-link nav-link1"';?>>店舗追加</a>
                </li>
                <li class="nav-item">
                    <a  href="{{ route('shop.area') }}" <?php if(strpos(url()->current(), "shop_area")) echo 'class="nav-link nav-link1 active" aria-current="page"'; else echo 'class="nav-link nav-link1"';?>>エリア設定</a>
                </li>
                <li class="nav-item">
                    <a  href="{{ route('shop.category') }}" <?php if(strpos(url()->current(), "shop_category")) echo 'class="nav-link nav-link1 active" aria-current="page"'; else echo 'class="nav-link nav-link1"';?>>ジャンル設定</a>
                </li>
                <li class="nav-item">
                    <a  href="{{ route('phone.edit') }}" <?php if(strpos(url()->current(), "phone_list")) echo 'class="nav-link nav-link1 active" aria-current="page"'; else echo 'class="nav-link nav-link1"';?>>電話番号編集</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link nav-link1" href="{{ route('logout') }}">ログアウト</a>
                </li>
            </ul>
        </div>
    </div>
</nav>