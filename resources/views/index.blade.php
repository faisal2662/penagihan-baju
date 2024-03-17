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
        <div class="card">
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-10 col-lg-3 col-md-6">
                        <div class="card " style="background-color: rgb(2, 95, 170);">
                            <div class="card-header text-black text-center">Pelangggan</div>
                            <div class="card-body">
                                <div class="text-center text-white fs-3 mt-2">{{ $customer->count() }}</div>
                            </div>
                        </div>
                    </div>
                    @foreach ($sess as $item)
                        <div class="col-10 col-lg-3 col-md-6">
                            <div class="card " style="background-color: rgb(7, 175, 161);">
                                <div class="card-header text-black text-center">{{ $item->name }}</div>
                                <div class="card-body">
                                    <div class="text-center text-white fs-3 mt-2">
                                        {{ $customer->where('slug_session', $item->slug)->count() }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @can('isAdmin')
                        <div class="col-10 col-lg-3 col-md-6">
                            <div class="card " style="background-color: rgb(196, 166, 1);">
                                <div class="card-header text-black text-center">Yang Sudah Masuk</div>
                                <div class="card-body">
                                    <div class="text-center text-white fs-3 mt-2"> @currency($pay->sum('temporary')) </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    <div class="col-10 col-lg-3 col-md-6">
                        <div class="card " style="background-color: rgb(2, 170, 66);">
                            <div class="card-header text-black text-center"> Masuk Hari Ini</div>
                            <div class="card-body">
                                <div class="text-center text-white fs-3 mt-2"> @currency($trans) </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
