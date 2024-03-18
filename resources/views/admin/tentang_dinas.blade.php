@extends('layout.template-admin')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 mx-auto text-center mb-3 order-md-1 order-last">
                    <h3>Tentang Dinas</h3>
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
                    @if ($count_data == 0)
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalAdd">
                                <div class="fas fa-plus"></div>
                                Tambah data
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th class="text-center">Logo</th>
                                    <th class="text-center">Content</th>
                                    <th class="text-center">Sub content</th>
                                    <th class="text-center">Link youtube</th>
                                    <th class="text-center">Link instagram</th>
                                    <th class="text-center">Link facebook</th>
                                    <th class="text-center">Kutipan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($dinas as $val)
                                    <tr class="text-center">

                                        <td><img src="{{ $val->logo }}" style="width:75px" alt="404"></td>
                                        <td>{{ $val->content }}</td>
                                        <td>{{ $val->sub_content }}</td>
                                        <td>{{ $val->link_youtube }}</td>
                                        <td>{{ $val->link_instagram }}</td>
                                        <td>{{ $val->link_facebook }}</td>
                                        <td>{{ $val->kutipan }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="col-md-6 col-lg-6 col-sm-6">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#ModalEdit{{ $val->dinas_id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-sm-6">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#ModalHapus{{ $val->dinas_id }}">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data tentang dinas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/add-tentang-dinas" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="input-logo" class="form-label">Logo</label>
                            <input value="{{ old('logo') }}" required class="form-control" type="file" name="logo"
                                id="input-logo" placeholder="masukkan logo">
                        </div>
                        <div class="mb-3">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" name="content" id="input-content" style="height: 100px"></textarea>
                                <label for="input-content">Konten</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" name="sub_content" id="input-sub-content" style="height: 100px"></textarea>
                                <label for="input-sub-content">Sub konten</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="input-link-youtube" class="form-label">Link youtube</label>
                            <input value="{{ old('link_youtube') }}" required class="form-control" type="text"
                                name="link_youtube" id="input-link-youtube" placeholder="masukkan link youtube">
                        </div>
                        <div class="mb-3">
                            <label for="input-link-instagram" class="form-label">Link instagram</label>
                            <input value="{{ old('link_instagram') }}" required class="form-control" type="text"
                                name="link_instagram" id="input-link-instagram" placeholder="masukkan link instagram">
                        </div>
                        <div class="mb-3">
                            <label for="input-link-facebook" class="form-label">Link facebook</label>
                            <input value="{{ old('link_facebook') }}" required class="form-control" type="text"
                                name="link_facebook" id="input-link-facebook" placeholder="masukkan link facebook">
                        </div>
                        <div class="mb-3">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" name="kutipan" id="input-kutipan" style="height: 100px"></textarea>
                                <label for="input-kutipan">Kutipan</label>
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

    @foreach ($dinas as $row)
        <!-- Modal update-->
        <div class="modal modal-lg" id="ModalEdit{{ $row->dinas_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update data tentang dinas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/update-tentang-dinas" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <input value="{{ $row->dinas_id }}" required class="form-control" type="hidden"
                                name="dinas_id" id="input-dinas_id">
                            <div class="mb-3">
                                <label for="input-logo" class="form-label">Logo</label>
                                <input value="{{ $row->logo }}" required class="form-control" type="file"
                                    name="logo" id="input-logo" placeholder="masukkan logo">
                                <img src="{{ $row->logo }}" width="100" alt="logo lama">
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mt-3">
                                    <textarea class="form-control" name="content" id="input-content" style="height: 100px">{{ $row->content }}</textarea>
                                    <label for="input-content">Konten</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mt-3">
                                    <textarea class="form-control" name="sub_content" id="input-sub-content" style="height: 100px">{{ $row->sub_content }}</textarea>
                                    <label for="input-sub-content">Sub konten</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="input-link-youtube" class="form-label">Link youtube</label>
                                <input value="{{ $row->link_youtube }}" required class="form-control" type="text"
                                    name="link_youtube" id="input-link-youtube" placeholder="masukkan link youtube">
                            </div>
                            <div class="mb-3">
                                <label for="input-link-instagram" class="form-label">Link instagram</label>
                                <input value="{{ $row->link_instagram }}" required class="form-control" type="text"
                                    name="link_instagram" id="input-link-instagram"
                                    placeholder="masukkan link instagram">
                            </div>
                            <div class="mb-3">
                                <label for="input-link-facebook" class="form-label">Link facebook</label>
                                <input value="{{ $row->link_facebook }}" required class="form-control" type="text"
                                    name="link_facebook" id="input-link-facebook" placeholder="masukkan link facebook">
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mt-3">
                                    <textarea class="form-control" name="kutipan" id="input-kutipan" style="height: 100px">{{ $row->kutipan }}</textarea>
                                    <label for="input-kutipan">Kutipan</label>
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


        <!-- modal hapus -->
        <div class="modal fade" id="ModalHapus{{ $row->dinas_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                        <a href="/delete-tentang-dinas/{{ $row->dinas_id }}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end-modal hapus -->
    @endforeach

@endsection
