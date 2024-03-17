@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Laporan Baju</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>Laporan Baju </h3>
                        </div>
                        <div class="row mb-4">
                            <div class="col col-lg-5">
                                <form action="">

                                    <button type="submit" class="btn btn-success float-end"><i
                                            class="bi bi-search"></i></button>
                                    <select name="session" style="width: 85%;" id="session" class="form-control">
                                        <option value="" selected disabled>- cari sesi -</option>
                                        @foreach ($session as $item)
                                            <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-7">
                                <div class="table-responsive-md table-responsive table-responsive-s" style="width:100%;">
                                    <table class="table table-sm table-bordered datatable ">
                                        @foreach ($countSize as $item)
                                            <tr>
                                                <th style="max-width:100%;white-space:nowrap;">Ukuran {{ $item->size }}
                                                </th>
                                                <td style="max-width:100%;white-space:nowrap;">{{ $item->jumlah }}</td>
                                                <td>Baju</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="bg-secondary"> </td>
                                        </tr>
                                        @foreach ($countCategory as $item)
                                            <tr>
                                                <th style="max-width:100%;white-space:nowrap;">{{ $item->name }}</th>
                                                <td style="max-width:100%;white-space:nowrap;">{{ $item->jumlah }}</td>
                                                <td>Baju</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="bg-secondary"> </td>
                                        </tr>
                                        @foreach ($countColor as $item)
                                            <tr>
                                                <th style="max-width:100%;white-space:nowrap;">{{ $item->name }}</th>
                                                <td style="max-width:100%;white-space:nowrap;">{{ $item->jumlah }}</td>
                                                <td>Baju</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="bg-secondary"> </td>
                                        </tr>
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Total Keseluruhan </th>
                                            <td style="max-width:100%;white-space:nowrap;">{{ $countSize->sum('jumlah') }}
                                            </td>
                                            <td>Baju</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
