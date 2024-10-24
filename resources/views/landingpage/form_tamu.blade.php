@extends('layout.template')
@section('content')
    <form action="/add-tamu" method="post">
        @csrf
        <div class="row mt-5">
            <div class="col-sm-6 mx-auto">
                <div class="card shadow-lg border border-light">
                    <div class="card-body">
                        <h5 class="card-title text-center text-color-blue mt-3">FORM INPUT DATA TAMU</h5>
                        <p class="card-text text-center text-color-blue">Silahkan isi formulir buku tamu.</p>
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
                            <label for="nama-lengkap" class="form-label">Nama lengkap</label>
                            <input type="text" class="form-control" id="nama-lengkap" name="nama"
                                placeholder="masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="pilih-jenis-kelamin" class="form-label">Jenis kelamin</label> <br>
                            <div class="form-check form-check-inline" id="pilih-jenis-kelamin">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki"
                                    id="input-laki">
                                <label class="form-check-label" for="input-laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline" id="pilih-jenis-kelamin">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan"
                                    id="input-perempuan">
                                <label class="form-check-label" for="input-perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat / Instansi</label>
                            <input type="text" name="alamat_atau_instansi" class="form-control" id="alamat"
                                placeholder="masukkan alamat">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" wire:model="email" class="form-control"
                                placeholder="Email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telepon-hp" class="form-label">Telepon / HP</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="telepon" class="form-control" id="telepon-hp"
                                    placeholder="nomor telepon">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="request_pegawai" class="form-label">Ingin bertemu dengan</label>
                            <select class="form-select" name="pegawai_id">
                                <option selected class="text-secondary">pilih pegawai</option>
                                @foreach ($data_pegawai as $row)
                                    <option value="{{ $row->pegawai_id }}">{{ $row->nama_pegawai }} - {{ $row->jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="request-tanggal" class="form-label">Tanggal bertemu </label>
                            <p class="text text-danger">-- ( boleh di kosongkan jika ingin bertamu hari ini ) --</p>
                            <input type="date" name="request_tanggal" class="form-control" id="request-tanggal">
                        </div>
                        <div class="mb-3">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" name="keperluan" id="input-keperluan-bertamu" style="height: 100px"></textarea>
                                <label for="input-keperluan-bertamu">Keperluan</label>
                            </div>
                        </div>
                        <a href="/" class="btn tombol-kembali">Kembali</a>
                        <button type="submit" class="btn tombol-simpan">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
