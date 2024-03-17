@extends('layouts.main')

@section('container')
    @include('sweetalert::alert')

    <style>
        .result {
            cursor: pointer;
        }

        .result:hover {
            background: #d3d3d3;
        }
    </style>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard ">
        <div class="card " style="height: 25rem;">
            <div class="card-body">
                <div class="row mt-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-danger text-white">Hapus Semua Data Pelanggan <i
                                    class="bi bi-exclamation-triangle"></i></div>
                            <div class="card-body">
                                <div class="card-text">ini akan menghapus seluruh data pelanggan, transaksi, dan data
                                    pembayaran</div>

                            </div>
                            <div class="card-footer">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteAll">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kamu Yakin ?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/reset-customer" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">Masukkan Password Admin</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Ya, hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
