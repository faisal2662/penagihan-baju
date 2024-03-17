@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Laporan Keuangan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="card-title">
                            <h3>Laporan Keuangan </h3>
                        </div>

                        <div class="row">
                            <div class="col col-lg-7">
                                <div class="table-responsive-md table-responsive table-responsive-s" style="width:100%;">
                                    <table class="table table-sm table-bordered datatable ">
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Uang Yang Sudah Masuk</th>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($paid)</td>
                                        </tr>
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Uang Yang Sudah disetorkan / Dp
                                            </th>
                                            <td style="max-width:100%;white-space:nowrap;">
                                                @if ($dp == null)
                                                    <div class="text-muted">Uang Belum di setorkan</div>
                                                @else
                                                    @currency($dp)
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Uang Yang Tersedia</th>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($available)</td>
                                        </tr>
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Uang Yang belum Masuk</th>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($debt)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-secondary"> </td>
                                        </tr>
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Uang yang disetor</th>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($deposit)</td>
                                        </tr>
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Keuntungan</th>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($profit)</td>
                                        </tr>
                                        <tr>
                                            <th style="max-width:100%;white-space:nowrap;">Total Keseluruhan</th>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($sale)</td>
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
