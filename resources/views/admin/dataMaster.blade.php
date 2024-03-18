@extends('layout.template-admin')
@section('content')
    <div class="page-heading">
        <div class="page-title">
          
            <div class="row">
                <div class="col-12 col-md-6 mx-auto text-center mb-3 order-md-1 order-last">
                    <h3>Data Qr - Code</h3>
                </div>
            </div>
            @forelse ($data_master as $item)
                
            @empty
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    <div class="fas fa-plus"></div>
                    Tambah data
                </button>
            </div>
            @endforelse
        </div>
        <section class="section">
            <div>
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Button trigger modal -->

                    <div class="mb-2">
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            <div class="fas fa-plus"></div>
                            Tambah data
                        </button> --}}
                    </div>
                    <h3 class="ms-3">QR- Code</h3>
                    <div class="table-responsive d-flex">
                        @foreach ($data_master as $item)
                            {!! QrCode::size(214)->backgroundColor(255, 255, 255)->generate($item->link_barcode) !!}
                            <span></span>
                        @endforeach
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama dinas</th>
                                    <th class="text-center">Link barcode</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_master as $val)
                                    <tr class="text-center">

                                        <td>{{ $val->nama_dinas }}</td>
                                        <td>{{ $val->link_barcode }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#ModalEdit{{ $val->dataMaster_id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#ModalHapus{{ $val->dataMaster_id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal add-->
    <div class="modal modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data master</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/add-dataMaster" method="post">
                    <div class="modal-body">

                        @csrf
                        <div class="mb-3">
                            <label for="input-nama-dinas" class="form-label">Nama dinas</label>
                            <input value="{{ old('nama_dinas') }}" required class="form-control" type="text"
                                name="nama_dinas" id="input-nama-dinas" placeholder="masukkan nama dinas">
                        </div>
                        <div class="mb-3">
                            <label for="input-link-barcode" class="form-label">Link barcode</label>
                            <input value="{{ old('link_barcode') }}" required class="form-control" type="text"
                                name="link_barcode" id="input-link-barcode" placeholder="masukkan link barcode">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal add --}}

    @forelse ($data_master as $row)
        <!-- Modal update-->
        <div class="modal modal-lg" id="ModalEdit{{ $row->dataMaster_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data master</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/update-dataMaster" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="dataMaster_id" value="{{ $row->dataMaster_id }}"
                                class="form-control">
                            <div class="mb-3">
                                <label for="input-nama-dinas" class="form-label">Nama dinas</label>
                                <input value="{{ $row->nama_dinas }}" required class="form-control" type="text"
                                    name="nama_dinas" id="input-nama-dinas">
                            </div>
                            <div class="mb-3">
                                <label for="input-link-barcode" class="form-label">Link barcode</label>
                                <input value="{{ $row->link_barcode }}" required class="form-control" type="text"
                                    name="link barcode" id="input-link-barcode">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal add --}}


        <!-- modal hapus -->
        <div class="modal fade" id="ModalHapus{{ $row->dataMaster_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data ini..?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                        <a href="/delete-dataMaster/{{ $row->dataMaster_id }}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
      
    @endforelse
@endsection
