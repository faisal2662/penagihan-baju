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
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama </th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dp as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td> @currency($item->nominal)</td>
                                        <td>{{ $item->date }}</td>
                                        <td> <button type="button" class="btn  btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $item->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button> || <button type="button" class="btn btn-sm btn-danger"
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
    </section>

    <!-- Modal -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Setoran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/down-payment" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <input type="text" name="description" id=" " class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Masukkan Nominal</label>
                            <input type="text" name="nominal" id="" class="form-control formatRupiah" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="date" name="date" id="" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    @foreach ($dp as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Setoran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/down-payment-edit/{{ $item->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Keterangan</label>
                                <input type="text" name="description" id=" " value="{{ $item->description }}"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Masukkan Nominal</label>
                                <input type="text" name="nominal" id="" value="{{ $item->nominal }}"
                                    class="form-control formatRupiah" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="date" name="date" id="" value="{{ $item->date }}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-success">Updated</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($dp as $item)
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
                        <p>{{ $item->description }}</p>
                    </div>
                    <form action="/down-payment/{{ $item->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-danger">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@section('script')
    <script>
        $('.formatRupiah').number(true,0)
    </script>
@endsection

@endsection
