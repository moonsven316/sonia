@extends('layouts.app')
@section('content')
<section class="py-5 container bg123">
    <div class="row py-lg-3 g-3">
        <div>
            <p class="page-ja-title">店舗検索</p>
            <p class="page-en-title">Search</p>
        </div>
        <div class="col-lg-12 col-md-12 mx-auto border" style="box-shadow: 5px 5px 5px rgba(0,0,0,.2)">
            <div class="py-5 px-5">
                <div class="bd-example">
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <div class="row gy-2 gx-3 align-items-center mb-4">
                            <div class="col-12 col-sm-12 col-md-5 col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text" id="search_keyword"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" id="search_keyword" name="search_keyword" placeholder="キーワードから探す">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-5 col-lg-4">
                                <div class="dropdown">
                                    <div class="input-group">
                                        <span class="input-group-text" id="pre_citys"><i class="fa-solid fa-map-location-dot"></i></span>
                                        <button class="dropdown-toggle form-control text-start" id="prefecture_dropdown" data-mdb-toggle="dropdown">エリアから探す</button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="prefecture_dropdown" style="min-width:310px;">
                                            <div class="d-flex border-bottom">
                                                <div class="col-sm-5 col-5" style="height: 200px; overflow-y: scroll;">
                                                    <ul class="nav flex-column" id="myTab4" role="tablist" aria-orientation="vertical">
                                                        <?php $prefectures = App\Models\PrefectureRegion::all();?>
                                                        @foreach ($prefectures as $prefecture)
                                                        @if ( count($prefecture->shops) != 0 )
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="tab{{ $prefecture->id }}-tab" data-bs-toggle="tab" href="#tab{{ $prefecture->id }}" role="tab" aria-controls="tab{{ $prefecture->id }}" aria-selected="false" style="color:black;">{{ $prefecture->name }}</a>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-sm-7 col-7" style="height: 200px; overflow-y: scroll; overflow-x: hidden;">
                                                    <div class="tab-content" id="myTabContent4">
                                                        @foreach ($prefectures as $prefecture)
                                                        @if ( count($prefecture->shops) != 0 )
                                                        <div class="tab-pane fade" id="tab{{ $prefecture->id }}" role="tabpanel" aria-labelledby="tab{{ $prefecture->id }}-tab">
                                                            <?php $cities = App\Models\CityRegion::where('prefecture_id', $prefecture->id)->get(); ?>
                                                            <div class="row mb-3">
                                                                <div class="mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="cityall{{ $prefecture->id }}" data-city-all={{ $prefecture->id }} onchange="cityAll(event)">
                                                                        <label class="form-check-label" for="cityall{{ $prefecture->id }}">{{ $prefecture->name }}すべて</label>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                                @foreach ($cities as $city)
                                                                @if (count($city->shops) != 0)
                                                                <div class="col-md-12 col-12 mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" data-pref_id={{ $prefecture->id }} id="{{ $city->id }}" name="city{{ $city->id }}">
                                                                        <label class="form-check-label" for="{{ $city->id }}">{{ $city->name }}</label>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end mt-2">
                                                <button type="button" id="searchEntry" class="btn btn-secondary btn-sm" data-mdb-dismiss="dropdown">確定</button>
                                            </div>
                                            <input type="hidden" name="prefecture_city" id="prefecture_city">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-5 col-lg-3">
                                <div class="dropdown">
                                    <div class="input-group">
                                        <span class="input-group-text" id="search_keyword"><i class="bi bi-geo-alt-fill"></i></span>
                                        <button class="dropdown-toggle form-control text-start" id="category_dropdown" data-mdb-toggle="dropdown" aria-expanded="false">ジャンルから探す</button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="category_dropdown">
                                            <?php $categories = App\Models\Shopcategory::all(); ?>
                                            @foreach ($categories as $category)
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <div class="form-check">
                                                        <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                                                        <input class="form-check-input" type="checkbox" id="category{{ $category->id }}" onchange="get_category(event ,{{ $category->id }})">
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                            <input type="hidden" name="category" id="category">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                <button type="submit" class="btn btn-light w-100 btn_bg text-light gradient_button">検索する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="hero">
   <span class="curve"></span>
 </div>
<section class="bg-image" style="background-color: #F7F7F6;">
    <div class="container py-5">
        <div class="row mb-3">  
            <p class="page-ja-title">電話番号一覧</p>
            <p class="page-en-title">Phone Call</p>
        </div>
        <div class="row g-3">
            <?php $prefectures = App\Models\PrefectureRegion::all();?>
            @foreach ($prefectures as $prefecture)
            @if ( count($prefecture->phone) != 0 )
            <div class="col-md-4">
                <h5 class="mb-4">{{ $prefecture->name }}</h4>
                <?php $phone = App\Models\PhoneNumber::where('prefecture_id', $prefecture->id)->get(); ?>
                @foreach ($phone as $phone_item)
                <p>{{ $phone_item->shop_name }}　{{ $phone_item->representative }}：<button class="btn" onclick="window.location.href = 'tel:{{ $phone_item->phonenumber }}'">{{ $phone_item->phonenumber }}</button></p>
                @endforeach
            </div>
            @endif
            @endforeach
        </div>
        @if (Auth::user()->role == 1)
        <div class="row pt-4 mb-4">
            <div class="text-center">
                <button type="button" class="btn btn-light btn_bg text-light phone_gradient_btn btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModalLg">電話番号追加</button>
            </div>
        </div>
        @endif
    </div>
</section>
<div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('phone.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">電話番号追加</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="prefecture_id" class="form-label">都道府県</label>
                            <select class="form-control" name="prefecture_id" id="prefecture_id">
                                <?php $prefectures = App\Models\PrefectureRegion::all(); ?>
                                @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="shop_name" class="form-label">店名</label>
                            <input type="text" class="form-control" id="shop_name" name="shop_name">
                        </div>
                        <div class="mb-3">
                            <label for="representative" class="form-label">代表者</label>
                            <input type="text" class="form-control" id="representative" name="representative">
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">電話番号</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-secondary phone_gradient_btn">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready( function() {
            $("#searchEntry").on('click', function(){
                $('#prefecture_dropdown').dropdown('hide');
                const cities = $('input[type="checkbox"][data-pref_id]');
                const citiesChecked = [];
                const prefecture_cityChecked = [];
                for (let i = 0; i < cities.length; i++) {
                    if (cities[i].checked) {
                        const label = cities[i].parentElement.querySelector('.form-check-label');
                        const cityName = label.textContent;
                        prefecture_cityChecked.push(cities[i].id);
                        citiesChecked.push(cityName);
                    }
                }
                const prefecturecityList = prefecture_cityChecked.join(",");
                const prefectureCity = document.getElementById('prefecture_city');
                prefectureCity.value = prefecture_cityChecked;
            });
        });
        function cityAll(e) {
            var pref_id = e.target.dataset['cityAll'];
            var city_all = $("[data-pref_id=" + pref_id + "]");
            if (e.target.checked == true) {
                for (let i = 0; i < city_all.length; i++) {
                    console.log(city_all[i]);
                    $(city_all[i]).prop('checked', true);
                }
            } else {
                for (let i = 0; i < city_all.length; i++) {
                    console.log(city_all[i]);
                    $(city_all[i]).prop('checked', false);
                }
            }
        }
        const categories = [];
        function get_category (e, id) {
            if (e.target.checked == true) {
                categories.push(id);
            } else {
                const index = categories.indexOf(id);
                if (index > -1) {
                    categories.splice(index, 1);
                }
            }
            const category = document.getElementById('category');
            category.value = categories;
        }
    </script>
@endsection