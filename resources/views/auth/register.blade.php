@extends('layout.template')
@section('content')
    <form action="/register" method="POST">
        @csrf
        <div class="row mt-5">
            <div class="col-sm-6 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center text-primary">Register akun</h5>
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
                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                            <a href="/" class="text text-warning mx-auto">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
