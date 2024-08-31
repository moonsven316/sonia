@extends('layouts.app')
@section('content')
<section class="py-5 container">
    <div class="row py-lg-5 g-3">
        <div>
            <p class="page-ja-title">ジャンル設定</p>
            <p class="page-en-title">Genre Setting</p>
        </div>
        <div class="col-lg-4">
            <div class="list-group" style="overflow-y: scroll; max-height: 250px;">
                @if (count($categories) == 0)
                <div class="text-center">
                    <p>登録された業種情報はありません。</p>
                </div>
                @else
                    
                @endif
                @foreach ($categories as $category)
                <label class="list-group-item d-flex gap-2">
                  <input class="form-check-input flex-shrink-0" type="radio" name="category" id="category" onchange="get_category({{ $category->id }})">
                  <span>
                    {{ $category->name }}
                  </span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="col-lg-8 border p-4">
            <form method="POST" action="{{ route('shop.category_create') }}">
                @csrf
                <input type="hidden" name="category_id" id="category_id" value="0">
                <div class="mb-3">
                  <label for="category_name" class="form-label">業種名</label>
                  <input type="text" class="form-control" id="category_name" name="category_name">
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
    <script>
        function get_category(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('shop.get_category') }}",
                method: 'post',
                data: {
                    category_id:id
                },
                success: function(data) {
                    $("#category_id").val(data.id);
                    $("#category_name").val(data.name);
                    var update_btn = `<button type="submit" class="btn btn-secondary">保存</button>
                                    <button type="submit" class="btn btn-success">更新</button>
                                    <button type="button" class="btn btn-danger" onclick="category_delete(${data.id})">削除</button>`;
                    $("#sub_btn").html(update_btn);
                }
            });
        }

        function category_delete(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('shop.category_delete') }}",
                method: 'post',
                data: {
                    category_id:id
                },
                success: function(data) {
                    location.href = "{{ route('shop.category') }}";
                }
            });
        }
    </script>
@endsection