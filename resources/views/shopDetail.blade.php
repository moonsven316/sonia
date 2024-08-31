@extends('layouts.app')
@section('content')
<section class="py-2 container">
    <div class="row py-lg-5 g-3">
        <div class="d-flex justify-content-between py-2">
            <div class="">
                <p class="page-ja-title">店舗詳細</p>
                <p class="page-en-title">Store Information</p>
            </div>
            <div class="">
                <button class="btn btn-light btn_bg text-light btn-md phone_gradient_btn" onclick="window.history.back()">戻る</button>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">店舗検索</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $shop->name }}</li>
            </ol>
        </nav>
        <div class="col-lg-5 col-md-6 mx-auto">
            <div class="row mb-3">
                <div class="text-center">
                    <h3>{{ $shop->name }}</h3>
                </div>
                @if (Auth::user()->role == 1)
                <div class="text-end" style="margin-top: -40px;">
                    <a href="{{ route('shop.edit', $shop->id) }}" class="btn btn-light btn_bg text-light btn-lg phone_gradient_btn">編集する</a>
                </div>
                @endif
            </div>
            <div class="px-auto mb-3 g-3">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $image)
                        <div class="carousel-item @if ($loop->index == 0) active @endif">
                            <div class="container">
                                <img src="{{ asset($image->image) }}" data-clipboard-text="{{ asset($image->image) }}" class="img-fluid mx-auto mb-5" alt="..." width="100%" style="height:400px;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <i class="fa-solid fa-circle-chevron-left" style="color: black; font-size: 50px;" aria-hidden="true"></i>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <i class="fa-solid fa-circle-chevron-right" style="color: black; font-size: 50px;" aria-hidden="true"></i>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="px-auto mb-3 g-3">
                <div class="row mb-5">
                    <div class="list-group list-group-light">
{{-- -------------------------------------------------------- --}}
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>店名</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->name_role }}" class="text-start">{{ $shop->name }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>都道府県</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->prefecture_id_role }}" class="text-start">{{ $shop_prefecture->name }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>エリア</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->area_id_role }}" class="text-start">{{ $shop_area->name }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>店舗住所</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->address_role }}" class="text-start">{{ $shop->address }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>系列店</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->affiliated_stores_role }}" class="text-start">{{ $shop->affiliated_stores }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>営業時間/定休日</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->business_time_role }}" class="text-start">{{ $shop->business_time }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>身分証</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->identification_role }}" class="text-start">{{ $shop->identification }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>衣装</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->costume_role }}" class="text-start">{{ $shop->costume }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>卓数(メイン・VIP)</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->main_vip_role }}" class="text-start">{{ $shop->main_vip }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>年齢・シフト週</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->age_shift_week_role }}" class="text-start">{{ $shop->age_shift_week }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>給与システム・ボーダーライン</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_role->salary_system_role }}" class="text-start">{{ $shop->salary_system }}</p>
                            </div>
                        </div>
{{-- ------------------------------------- --}}
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>本指バック</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_back_pay_role->honin_back_role }}" class="text-start">{{ $shop_back_pay->honin_back }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>同伴バック</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_back_pay_role->accompanying_customers_role }}" class="text-start">{{ $shop_back_pay->accompanying_customers }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>場内バック</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_back_pay_role->on_site_back_role }}" class="text-start">{{ $shop_back_pay->on_site_back }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>ドリンクバック</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_back_pay_role->drink_back_role }}" class="text-start">{{ $shop_back_pay->drink_back }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>ボトル/シャンパンバック</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_back_pay_role->bottle_champagene_back_role }}" class="text-start">{{ $shop_back_pay->bottle_champagene_back }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>ボトル原価引き</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_back_pay_role->cost_bottle_role }}" class="text-start">{{ $shop_back_pay->cost_bottle }}</p>
                            </div>
                        </div>
{{-- ---------------------------------------------------------}}
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>所得税</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_deducte_role->income_tax_role }}" class="text-start">{{ $shop_deducte->income_tax }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>厚生費</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_deducte_role->welfare_expense_role }}" class="text-start">{{ $shop_deducte->welfare_expense }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>ヘアメ代金</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_deducte_role->cost_hair_role }}" class="text-start">{{ $shop_deducte->cost_hair }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>レンタル衣装代金</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_deducte_role->costume_rental_fee_role }}" class="text-start">{{ $shop_deducte->costume_rental_fee }}</p>
                            </div>
                        </div>
{{-- ---------------------------------------------------------------}}
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>ノルマ</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_penalty_role->quota_role }}" class="text-start">{{ $shop_penalty->quota }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>遅刻ペナルティ</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_penalty_role->tardiness_penalty_role }}" class="text-start">{{ $shop_penalty->tardiness_penalty }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>当欠ペナルティ</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_penalty_role->begin_n_penalty_role }}" class="text-start">{{ $shop_penalty->begin_n_penalty }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>無欠ペナルティ</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_penalty_role->show_n_penalty_role }}" class="text-start">{{ $shop_penalty->show_n_penalty }}</p>
                            </div>
                        </div>
{{-- ---------------------------------------------------------- --}}
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>費用</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_transport_role->expense_role }}" class="text-start">{{ $shop_transport->expense }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>範囲</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_transport_role->scope_role }}" class="text-start">{{ $shop_transport->scope }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>時間帯</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_transport_role->time_day_role }}" class="text-start">{{ $shop_transport->time_day }}</p>
                            </div>
                        </div>
{{-- ----------------------------------------- --}}
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>客層</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_other_role->clientele_role }}" class="text-start">{{ $shop_other->clientele }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>寮の有無</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_other_role->dormitory_role }}" class="text-start">{{ $shop_other->dormitory }}</p>
                            </div>
                        </div>
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom">
                            <div class="col-4">
                                <p>店舗PR</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $shop_other_role->shop_pr_role }}" class="text-start">{{ $shop_other->shop_pr }}</p>
                            </div>
                        </div>
{{-- ----------------------------------------------------------------- --}}
                        @foreach ($add_items as $item)
                        <div class="row list-group-item-action px-3 border-0 py-3 border-bottom" aria-current="true">
                            <div class="col-4">
                                <p>{{ $item->add_item_label }}</p>
                            </div>
                            <div class="col-8">
                                <p data-role="{{ $item->add_item_role }}">{{ $item->add_item_content }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row py-5">
                <div class="text-center mb-3">
                    <button href="http://" class="btn btn-light btn-md btn_bg" onclick="copyDetailed()" style="box-shadow: 5px 5px 5px rgba(0,0,0,.2)">概要をコピーする</button>
                </div>
                <div class="text-center">
                    <button href="http://" class="btn btn-light btn-md btn_bg" onclick="copySummary()" style="box-shadow: 5px 5px 5px rgba(0,0,0,.2)">詳細をコピーする</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    function copySummary() {
        const text = [];

        // Shop information
        var shopName = "{{ $shop->name }}";
        if (shopName != "") {
            text.push("店名: " + "{{ $shop->name }}");
        }
        var shop_prefecture = "{{ $shop_prefecture->name }}";
        if (shop_prefecture != "") {
            text.push("都道府県: " + "{{ $shop_prefecture->name }}");
        }
        var shop_area = "{{ $shop_area->name }}";
        if (shop_area != "") {
            text.push("エリア: " + "{{ $shop_area->name }}");
        }
        var shop_address = "{{ $shop->address }}";
        if (shop_address != "") {
            text.push("店舗住所: " + "{{ $shop->address }}");
        }
        var affiliated_stores = "{{ $shop->affiliated_stores }}";
        if (affiliated_stores != "") {
            text.push("系列店: " + "{{ $shop->affiliated_stores }}");
        }
        var business_time = "{{ $shop->business_time }}";
        if (business_time != "") {
            text.push("営業時間/定休日: " + "{{ $shop->business_time }}");
        }
        var identification = "{{ $shop->identification }}";
        if (identification != "") {
            text.push("身分証: " + "{{ $shop->identification }}");
        }
        var costume = "{{ $shop->costume }}";
        if (costume != "") {
            text.push("衣装: " + "{{ $shop->costume }}");
        }
        var main_vip = "{{ $shop->main_vip }}";
        if (main_vip != "") {
            text.push("卓数(メイン・VIP): " + "{{ $shop->main_vip }}");
        }
        var age_shift_week = "{{ $shop->age_shift_week }}";
        if (age_shift_week != "") {
            text.push("年齢・シフト週: " + "{{ $shop->age_shift_week }}");
        }
        var salary_system = "{{ $shop->salary_system }}";
        if (salary_system != "") {
            text.push("給与システム・ボーダーライン: " + "{{ $shop->salary_system }}");
        }

        // Back pay
        var honin_back = "{{ $shop_back_pay->honin_back }}";
        if (honin_back != "") {
            text.push("本指バック: " + "{{ $shop_back_pay->honin_back }}");
        }
        var accompanying_customers = "{{ $shop_back_pay->accompanying_customers }}";
        if (accompanying_customers != "") {
            text.push("同伴バック: " + "{{ $shop_back_pay->accompanying_customers }}");
        }
        var on_site_back = "{{ $shop_back_pay->on_site_back }}";
        if (on_site_back != "") {
            text.push("場内バック: " + "{{ $shop_back_pay->on_site_back }}");
        }
        var drink_back = "{{ $shop_back_pay->drink_back }}";
        if (drink_back != "") {
            text.push("ドリンクバック: " + "{{ $shop_back_pay->drink_back }}");
        }
        var bottle_champagene_back = "{{ $shop_back_pay->bottle_champagene_back }}";
        if (bottle_champagene_back != "") {
            text.push("ボトル/シャンパンバック: " + "{{ $shop_back_pay->bottle_champagene_back }}");
        }
        var cost_bottle = "{{ $shop_back_pay->cost_bottle }}";
        if (cost_bottle != "") {
            text.push("ボトル原価引き: " + "{{ $shop_back_pay->cost_bottle }}");
        }

        // Deductions
        var income_tax = "{{ $shop_deducte->income_tax }}";
        if (income_tax != "") {
            text.push("所得税: " + "{{ $shop_deducte->income_tax }}");
        }
        var welfare_expense = "{{ $shop_deducte->welfare_expense }}";
        if (welfare_expense != "") {
            text.push("厚生費: " + "{{ $shop_deducte->welfare_expense }}");
        }
        var cost_hair = "{{ $shop_deducte->cost_hair }}";
        if (cost_hair != "") {
            text.push("ヘアメ代金: " + "{{ $shop_deducte->cost_hair }}");
        }
        var costume_rental_fee = "{{ $shop_deducte->costume_rental_fee }}";
        if (costume_rental_fee != "") {
            text.push("レンタル衣装代金: " + "{{ $shop_deducte->costume_rental_fee }}");
        }

        // Penalties
        var quota = "{{ $shop_penalty->quota }}";
        if (quota != "") {
            text.push("ノルマ: " + "{{ $shop_penalty->quota }}");
        }
        var tardiness_penalty = "{{ $shop_penalty->tardiness_penalty }}";
        if (tardiness_penalty != "") {
            text.push("遅刻ペナルティ: " + "{{ $shop_penalty->tardiness_penalty }}");
        }
        var begin_n_penalty = "{{ $shop_penalty->begin_n_penalty }}";
        if (begin_n_penalty != "") {
            text.push("当欠ペナルティ: " + "{{ $shop_penalty->begin_n_penalty }}");
        }
        var show_n_penalty = "{{ $shop_penalty->show_n_penalty }}";
        if (show_n_penalty != "") {
            text.push("無欠ペナルティ: " + "{{ $shop_penalty->show_n_penalty }}");
        }

        // Transport
        var expense = "{{ $shop_transport->expense }}";
        if (expense != "") {
            text.push("費用: " + "{{ $shop_transport->expense }}");
        }
        var scope = "{{ $shop_transport->scope }}";
        if (scope != "") {
            text.push("範囲: " + "{{ $shop_transport->scope }}");
        }
        var time_day = "{{ $shop_transport->time_day }}";
        if (time_day != "") {
            text.push("時間帯: " + "{{ $shop_transport->time_day }}");
        }

        // Other
        var clientele = "{{ $shop_other->clientele }}";
        if (clientele != "") {
            text.push("客層: " + "{{ $shop_other->clientele }}");
        }
        var dormitory = "{{ $shop_other->dormitory }}";
        if (dormitory != "") {
            text.push("寮の有無: " + "{{ $shop_other->dormitory }}");
        }
        var shop_pr = "{{ $shop_other->shop_pr }}";
        if (shop_pr != "") {
            text.push("店舗PR: " + "{{ $shop_other->shop_pr }}");
        }

        // Additional items
        var addItem = {!! json_encode($add_items) !!};
        if (addItem.length > 0) {
            for (var i = 0; i < addItem.length; i++) {
                if (addItem[i].add_item_content && addItem[i].add_item_content !== "") {
                    text.push(addItem[i].add_item_label + ": " + addItem[i].add_item_content);
                }
            }
        }


        if (text.length === 0) {
            alert('No data to copy.');
            return;
        }

        navigator.clipboard.writeText(text.join("\n"));
        alert('コピーしました');
    }

    function copyDetailed() {
        const labelElements = document.querySelectorAll('.col-4 > p:not([data-role])');
        const valueElements = document.querySelectorAll('p[data-role]');
        if (labelElements.length !== valueElements.length) {
            alert('Error: Mismatch in the number of labels and values.');
            return;
        }

        let copyText = '';
        for (let index = 0; index < valueElements.length; index++) {
            const label = labelElements[index].textContent.trim();
            const value = valueElements[index].textContent.trim();
            const role = valueElements[index].dataset['role'];

            if (role === '0' && value !== '') {
                copyText += `${label}: ${value}\n`;
            }
        }

        if (copyText === '') {
            alert('No label-value pairs with data-role="0" found.');
            return;
        }

        navigator.clipboard.writeText(copyText.trim());
        alert('コピーしました');
    }



</script>
@endsection
