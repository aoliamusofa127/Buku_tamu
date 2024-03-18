@extends('layout.template-admin')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mx-auto text-center mb-3 order-md-1 order-last">
                    <h3>Data User</h3>
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
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($data as $val)
                                    <tr class="text-center">
                                        <td><?= $i++ ?></td>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->username }}</td>
                                        <td>{{ $val->email }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#ModalEdit{{ $val->user_id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#ModalHapus{{ $val->user_id }}">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data user</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/register" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="input-name" class="form-label">Nama lengkap</label>
                            <input value="{{ old('name') }}" required class="form-control" type="text" name="name"
                                id="input-name" placeholder="masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="input-username" class="form-label">Username</label>
                            <input value="{{ old('username') }}" required class="form-control" type="text"
                                name="username" id="input-username" placeholder="masukkan username">
                        </div>
                        <div class="mb-3">
                            <label for="input-email" class="form-label">Email</label>
                            <input value="{{ old('email') }}" required class="form-control" type="text" name="email"
                                id="input-email" placeholder="masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input value="{{ old('password') }}" required class="form-control" type="password"
                                name="password" id="password" placeholder="Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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

    @foreach ($data as $row)
        <!-- Modal update-->
        <div class="modal modal-lg" id="ModalEdit{{ $row->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data user</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/update-user" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $row->user_id }}" class="form-control">
                            <div class="mb-3">
                                <label for="input-name" class="form-label">Nama lengkap</label>
                                <input value="{{ $row->name }}" required class="form-control" type="text"
                                    name="name" id="input-name" placeholder="masukkan nama lengkap">
                            </div>
                            <div class="mb-3">
                                <label for="input-username" class="form-label">Username</label>
                                <input value="{{ $row->username }}" required class="form-control" type="text"
                                    name="username" id="input-username" placeholder="masukkan username">
                            </div>
                            <div class="mb-3">
                                <label for="input-email" class="form-label">Email</label>
                                <input value="{{ $row->email }}" required class="form-control" type="text"
                                    name="email" id="input-email" placeholder="masukkan email">
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
        <div class="modal fade" id="ModalHapus{{ $row->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                        <a href="/delete-user/{{ $row->user_id }}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end-modal hapus -->
    @endforeach
@endsection
