@extends('layout.template')
@section('content')
    @foreach ($dataindustri as $row)
        <div class=" card-group shadow rounded mt-5 position-relative">
            <div class="card border border-0" style="background-color: #5BBCFF">
                <div class="mx-auto">
                    <img src="{{ $row->logo }}" width="400"
                        style="justify-content: center; align-items: center; text-align: center; margin-top: 40px;"
                        alt="404">
                </div>
                <div class="card-body">
                    <h3 class="card-title text-center mt-5">{{ $row->content }}
                    </h3>
                    <h5 class="card-title text-center mt-5" style="margin-top: 20px;">{{ $row->sub_content }}</h5>
                </div>
                <footer class="text-center mt-3">
                    <div class="d-sm-flex align-items-center justify-content-center text-center m-3 gap-3">

                        {{-- youtube --}}
                        <a target="_blank" href="{{ $row->link_youtube }}"
                            class="text-center text-red shadow-light fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow">
                            <img src="{{ asset('assets/images/logo/youtube.svg') }}" width="30" alt="">
                        </a>
                        {{-- instagram --}}
                        <a target="_blank" href="{{ $row->link_instagram }}"
                            class="text-ig shadow-light fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow">
                            <img src="{{ asset('assets/images/logo/instagram.svg') }}" width="25" alt="">
                        </a>
                        {{-- facebook --}}
                        <a target="_blank" href="{{ $row->link_facebook }}"
                            class="text-facebook shadow-light fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow">
                            <img src="{{ asset('assets/images/logo/icons8-facebook.svg') }}" width="30" alt="">
                        </a>
                    </div>
                </footer>
            </div>
            <div class="card border border-0">
                <div class="card-body">
                    <h5 class="card-title text-center text-color-blue mt-3">{{ $row->kutipan }}</h5>
                    <div class="row justify-content-md-center mt-5 mb-5">
                        @foreach ($data as $item)
                            {!! QrCode::size(214)->backgroundColor(255, 255, 255)->generate($item->link_barcode) !!}
                        @endforeach
                        <h5 class="card-title text-center text-color-blue mt-4">Silahkan klik link berikut untuk terhubung
                            ke form <a href="form-tamu" style="text-decoration: none"> buku tamu <i class="fa fa-link"
                                    aria-hidden="true"></i></a>
                        </h5>
                    </div>

                </div>
            </div>

        </div>
    @endforeach
@endsection
