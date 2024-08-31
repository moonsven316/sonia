@extends('layouts.app')
@section('content')
<section class="py-2 container">
    <div class="row py-lg-5 g-3">
        <div>
            <p class="page-ja-title">検索結果</p>
            <p class="page-en-title">Result</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">店舗検索</a></li>
                <li class="breadcrumb-item active" aria-current="page">検索結果</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-4 mb-4">
                <form class="p-4 rounded-3 text-dark" style="background-color: #dcdcdc; box-shadow: 5px 5px 5px rgba(0,0,0,.2)" method="POST" action="{{ route('search') }}">
                    @csrf
                    <div class="mb-5">
                        <div class="input-group">
                            <span class="input-group-text" id="search_keyword"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="search_keyword" name="search_keyword" placeholder="キーワードから探す" autofocus>
                        </div>
                    </div>
                    <div class="mb-5">
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
                                        <button type="button" id="searchEntry" class="btn btn-secondary btn-sm">確定</button>
                                    </div>
                                    <input type="hidden" name="prefecture_city" id="prefecture_city">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
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
                    <div class="text-center">
                        <button class="btn btn-lg btn-light mb-3 btn_bg text-light gradient_button" type="submit">検索する</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8 mb-4">
                <div class="h-100 rounded-3 text-dark px-5">
                    <div class="row">
                        @if (count($data) == 0)
                        <div class="text-center mx-auto my-auto">
                            <img src="{{ asset('assets/image/not_find.png') }}" alt="">
                            <p>店舗が見つかりませんでした。</p>
                        </div>
                        @else
                        <div class="list-group list-group-light">
                            @foreach ($data as $shop)
                            <a href="{{ route('shop.detail', $shop->id) }}" class="list-group-item list-group-item-action px-3 border-0 d-flex justify-content-between py-2" aria-current="true">
                                <span style="font-size:35px;">{{ $shop->name }}</span>
                                <i class="bi bi-arrow-right-circle" style="font-size:35px;"></i> 
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @if (count($data)) {{ $data->onEachSide(1)->links('components.pagination') }} @endif
            </div>
        </div>
    </div>
</section>
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