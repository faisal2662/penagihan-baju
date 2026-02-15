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
                                <a href="add-customer" class="btn btn-primary">Tambah</a>
                            </div>
                            @if ($searchsess != null)
                                <div class="col-lg-4 mt-3 col-12 col-md-8">
                                    <form action="" method="get">
                                        <button type="submit" id="cari" class="btn btn-success mb-3 mt- float-end"><i
                                                class="bi bi-search"></i></button>
                                        <select class="form-control" style="width:80%;" name="session">
                                            <option selected disabled>Cari Sesi</option>
                                            @foreach ($searchsess as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>

                                    </form>
                                </div>
                            @endif

                            <div class="col-lg-4 col-12 col-md-8">
                                <form action="" method="get">
                                    <select class="name form-control" data-width="80%" name="name">
                                        <option selected disabled>Cari Nama</option>
                                        @foreach ($searchCustomers as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" id="cari" class="btn btn-success mb-3 mt-3"><i
                                            class="bi bi-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive-md table-responsive table-responsive-s" style="width:100%;">
                            <table class="table table-sm table-striped datatable ">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Ukuran</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Sisa Bayar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">

                                    @foreach ($customers as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="max-width:100%;white-space:nowrap;">{{ $item->name }}</td>
                                            <td style="max-width:100%;white-space:nowrap;">{{ $item->pricelist->size }}</td>
                                            <td style="max-width:100%;white-space:nowrap;">{{ $item->category->name }}</td>
                                            <td @if ($item->status == 'Lunas') class="text-success fw-bold text-center" @endif
                                                style="max-width:100%;white-space:nowrap;">{{ $item->status }}</td>
                                            <td style="max-width:100%;white-space:nowrap;">@currency($item->payment->remaining)</td>
                                            <td style="max-width:100%;white-space:nowrap;">
                                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#detailCustomer{{ $item->id }}">
                                                <i class="bi bi-info-square"></i>
                                            </button> || --}}
                                                <a href="/edit-customer/{{ $item->slug }}" class="btn btn-info"><i
                                                        class="bi bi-pencil-square"></i></a> |
                                                <button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#detailCustomer{{ $item->slug }}"><i
                                                        class="bi bi-info-square"></i></button>
                                                |
                                                <a class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCustomer{{ $item->slug }}"><i
                                                        class="bi bi-trash"></i></a>
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

    {{-- modal delete --}}
    @foreach ($customers as $item)
        <div class="modal" id="deleteCustomer{{ $item->slug }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Anda yakin ingin menghapus {{ $item->name }} </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a href="/delete-customer/{{ $item->slug }}" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Vertically centered Modal-->
    @endforeach

    @foreach ($customers as $item)
        <!-- Modal -->
        <div class="modal fade" id="detailCustomer{{ $item->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <th>Ukuran</th>
                                <td>{{ $item->pricelist->size }}</td>
                            </tr>
                            <tr>
                                <th>Warna</th>
                                <td>{{ $item->color->name }}</td>
                            </tr>
                            <tr>
                                <th>Jenis </th>
                                <td>{{ $item->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Sesi </th>
                                <td>{{ $item->session->name }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td @if ($item->status == 'Lunas') class="text-success fw-bold" @endif>
                                    {{ $item->status }}</td>
                            </tr>
                            <tr>
                                <th>Yang sudah Bayar</th>
                                <td> @currency($item->payment->temporary) </td>
                            </tr>
                            <tr>
                                <th>Sisa Bayar</th>
                                <td>@currency($item->payment->remaining)</td>
                            </tr>
                            <tr>
                                <th>Total Bayar</th>
                                <td> @currency($item->payment->total) </td>
                            </tr>

                        </table>
                        <div class="text-muted">Riwayat Pembayaran</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($item->transaction as $transaction)
                                    <tr>
                                        <td> @currency($transaction->cash)</td>
                                        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                                        <td>

                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteRiwayat{{ $transaction->slug }}"><i
                                                    class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Belum Terjadi Transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal -->

    <!-- riwayat delete -->
    @foreach ($customers as $transaction)
        @foreach ($transaction->transaction as $item)
            <div class="modal" id="deleteRiwayat{{ $item->slug }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Anda yakin ingin menghapus Riwayat {{ $transaction->name }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/delete-transaction/{{ $item->id }}" method="post">
                                @csrf
                                <input type="hidden" name="slug_customer" value="{{ $transaction->slug }}">
                                <input type="hidden" name="cash" value="{{ $item->cash }}">
                                <p>Tanggal : {{ $item->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            {{-- <a href="/delete-customer/{{ $item->name }}" class="btn btn-danger">Hapus</a> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Vertically centered Modal-->
        @endforeach
    @endforeach

    <div class="float-right">
        {{ $customers->withQueryString()->onEachSide(0)->links() }}
    </div>
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- <script src="{{ asset('assets/select2') }}"></script> --}}
        <script>
            $(document).ready(function() {
                $('.name').select2();

            });
        </script>
    @endsection
@endsection
