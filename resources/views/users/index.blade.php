@extends('layouts.main')

@section('container')
    @include('sweetalert::alert')

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Pelanggan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Data Pelanggan</div>
                        <div class="row justify-content-evenly">
                            <div class="col mt-3 mb-2">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambah">Tambah</button>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="table-responsive-md table-responsive table-responsive-s" style="width:100%;">
                                <table class="table table-sm table-striped datatable ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Nomor</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Pasword</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">

                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="max-width:100%;white-space:nowrap;">{{ $item->name }}</td>
                                                <td style="max-width:100%;white-space:nowrap;">{{ $item->username }}</td>
                                                <td style="max-width:100%;white-space:nowrap;">{{ $item->number }}</td>
                                                <td style="max-width:100%;white-space:nowrap;">{{ $item->role->name }}</td>
                                                <td> <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#password{{ $item->slug }}"><i
                                                            class="bi bi-arrow-clockwise"></i></button></td>
                                                <td style="max-width:100%;white-space:nowrap;">
                                                    <button class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $item->slug }}"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                    |
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $item->slug }}"><i
                                                            class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>


    {{-- modal Tambah --}}
    <div class="modal" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/user" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama <span class=" text-danger"
                                    style="font-size:10pt;"> *
                                    Wajib</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username <span class=" text-danger"
                                    style="font-size:10pt;"> *
                                    Wajib</span></label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Nomor Telpon</label>
                            <input type="number" name="number" id="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class=" text-danger"
                                    style="font-size:10pt;"> *
                                    Wajib</span></label>
                            <select name="slug_role" class="form-control" id="role" required>
                                <option value="humas">Humas</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class=" text-danger"
                                    style="font-size:10pt;"> *
                                    Wajib</span></label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Konfirmasi <span class=" text-danger"
                                    style="font-size:10pt;"> *
                                    Wajib</span></label>
                            <input type="password" name="password_confirmation" id="password" class="form-control"
                                required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Vertically centered Modal-->


    {{-- modal edit --}}
    @foreach ($users as $item)
        <div class="modal" id="edit{{ $item->slug }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/user/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama <span class=" text-danger"
                                        style="font-size:10pt;"> *
                                        Wajib</span></label>
                                <input type="text" name="name" id="name" value="{{ $item->name }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span class=" text-danger"
                                        style="font-size:10pt;"> *
                                        Wajib</span></label>
                                <input type="text" name="username" id="username" value="{{ $item->username }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Nomor Telpon</label>
                                <input type="number" name="number" id="number" value="{{ $item->number }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role <span class=" text-danger"
                                        style="font-size:10pt;"> *
                                        Wajib</span></label>
                                <select name="slug_role" class="form-control" id="role" required>
                                    <option value="humas" @if ($item->slug_role == 'humas') selected @endif>Humas</option>
                                    <option value="admin" @if ($item->slug_role == 'admin') selected @endif>Admin</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
    <!-- End Vertically centered Modal-->

    {{-- modal password --}}
    @foreach ($users as $item)
        <div class="modal" id="password{{ $item->slug }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Password User : {{ $item->name }} </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/user-password/{{ $item->slug }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Admin<span class=" text-danger"
                                        style="font-size:10pt;"> *
                                        Wajib</span></label>
                                <input type="password" name="passwordAdmin" id="password" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru <span class=" text-danger"
                                        style="font-size:10pt;"> *
                                        Wajib</span></label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Konfirmasi <span class=" text-danger"
                                        style="font-size:10pt;"> *
                                        Wajib</span></label>
                                <input type="password" name="password_confirmation" id="password" class="form-control"
                                    required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
    <!-- End Vertically centered Modal-->

    <!-- riwayat delete -->
    @foreach ($users as $item)
        <div class="modal" id="delete{{ $item->slug }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Anda yakin ingin menghapus ini ? </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Nama : <strong>{{ $item->name }}</strong></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <form action="/user/{{ $item->slug }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Vertically centered Modal-->
    @endforeach




@endsection
