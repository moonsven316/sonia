<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/offcanvas.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/cropper.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        @yield('style')
    </head>
    <body>
        @include('layouts.header')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
        {{-- <div class="modal fade" id="prefecture" tabindex="-1" aria-labelledby="prefectureTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="prefectureTitle">エリアから探す</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tabs tabs-vertical">
                        <div class="row">
                            <div class="col-md-3" style="height: 50vh; overflow-y: scroll;">
                                <ul class="nav flex-column nav-tabs" id="myTab4" role="tablist" aria-orientation="vertical">
                                    <?php $prefectures = App\Models\PrefectureRegion::all();?>
                                    @foreach ($prefectures as $prefecture)
                                    @if ( count($prefecture->shops) != 0 )
                                    <li class="nav-item jsutify-between">
                                        <a class="nav-link" id="tab{{ $prefecture->id }}-tab" data-bs-toggle="tab" href="#tab{{ $prefecture->id }}" role="tab" aria-controls="tab{{ $prefecture->id }}" aria-selected="false">{{ $prefecture->name }}<i class="bi bi-check-circle-fill" hidden></i></a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-9" style="height: 50vh; overflow-y: scroll;">
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
                                            <div class="col-md-4 mb-3">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="searchEntry" class="btn btn-secondary"  data-bs-dismiss="modal">確定</button>
                </div>
              </div>
            </div>
        </div> --}}
    </body>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/cropper.min.js') }}"></script>
    <script src="https://getbootstrap.com/docs/5.0/examples/offcanvas-navbar/offcanvas.js"></script>
    <script>
        $(document).ready( function() {
            const dropdownElementList = document.querySelectorAll('.dropdown-toggle');
            const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));
        });
    </script>
    @yield('script')
</html>