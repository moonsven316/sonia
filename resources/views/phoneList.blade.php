@extends('layouts.app')
@section('style')
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" rel="stylesheet">
@endsection
@section('content')
<section class="py-5 container bg123">
    <div class="row py-lg-3 g-3">
        <div>
            <p class="page-ja-title">電話番号編集</p>
            <p class="page-en-title">PhoneNumber setting</p>
        </div>
        <div class="col-lg-10 col-md-10 mx-auto">
            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">店名</th>
                        <th class="text-center">代表者</th>
                        <th class="text-center">電話番号</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phonenumbers as $phone)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $phone->shop_name }}</td>
                        <td class="text-center">{{ $phone->representative }}</td>
                        <td class="text-center">{{ $phone->phonenumber }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0);" id="shopedit" data-bs-toggle="modal" data-bs-target="#phoneedit" onclick="get_phone({{ $phone->id }})"><i class="bi bi-pencil-square"></i></a>
                            <a href="javascript:void(0);" onclick="phone_delete({{ $phone->id }})"><i class="bi bi-trash3"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade" id="phoneedit" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('phone.update') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">電話番号編集</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="phone_id" id="phone_id" value="">
                        <div class="mb-3">
                            <label for="prefecture_id" class="form-label">都道府県</label>
                            <select class="form-control" name="prefecture_id" id="prefecture_id">
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
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function(){
            new DataTable('#example', {
                responsive: true
            });
        });
        function get_phone(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('phone.get') }}",
                method: 'post',
                data: {
                    phone_id:id
                },
                success: function(data) {
                    console.log(data.getphone.id);
                    var options = data.prefectures.map(function(item) {
                        return `<option value="${item.id}" ${item.id === data.getphone.prefecture_id ? 'selected' : ''}>${item.name}</option>`;
                    }).join('');
                    $("#prefecture_id").html(options);
                    $("#phone_id").val(data.getphone.id);
                    $("#shop_name").val(data.getphone.shop_name);
                    $("#representative").val(data.getphone.representative);
                    $("#phone_number").val(data.getphone.phonenumber);
                }
            });
        }
        function phone_delete(id) {
            var result = confirm("このアイテムを削除してもよろしいですか?");
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('phone.delete') }}",
                    method: 'post',
                    data: {
                        phone_id:id
                    },
                    success: function(data) {
                        location.href = "{{ route('phone.edit') }}"
                    }
                });
            }
        }
    </script>
@endsection