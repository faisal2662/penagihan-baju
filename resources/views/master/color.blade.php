@extends('layouts.main')

@section('container')
    @include('sweetalert::alert')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Warna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-3"><!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                Tambah
                            </button>
                        </div>
                        <div class="card-title">
                            <h3>Warna</h3>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama </th>
                                        <th>Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colors as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="max-width:100%;white-space:nowrap;">{{ $item->name }}</td>
                                            <td style="max-width:100%;white-space:nowrap;"> <button type="button"
                                                    class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $item->slug }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button> || <button type="button" class="btn btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#hapus{{ $item->slug }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
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

    <!-- Modal -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Warna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/color" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" id=" " class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    @foreach ($colors as $item)
        <div class="modal fade" id="edit{{ $item->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Warna</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/color/{{ $item->slug }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" name="name" id=" " value="{{ $item->name }}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Updated</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach



    @foreach ($colors as $item)
        <div class="modal fade" id="hapus{{ $item->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Apakah Kamu Yakin Ingin Menghapus ?</h4>
                        <p> Warna :<strong> {{ $item->name }}</strong></p>
                    </div>
                    <form action="/color/{{ $item->slug }}" method="POST">
                        @csrf
                        @method('delete')
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
