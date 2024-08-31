@extends('layouts.app')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
<section class="py-2 container">
    <div class="row py-lg-5 g-3 px-3">
        <div>
            <p class="page-ja-title">店舗編集</p>
            <p class="page-en-title">Edit Store</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">店舗検索</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('shop.detail', $shop->id) }}">{{ $shop->name }}</a></li>
            </ol>
        </nav>
        <form class="col-lg-10 col-md-10 mx-auto border rounded p-5 mb-4" method="POST" action="{{ route('shop.update') }}" id="_form" enctype="multipart/form-data" style="box-shadow: 0px 6px 12px rgba(0,0,0,.2)">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id  }}"> 
            {{-- <input type="hidden" name="image_id" value="{{ $image->id  }}">  --}}
            <input type="hidden" name="role_id" value="{{ $shop_role->id  }}"> 
            <div class="row mb-5 border-bottom">
                <div class="col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                    <h5>項目</h5>
                    <p><span class="text-danger">*</span>は必須項目</p>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                    <h5>記入欄</h5>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-12 mb-3">
                    <h5>管理者コピー権限</h5>
                    <p>管理者のみコピーできるようにする場合チェックを入れる</p>
                </div>
            </div>
            <div class="img_list">
                @if (count($images) > 0)
                @foreach ($images as $image)
                <div class="imgUp">
                    <div class="row mb-2">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-7">
                            <label type="button" class="btn btn-light btn-md btn_bg phone_gradient_btn text-light">
                                画像をアップロード
                                <input type="file" id="imgInp" name="image_{{ $loop->iteration }}" hidden class="uploadFile">
                                <input type="hidden" name="image_id_{{ $loop->iteration }}" value="{{ $image->id }}">
                            </label>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <div class="row imagePreview">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-7">
                            <div class="position-relative">
                                <img src="{{ asset($image->image) }}" class="img-fluid mx-auto mb-3 img" id='img-upload' alt="..." width="100%">
                                <button type="button" class="position-absolute top-0 start-100 translate-middle bg-light border border-light rounded-circle remove-button" onclick="imageDelete({{ $image->id }})">
                                    <i class="bi bi-x-circle fs-4"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="imgUp">
                    <div class="row mb-2">
                        <div class="col-lg-2">
                            <p>店舗画像</p>
                        </div>
                        <div class="col-lg-7">
                            <label type="button" class="btn btn-light btn-md btn_bg phone_gradient_btn text-light">
                                画像をアップロード
                                <input type="file" id="imgInp" name="new_image_1" hidden class="uploadFile">
                            </label>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <div class="row imagePreview">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-7">
                            <div class="position-relative">
                                <img src="{{ asset('assets/image/32.png') }}" class="img-fluid mx-auto mb-3 img" id='img-upload' alt="..." width="100%">
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
                @endif
                <div id="img_add_list"></div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-7">
                    <div class="text-center">
                        <button type="button" class="btn" id="img_add" data-img-count = {{ count($images) }}><i class="bi bi-plus-circle" style="font-size: 30px;"></i></button>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            {{-- name --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>店名<span class="text-danger">*</span></p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $shop->name }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="name_role" name="name_role" @if ($shop_role->name_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- category --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>業種<span class="text-danger">*</span></p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <select name="category" id="category" class="form-control">
                        <?php $categories = App\Models\Shopcategory::all(); ?>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($shop->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="category_role" name="category_role" @if ($shop_role->category_id_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- prefecture --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>都道府県<span class="text-danger">*</span></p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <select class="form-control" name="prefecture_id" id="prefecture_id">
                        <?php $prefectures = App\Models\PrefectureRegion::all(); ?>
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" @if ($shop->prefecture_id == $prefecture->id) selected @endif>{{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="prefecture_id_role" name="prefecture_id_role" @if ($shop_role->prefecture_id_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- area --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>エリア</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <select class="form-control" name="area_id" id="area_id">
                        @foreach ($shop_area as $shop_area_item)
                            <option value="{{ $shop_area_item->id }}" @if ($shop_area_item->id == $shop->shop_area_item_id) selected @endif>{{ $shop_area_item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="area_id_role" name="area_id_role" @if ($shop_role->area_id_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- address --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>店舗住所</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="address" id="address" class="form-control" value="{{ $shop->address }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="address_role" name="address_role" @if ($shop_role->address_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- affiliated --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>系列店</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="affiliated_stores" id="affiliated_stores" class="form-control" value="{{ $shop->affiliated_stores }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="affiliated_stores_role" name="affiliated_stores_role" @if ($shop_role->affiliated_stores_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- identification --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>身分証</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="identification" id="identification" class="form-control" value="{{ $shop->identification }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="identification_role" name="identification_role" @if ($shop_role->identification_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- costume --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>衣装</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="costume" id="costume" class="form-control" value="{{ $shop->costume }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="costume_role" name="costume_role" @if ($shop_role->costume_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- main_vip --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>卓数 <br> (メイン・VIP)</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="main_vip" id="main_vip" class="form-control" value="{{ $shop->main_vip }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="main_vip_role" name="main_vip_role" @if ($shop_role->main_vip_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- age_shift_week --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>年齢・シフト週</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="age_shift_week" id="age_shift_week" class="form-control" value="{{ $shop->age_shift_week }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="age_shift_week_role" name="age_shift_week_role" @if ($shop_role->age_shift_week_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- salary_system --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>給与システム/ <br> ボーダーライン</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="salary_system" id="salary_system" class="form-control" value="{{ $shop->salary_system }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="salary_system_role" name="salary_system_role" @if ($shop_role->salary_system_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- -------------------------------------------------------- --}}
            <div class="row mb-4">
                <div class="text-center">
                    <p>ーーーーバック類ーーーーー</p>
                </div>
            </div>
            {{-- honin_back --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>本指バック</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="honin_back" id="honin_back" class="form-control" value="{{ $shop_back_pay->honin_back }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="honin_back_role" name="honin_back_role" @if ($shop_back_pay_role->honin_back_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- accompanying_customers --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>同伴バック</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="accompanying_customers" id="accompanying_customers" class="form-control" value="{{ $shop_back_pay->accompanying_customers }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="accompanying_customers_role" name="accompanying_customers_role" @if ($shop_back_pay_role->accompanying_customers_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- on_site_back --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>場内バック</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="on_site_back" id="on_site_back" class="form-control" value="{{ $shop_back_pay->on_site_back }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="on_site_back_role" name="on_site_back_role" @if ($shop_back_pay_role->on_site_back_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- drink_back --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>ドリンクバック</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="drink_back" id="drink_back" class="form-control" value="{{ $shop_back_pay->drink_back }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="drink_back_role" name="drink_back_role" @if ($shop_back_pay_role->drink_back_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- bottle_champagene_back --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>ボトル/ <br> シャンパンバック</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="bottle_champagene_back" id="bottle_champagene_back" class="form-control" value="{{ $shop_back_pay->bottle_champagene_back }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="bottle_champagene_back_role" name="bottle_champagene_back_role" @if ($shop_back_pay_role->bottle_champagene_back_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- cost_bottle --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>ボトル原価引き</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="cost_bottle" id="cost_bottle" class="form-control" value="{{ $shop_back_pay->cost_bottle }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="cost_bottle_role" name="cost_bottle_role" @if ($shop_back_pay_role->cost_bottle_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- -------------------------------------------------------- --}}
            <div class="row mb-4">
                <div class="text-center">
                    <p>ーーーーー引かれものーーーーー</p>
                </div>
            </div>
            {{-- income_tax --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>所得税</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="income_tax" id="income_tax" class="form-control" value="{{ $shop_deducte->income_tax }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="income_tax_role" name="income_tax_role" @if ($shop_deducte_role->income_tax_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- welfare_expense --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>厚生費</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="welfare_expense" id="welfare_expense" class="form-control" value="{{ $shop_deducte->welfare_expense }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="welfare_expense_role" name="welfare_expense_role" @if ($shop_deducte_role->welfare_expense_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- cost_hair --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>ヘアメ代金</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="cost_hair" id="cost_hair" class="form-control" value="{{ $shop_deducte->cost_hair }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="cost_hair_role" name="cost_hair_role" @if ($shop_deducte_role->cost_hair_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- costume_rental_fee --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>レンタル衣装代金</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="costume_rental_fee" id="costume_rental_fee" class="form-control" value="{{ $shop_deducte->costume_rental_fee }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="costume_rental_fee_role" name="costume_rental_fee_role" @if ($shop_deducte_role->costume_rental_fee_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- -------------------------------------------------------- --}}
            <div class="row mb-4">
                <div class="text-center">
                    <p>ーーーーーノルマ/ペナルティーーーーー</p>
                </div>
            </div>
            {{-- quota --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>ノルマ</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="quota" id="quota" class="form-control" value="{{ $shop_penalty->quota }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="quota_role" name="quota_role" @if ($shop_penalty_role->quota_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- tardiness_penalty --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>遅刻ペナルティ</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="tardiness_penalty" id="tardiness_penalty" class="form-control" value="{{ $shop_penalty->tardiness_penalty }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="tardiness_penalty_role" name="tardiness_penalty_role" @if ($shop_penalty_role->tardiness_penalty_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- begin_n_penalty --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>当欠ペナルティ</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="begin_n_penalty" id="begin_n_penalty" class="form-control" value="{{ $shop_penalty->begin_n_penalty }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="begin_n_penalty_role" name="begin_n_penalty_role" @if ($shop_penalty_role->begin_n_penalty_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- show_n_penalty --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>無欠ペナルティ</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="show_n_penalty" id="show_n_penalty" class="form-control" value="{{ $shop_penalty->show_n_penalty }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="show_n_penalty_role" name="show_n_penalty_role" @if ($shop_penalty_role->show_n_penalty_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- -------------------------------------------------------- --}}
            <div class="row mb-4">
                <div class="text-center">
                    <p>ーーーーー送りについてーーーーー</p>
                </div>
            </div>
            {{-- expense --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>費用</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="expense" id="expense" class="form-control" value="{{ $shop_transport->expense }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="expense_role" name="expense_role" @if ($shop_transport_role->expense_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- scope --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>範囲</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="scope" id="scope" class="form-control" value="{{ $shop_transport->scope }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="scope_role" name="scope_role" @if ($shop_transport_role->scope_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- time_day --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>時間帯</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="time_day" id="time_day" class="form-control" value="{{ $shop_transport->time_day }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="time_day_role" name="time_day_role" @if ($shop_transport_role->time_day_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- -------------------------------------------------------- --}}
            <div class="row mb-4">
                <div class="text-center">
                    <p>ーーーーーその他ーーーーー</p>
                </div>
            </div>
            {{-- clientele --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>客層</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="clientele" id="clientele" class="form-control" value="{{ $shop_other->clientele }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="clientele_role" name="clientele_role" @if ($shop_other_role->clientele_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- dormitory --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>寮の有無</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="dormitory" id="dormitory" class="form-control" value="{{ $shop_other->dormitory }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="dormitory_role" name="dormitory_role" @if ($shop_other_role->dormitory_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            {{-- shop_pr --}}
            <div class="row mb-4">
                <div class="col-lg-2">
                    <p>店舗PR</p>
                </div>
                <div class="col-lg-7 col-sm-9 col-9">
                    <input type="text" name="shop_pr" id="shop_pr" class="form-control" value="{{ $shop_other->shop_pr }}">
                </div>
                <div class="col-lg-3 col-sm-3 col-3">
                    <div class="text-center">
                        <input class="form-check-input form-control-md mt-2" type="checkbox" id="shop_pr_role" name="shop_pr_role" @if ($shop_other_role->shop_pr_role == 1) checked  @endif>
                    </div>
                </div>
            </div>
            <div id="item_list">
                @foreach ($add_items as $item)
                <div class="row mb-4">
                    <div class="col-lg-2 col-sm-4 col-6 mb-2">
                        <input type="text" name="item_label_{{ $loop->iteration }}" id="item_label_{{ $loop->iteration }}" class="form-control" value="{{ $item->add_item_label }}">
                    </div>
                    <div class="col-lg-7 col-sm-9 col-9">
                        <input type="text" name="item_content_{{ $loop->iteration }}" id="item_content_{{ $loop->iteration }}" class="form-control" value="{{ $item->add_item_content }}">
                    </div>
                    <div class="col-lg-3 col-sm-3 col-3">
                        <div class="text-center">
                            <input class="form-check-input form-control-md mt-2" type="checkbox" id="item_role_{{ $loop->iteration }}" name="item_role_{{ $loop->iteration }}" @if ($item->add_item_role == 1) checked @endif>
                        </div>
                    </div>
                    <input type="hidden" name="item_id_{{ $loop->iteration }}" value="{{ $item->id }}">
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-7">
                    <div class="text-center">
                        <button type="button" class="btn" id="item_add"><i class="bi bi-plus-circle" style="font-size: 30px;"></i></button>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </form>
        <div class="row py-4">
            <div class="text-center mb-3">
                <button class="btn btn-light btn-md btn_bg phone_gradient_btn text-light" data-bs-toggle="modal" data-bs-target="#shopUpdate">店舗情報を更新する</button>
            </div>
            <div class="text-center">
                <button class="btn btn-light btn-md btn_bg phone_gradient_btn text-light" data-bs-toggle="modal" data-bs-target="#shopDelete">店舗を削除する</button>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="shopUpdate" tabindex="-1" aria-labelledby="shopUpdateTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>店舗情報を更新しますか？</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="shop_update()">はい</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="shopDelete" tabindex="-1" aria-labelledby="shopDeleteTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>店舗情報を<span class="text-danger">削除</span>しますか？</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="shop_delete({{ $shop->id }})">はい</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="imagecropper" tabindex="-1" aria-labelledby="imagecropperTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <canvas id="canvas">
                Your browser does not support the HTML5 canvas element.
            </canvas>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btnCrop">はい</button>
            <button type="button" class="btn btn-secondary" id="btnRestore">いいえ</button>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready( function() {
        var img_count = $("#img_add").data('imgCount');
        console.log(img_count);
        $('#prefecture_id').select2();
        $('#area_id').select2();
        if (img_count > 0) {
            var imageUploadNames = [];
            for (let index = 0; index < img_count; index++) {
                imageUploadNames.push('image_' + index);
            }
        } else {
            var imageUploadNames = ['new_image_1'];
        }
        $("#img_add").on('click', function(){
            var img_list = document.getElementById('img_add_list');
            if (imageUploadNames.length >= 5) return;
            var newIndex = imageUploadNames.length + 1;
            imageUploadNames.push(`new_image_${newIndex}`);
            var img = `<div class="imgUp">
                            <div class="row mb-2">
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-7">
                                    <label type="button" class="btn btn-light btn-md btn_bg phone_gradient_btn text-light">
                                        画像をアップロード
                                        <input type="file" id="imgInp" name="${imageUploadNames[imageUploadNames.length - 1]}" hidden class="uploadFile">
                                    </label>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <div class="row imagePreview">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-7">
                                    <div class="position-relative">
                                        <img src="{{ asset('assets/image/32.png') }}" class="img-fluid mx-auto mb-3 img" id='img-upload' alt="..." width="100%" >
                                        <span class="position-absolute top-0 start-100 translate-middle bg-light border border-light rounded-circle remove-button">
                                            <i class="bi bi-x-circle fs-4"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                        </div>`;
            img_list.insertAdjacentHTML('beforeend', img);
            console.log(imageUploadNames);
        });
        $('#img_add_list').on('click', '.remove-button', function() {
            var $this = $(this);
            var $imgUp = $this.closest('.imgUp');
            var index = $('.imgUp').index($imgUp);
            $imgUp.remove();
            imageUploadNames.splice(index, 1);
            $('.uploadFile').each(function(i) {
                $(this).attr('name', `image_${i+1}`);
            });
        });
        $(function() {
            $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                console.log(files);
                if (!files.length || !window.FileReader) return;
        
                if (/^image/.test( files[0].type)){
                    var reader = new FileReader();
                    console.log(reader);
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function(){
                        uploadFile.closest(".imgUp").find('.imagePreview').find('.img').attr('src', ""+this.result+"");
                    }
                }
            });
        });
        // var canvas  = $("#canvas"),
        //     context = canvas.get(0).getContext("2d"),
        //     $result = $('#img-upload');
        // const modal = new bootstrap.Modal(document.getElementById('imagecropper'));
        // $('#imgInp').on( 'change', function(){
        //     modal.show();
        //     if (this.files && this.files[0]) {
        //         if ( this.files[0].type.match(/^image\//) ) {
        //             var reader = new FileReader();
        //             reader.onload = function(evt) {
        //                 var img = new Image();
        //                 img.onload = function() {
        //                     canvas.cropper('reset').cropper('destroy');
        //                     canvas.attr({
        //                         width: img.width,
        //                         height: img.height
        //                     });
        //                     canvas[0].getContext('2d').drawImage(img, 0, 0);
        //                     canvas.cropper({
        //                         aspectRatio: 16 / 9,
        //                         viewMode: 0,
        //                         autoCropArea: 0,
        //                         dragCrop: false,
        //                         cropBoxResizable: false,
        //                         minCropBoxWidth: 600,
        //                         minCropBoxHeight: 400,
        //                         minContainerWidth: 600,
        //                         minContainerHeight: 400
        //                     });
        //                     $('#btnCrop').click(function() {
        //                         var croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png"); 
        //                         // $result.append( $('<img>').attr('src', croppedImageDataURL) );
        //                         $result.attr('src', croppedImageDataURL);
        //                         modal.hide();
        //                     });
        //                     $('#btnRestore').click(function() {
        //                         canvas.cropper('reset');
        //                         $result.empty();
        //                     });
        //                 };
        //                 img.src = evt.target.result;
        //             };
        //             reader.readAsDataURL(this.files[0]);
        //         } else {
        //             alert("Invalid file type! Please select an image file.");
        //         }
        //     } else {
        //         alert('No file(s) selected.');
        //     }
        // });
        $("#item_add").on('click', function(){
            var end_list = document.getElementById('item_list').lastElementChild.querySelector('input[type=text]').id;
            var end_list_count = parseInt(end_list.split('_')[2]);
            var item_list = document.getElementById('item_list');
            var item = `<div class="row mb-4">
                            <div class="col-lg-2 col-sm-4 col-6 mb-2">
                                <input type="text" name="item_label_${end_list_count + 1}" id="item_label_${end_list_count + 1}" class="form-control">
                            </div>
                            <div class="col-lg-7 col-sm-9 col-9">
                                <input type="text" name="item_content_${end_list_count + 1}" id="item_content_${end_list_count + 1}" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-3 col-3">
                                <div class="text-center">
                                    <input class="form-check-input form-control-md mt-2" type="checkbox" id="item_role_${end_list_count + 1}" name="item_role_${end_list_count + 1}">
                                </div>
                            </div>
                        </div>`;
            item_list.insertAdjacentHTML('beforeend', item);
        });
        $("#prefecture_id").on('change', function () {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get_city') }}",
                method: 'post',
                data: {
                    pref_id:$(this).val()
                },
                success: function(data) {
                    var options = data.map(function(item) {
                        return `<option value="${item.id}">${item.name}</option>`;
                    }).join('');
                    $("#area_id").html(options);
                }
            });
        });
	});
    function shop_update() {
        $("#_form").submit();
    }
    function shop_delete(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('shop.delete') }}",
            method: 'post',
            data: {
                shop_id:id
            },
            success: function(data) {
                location.href = "{{ route('dashboard') }}"
            }
        });
    }
    function imageDelete(image_id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('image.delete') }}",
            method: 'post',
            data: {
                id:image_id
            },
            success: function(data) {
                toastr.success('画像が削除されました。');
                setTimeout(function() {
                    location.reload();
                }, 1500); 
            }
        });
    }
    
</script>
@endsection