@extends('layouts.main')

@section('container')
    @include('sweetalert::alert')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Setoran</li>
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
                            <h3>Setoran</h3>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Keterangan </th>
                                        <th>Harga</th>
                                        <th>Harga Jual</th>
                                        <th>Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($priceLists as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->size }}</td>
                                            <td style="max-width:100%;white-space:nowrap;"> @currency($item->price)</td>
                                            <td style="max-width:100%;white-space:nowrap;"> @currency($item->price_sale)</td>
                                            <td style="max-width:100%;white-space:nowrap;"> <button type="button"
                                                    class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $item->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button> || <button type="button" class="btn btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Daftar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/price-list" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <input type="text" name="size" id=" " class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Masukkan Harga </label>
                            <input type="number" name="price" id="" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Masukkan Harga Jual</label>
                            <input type="number" name="price_sale" id="" class="form-control" required>
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
    @foreach ($priceLists as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Harga</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/price-list/{{ $item->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Keterangan</label>
                                <input type="text" name="size" id=" " value="{{ $item->size }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Masukkan Harga</label>
                                <input type="number" name="price" id="" value="{{ $item->price }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Masukkan Harga Jual</label>
                                <input type="number" name="price_sale" id="" value="{{ $item->price_sale }}"
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

    @foreach ($priceLists as $item)
        <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Apakah Kamu Yakin Ingin Menghapus ?</h4>
                        <p>Keterang : <strong> {{ $item->size }}</strong></p>
                    </div>
                    <form action="/price-list/{{ $item->id }}" method="POST">
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
