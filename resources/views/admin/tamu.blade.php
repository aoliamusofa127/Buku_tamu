@extends('layout.template-admin')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mx-auto text-center mb-3 order-md-1 order-last">
                    <h3>Data Tamu</h3>
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
                                    <th class="text-center">Jenis kelamin</th>
                                    <th class="text-center">Alamat / instansi</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Telepon</th>
                                    <th class="text-center">Tempat pertemuan</th>
                                    <th class="text-center">Bertemu dengan</th>
                                    <th class="text-center">Tgl request</th>
                                    <th class="text-center">Status tamu</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($data as $val)
                                    @foreach ($val->JoinToPegawai as $row)
                                        <tr class="text-center">
                                            <td><?= $i++ ?></td>
                                            <td>{{ $val->nama }}</td>
                                            <td>{{ $val->jenis_kelamin }}</td>
                                            <td>{{ $val->alamat_atau_instansi }}</td>
                                            <td>{{ $val->email }}</td>
                                            <td>{{ $val->telepon }}</td>
                                            <td>{{ $val->tempat_pertemuan ?? 'NULL' }}</td>
                                            <td>{{ $row->nama_pegawai }}</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($val->request_tanggal)) }}
                                            </td>
                                            <td>
                                                @if ($val->status_tamu == 'verifikasi')
                                                    <p class="text-primary">{{ $val->status_tamu }}</p>
                                                @elseif($val->status_tamu == 'pending')
                                                    <p class="text-info">{{ $val->status_tamu }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="col-md-4 col-lg-4 col-sm-4">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModalEdit{{ $val->tamu_id }}">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-4">
                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                            data-bs-target="#ModalDetail{{ $val->tamu_id }}">
                                                            <i class="fas fa-info"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-4">
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#ModalHapus{{ $val->tamu_id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data tamu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/tamu-post" method="post">
                    <div class="modal-body">
                        @csrf
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
                            <div class="mb-3">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" wire:model="email" class="form-control"
                                    placeholder="Email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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
                            <label for="tempat-bertemu" class="form-label">Tempat bertemu</label>
                            <input type="text" name="tempat_pertemuan" class="form-control" id="tempat-bertemu"
                                placeholder="masukkan tempat ingin bertemu">
                        </div>
                        <div class="mb-3">
                            <label for="request_pegawai" class="form-label">Ingin bertemu dengan</label>
                            <select class="form-select" name="pegawai_id">
                                <option selected class="text-secondary">pilih pegawai</option>
                                @foreach ($data_pegawai as $row)
                                    <option value="{{ $row->pegawai_id }}">{{ $row->nama_pegawai }} -
                                        {{ $row->jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="request-tanggal" class="form-label">Tanggal bertemu </label>
                            <input type="date" name="request_tanggal" class="form-control" id="request-tanggal">
                            <p class="text text-danger">-- ( boleh di kosongkan jika ingin bertamu hari ini ) --</p>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" name="keperluan" id="input-keperluan-bertamu" style="height: 100px"></textarea>
                                <label for="input-keperluan-bertamu">Keperluan</label>
                            </div>
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

    {{-- modal edit, info dan hapus --}}
    @foreach ($data as $row)
        @foreach ($row->JoinToPegawai as $vals)
            <!-- Modal update-->
            <div class="modal modal-lg" id="ModalEdit{{ $row->tamu_id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi tamu {{ $row->nama }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/tamu-update" method="post">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="tamu_id" value="{{ $row->tamu_id }}" class="form-control">
                                <div class="mb-3">
                                    <label for="request_pegawai" class="form-label">Ingin bertemu dengan</label>
                                    <select class="form-select" name="pegawai_id">
                                        <option value="{{ $vals->pegawai_id }}" selected class="text-secondary">
                                            {{ $vals->nama_pegawai }} - {{ $vals->jabatan }}
                                        </option>
                                        @foreach ($data_pegawai as $by_id)
                                            <option value="{{ $by_id->pegawai_id }}">{{ $by_id->nama_pegawai }} -
                                                {{ $by_id->jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tempat-bertemu" class="form-label">Tempat bertemu</label>
                                    <input type="text" name="tempat_pertemuan" value="{{ $row->tempat_pertemuan }}"
                                        class="form-control" id="tempat-bertemu"
                                        placeholder="masukkan tempat ingin bertemu">
                                </div>
                                <div class="mb-3">
                                    <label for="request_pegawai" class="form-label">Status verifikasi</label>
                                    <select class="form-select" name="status_tamu">
                                        <option selected class="text-secondary">--silahkan di verifikasi--</option>
                                        <option value="pending">Pending</option>
                                        <option value="verifikasi">Verifikasi</option>
                                    </select>
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
            {{-- end modal update --}}


            <!-- Modal detail-->
            <div class="modal modal-lg" id="ModalDetail{{ $row->tamu_id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail tamu {{ $row->nama }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">
                                    <h6>Nama lengkap</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $row->nama }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Jenis kelamin</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $row->jenis_kelamin }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Alamat / instansi</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $row->alamat_atau_instansi }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Email</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $row->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Telepon / HP</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $row->telepon }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Tempat bertemu</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $row->tempat_pertemuan }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Ingin bertemu dengan</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $vals->nama_pegawai }} - {{ $vals->jabatan }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Keperluan</h6>
                                </div>
                                <div class="col-9">
                                    <p>: {{ $row->keperluan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal detail --}}


            <!-- modal hapus -->
            <div class="modal fade" id="ModalHapus{{ $row->tamu_id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus data ini..?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            <a href="/delete-tamu/{{ $row->tamu_id }}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-modal hapus -->
        @endforeach
    @endforeach

    {{-- end modal edit, info dan hapus --}}
@endsection
