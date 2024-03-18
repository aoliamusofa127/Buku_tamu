@extends('layout.template')
@section('content')
    <form action="/login-akun" method="POST">
        @csrf
        <div class="row mt-5">
            <div class="col-sm-6 mx-auto">
                <div class="card shadow-lg border  border-light">
                    <div class="card-body">
                        @foreach ($data_logo as $val)
                            <div style="justify-content: center; align-items: center; text-align: center;">
                                <img style="" src="{{ $val->logo }}" width="200" alt="404">
                            </div>
                        @endforeach
                        @foreach ($nama_dinas as $row)
                        <h5 class="card-title text-center text-color-blue mt-2">LOGIN ADMIN</h5>
                        <p class="card-text text-center text-color-blue">Buku tamu {{$row->nama_dinas}}.</p>
                        @endforeach
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
                        <div class="mb-3">
                            <label for="nama-lengkap" class="form-label">Username</label>
                            <input value="{{ old('username') }}" required class="form-control" type="text"
                                name="username" id="nama-lengkap" placeholder="masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input value="{{ old('password') }}" required class="form-control" type="password"
                                name="password" id="password" placeholder="Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" class="btn tombol-simpan">Masuk</button>
                            <a href="/" class="btn tombol-kembali mb-3">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
