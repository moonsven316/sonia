@extends('layouts.app')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<section class="py-5 container">
    <div class="row py-lg-5 g-3">
        <div>
            <p class="page-ja-title">エリア設定</p>
            <p class="page-en-title">Area Setting</p>
        </div>
        <div class="col-lg-4">
            <div style="overflow-y: scroll; max-height: 250px;">
                <?php $prefecture = App\Models\PrefectureRegion::all(); ?>
                <div class="accordion" id="accordionExample">
                    @foreach ($prefecture as $prefecture_item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $prefecture_item->id }}" aria-expanded="false" aria-controls="collapseTwo{{ $prefecture_item->id }}" style="padding: 5px 1.25rem;">
                                {{ $prefecture_item->name }}
                            </button>
                        </h2>
                        <div id="collapseTwo{{ $prefecture_item->id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="padding: 0;">
                                @if (count($prefecture_item->areas) == 0)
                                <div class="text-center py-2">
                                    <p>登録されたエリア情報はありません。</p>
                                </div>
                                @else
                                @foreach ($prefecture_item->areas as $item)
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="area" id="area" onchange="get_area({{ $item->id }})">
                                    <span>
                                      {{ $item->name }}
                                    </span>
                                </label>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-8 border p-4">
            <form method="POST" action="{{ route('shop.area_create') }}">
                @csrf
                <input type="hidden" name="area_id" id="area_id" value="0">
                <div class="mb-3">
                    <label for="prefecture_name" class="form-label">都道府県</label>
                    <select class="form-control" name="prefecture_name" id="prefecture_name">
                        @foreach ($prefecture as $prefecture_item)
                        <option value="{{ $prefecture_item->id }}">{{ $prefecture_item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                  <label for="area_name" class="form-label">エリア名</label>
                  <input type="text" class="form-control" id="area_name" name="area_name">
                </div>
                <div id="sub_btn">
                    <button type="submit" class="btn btn-secondary">保存</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready( function() {
            $('#prefecture_name').select2();
        });
        function get_area(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('shop.get_area') }}",
                method: 'post',
                data: {
                    area_id:id
                },
                success: function(data) {
                    var options = data.prefecture.map(function(item) {
                        if (item.id == data.area[0].prefecture_id) {
                            return `<option value="${item.id}" selected>${item.name}</option>`;
                        }
                        return `<option value="${item.id}">${item.name}</option>`;
                    }).join('');
                    $("#prefecture_name").html(options);

                    $("#area_id").val(data.area[0].id);
                    $("#area_name").val(data.area[0].name);
                    var update_btn = `<button type="submit" class="btn btn-secondary">保存</button>
                                    <button type="submit" class="btn btn-success">更新</button>
                                    <button type="button" class="btn btn-danger" onclick="area_delete(${data.area[0].id})">削除</button>`;
                    $("#sub_btn").html(update_btn);
                }
            });
        }
        function area_delete(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('shop.area_delete') }}",
                method: 'post',
                data: {
                    area_id:id
                },
                success: function(data) {
                    location.href = "{{ route('shop.area') }}";
                }
            });
        }
    </script>
@endsection