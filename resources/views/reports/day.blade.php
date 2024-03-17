@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Laporan Harian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Laporan Harian</div>
                        <div class="row justify-content-between">
                            <div class="col-12 col-lg-4 col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        Jumlah Uang Per Tanggal {{ $date }}
                                    </div>
                                    <div class="card-body">
                                        <h3 class="mt-3">@currency($report->sum('cash'))</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12 col-md-8">
                                <label for="date" class="form-label">Tanggal</label>
                                <form action="" method="get">
                                    <input type="date" style="float: left; width:70%;" name="date" id="date"
                                        class="form-control">
                                    <button type="submit" class="btn btn-success mb-3 "><i
                                            class="bi bi-search"></i></button>

                                </form>
                            </div>
                        </div>
                        <div class="table-responsive-md table-responsive table-responsive-s" style="width:100%;">
                            <table class="table table-sm table-bordered datatable ">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Tanggal</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="max-width:100%;white-space:nowrap;">{{ $item->customer->name }}</td>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($item->cash)</td>
                                            <td style="max-width:100%;white-space:nowrap;">
                                                {{ $item->created_at->format('d-m-Y') }}</td>

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
    <div class="float-right">
        {{ $report->withQueryString()->links() }}
    </div>
@endsection
