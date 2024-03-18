@extends('layout.template-admin')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mx-auto text-center mb-3 order-md-1 order-last">
                    <h3>Data Pegawai</h3>
                </div>  
            </div>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            <div class="fas fa-plus"></div>
                            Tambah data
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama pegawai</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($data_pegawai as $val)
                                    <tr class="text-center">
                                        <td><?= $i++ ?></td>
                                        <td>{{ $val->nama_pegawai }}</td>
                                        <td>{{ $val->jabatan }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#ModalEdit{{ $val->pegawai_id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#ModalHapus{{ $val->pegawai_id }}">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data pegawai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/add-pegawai" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="input-nama-pegawai" class="form-label">Nama pegawai</label>
                            <input value="{{ old('nama_pegawai') }}" required class="form-control" type="text"
                                name="nama_pegawai" id="input-nama-pegawai" placeholder="masukkan nama pegawai">
                        </div>
                        <div class="mb-3">
                            <label for="input-jabatan" class="form-label">Jabatan</label>
                            <input value="{{ old('jabatan') }}" required class="form-control" type="text" name="jabatan"
                                id="input-jabatan" placeholder="masukkan jabatan">
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

    @foreach ($data_pegawai as $row)
        <!-- Modal update-->
        <div class="modal modal-lg" id="ModalEdit{{ $row->pegawai_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data user</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/update-pegawai" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="pegawai_id" value="{{ $row->pegawai_id }}" class="form-control">
                            <div class="mb-3">
                                <label for="input-nama-pegawai" class="form-label">Nama pegawai</label>
                                <input value="{{ $row->nama_pegawai }}" required class="form-control" type="text"
                                    name="nama_pegawai" id="input-nama-pegawai">
                            </div>
                            <div class="mb-3">
                                <label for="input-jabatan" class="form-label">Jabatan</label>
                                <input value="{{ $row->jabatan }}" required class="form-control" type="text"
                                    name="jabatan" id="input-jabatan">
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
        <div class="modal fade" id="ModalHapus{{ $row->pegawai_id }}" tabindex="-1"
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
                        <a href="/delete-pegawai/{{ $row->pegawai_id }}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end-modal hapus -->
    @endforeach
    
@endsection
